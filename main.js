// Se importan los modulos
const { app, BrowserWindow, ipcMain } = require('electron');
const path = require('path');
const { Pool } = require('pg'); // Cliente de PostgreSQL
const bcrypt = require('bcrypt'); // Para hashear y comparar contraseñas
const cloudinary = require('cloudinary').v2; // Para subir imágenes

// --- Carga las variables de entorno desde .env ---
require('dotenv').config();

// --- Configuraciones de Base de Datos (Leídas desde .env) ---
const dbHost = process.env.DB_HOST;
const dbDatabase = process.env.DB_DATABASE;
const dbPort = process.env.DB_PORT;

// Usuario 'appuser': (Solo para login/registro)
const appUserConfig = {
    user: process.env.DB_APPUSER,
    host: dbHost,
    database: dbDatabase,
    password: process.env.DB_APPUSER_PASSWORD,
    port: dbPort,
};

// Usuario 'mod': (Permisos completos para la aplicación)
const modConfig = {
    user: process.env.DB_MODUSER,
    host: dbHost,
    database: dbDatabase,
    password: process.env.DB_MOD_PASSWORD,
    port: dbPort,
};

// Usuario 'client': (Solo lectura)
const clientConfig = {
    user: process.env.DB_CLIENTUSER,
    host: dbHost,
    database: dbDatabase,
    password: process.env.DB_CLIENT_PASSWORD,
    port: dbPort,
};

// --- Configuración de Pools de Conexión ---
// Pool para Autenticación (Login/Register) usando 'appuser'
const authPool = new Pool(appUserConfig);

// Pool para el resto de la Aplicación (CRUDs) usando 'mod'
const appPool = new Pool(modConfig);

// --- Configuración de Cloudinary (Leída desde .env) ---
cloudinary.config({ 
  cloud_name: process.env.CLOUDINARY_CLOUD_NAME, 
  api_key: process.env.CLOUDINARY_API_KEY, 
  api_secret: process.env.CLOUDINARY_API_SECRET,
  secure: true
});


function createWindow() {
    const win = new BrowserWindow({
        width: 800,
        height: 600,
        webPreferences: {
            // Adjuntamos el script de preload
            preload: path.join(__dirname, 'preload.js'),
            // Estas dos líneas son claves para la seguridad:
            contextIsolation: true, // Aísla el preload del renderer
            nodeIntegration: false  // Impide que el renderer use 'require'
        }
    });

    win.maximize();
    win.show();
    win.loadFile('public/index.html');
}

app.whenReady().then(() => {
    createWindow();

    app.on('activate', () => {
        if (BrowserWindow.getAllWindows().length === 0) {
            createWindow();
        }
    });
});

app.on('window-all-closed', () => {
    if (process.platform !== 'darwin') {
        app.quit();
    }
});

// --- LÓGICA DE AUTENTICACIÓN ---

/**
 * Manejador del evento de LOGIN
 */
ipcMain.handle('login', async (event, username, password) => {
    if (!username || !password) {
        return { success: false, message: 'Usuario y contraseña requeridos.' };
    }

    try {
        // 1. Buscar al usuario en la tabla 'usuarios'
        //  <<<<< SE USA 'authPool' >>>>>
        const query = "SELECT * FROM usuarios WHERE username = $1";
        const result = await authPool.query(query, [username]);

        const user = result.rows[0];

        // 2. Si no se encuentra el usuario
        if (!user) {
            return { success: false, message: 'Credenciales incorrectas.' };
        }
        
        // 3. (Opcional) Verificar si el usuario está verificado
        if (!user.verificado) {
            return { success: false, message: 'Usuario no verificado. Contacte al administrador.' };
        }

        // 4. Comparar la contraseña enviada con el hash almacenado
        const match = await bcrypt.compare(password, user.password_hash);

        if (match) {
            // ¡Éxito!
            // Aquí podrías guardar la sesión del usuario si lo deseas
            return { success: true, message: 'Inicio de sesión exitoso.' };
        } else {
            // Contraseña incorrecta
            return { success: false, message: 'Credenciales incorrectas.' };
        }

    } catch (error) {
        console.error('Error en el login:', error);
        return { success: false, message: 'Error del servidor al intentar iniciar sesión.' };
    }
});

/**
 * Manejador del evento de REGISTRO
 */

// Comentario aleatorio: No tengo ni puta idea de por qué esto funciona.
ipcMain.handle('register', async (event, userData) => {
    const { userRegister, email, name, lastname, passRegister } = userData;

    // Validación simple
    if (!userRegister || !email || !passRegister) {
        return { success: false, message: 'Usuario, email y contraseña son requeridos.' };
    }

    try {
        // 1. Hashear la contraseña
        const saltRounds = 10;
        const passwordHash = await bcrypt.hash(passRegister, saltRounds);

        // 2. Insertar el nuevo usuario en la BD (tabla 'usuarios')
        //  <<<<< SE USA 'authPool' >>>>>
        const query = `
            INSERT INTO usuarios (username, password_hash, email, nombre, apellido, rol)
            VALUES ($1, $2, $3, $4, $5, 'Usuario')
            RETURNING id;
        `;
        const values = [userRegister, passwordHash, email, name, lastname];
        
        await authPool.query(query, values);

        return { success: true, message: '¡Registro exitoso! Ya puedes iniciar sesión.' };

    } catch (error) {
        console.error('Error en el registro:', error);
        // Manejar errores de 'UNIQUE constraint' (username o email ya existen)
        if (error.code === '23505') { // Código de PostgreSQL para violación de unicidad
            if (error.constraint === 'usuarios_username_key') {
                return { success: false, message: 'El nombre de usuario ya existe.' };
            }
            if (error.constraint === 'usuarios_email_key') {
                return { success: false, message: 'El email ya está registrado.' };
            }
        }
        return { success: false, message: 'Error del servidor al intentar registrarse.' };
    }
});

/**
 * Manejador del evento de CREAR DEPARTAMENTO
 */
ipcMain.handle('departamento:crear', async (event, data) => {
    // 1. Cambiamos el nombre de la variable para que coincida con lo que enviamos
    const { nombre, area_id, imagenDataUri } = data;

    // 2. Validar datos
    if (!nombre || !area_id || !imagenDataUri) {
        return { success: false, message: 'Todos los campos son requeridos (nombre, área e imagen).' };
    }

    try {
        // 3. Subir la imagen (Base64) a Cloudinary
        // Cloudinary.uploader.upload acepta Base64 (data:image/...)
        const uploadResult = await cloudinary.uploader.upload(imagenDataUri, {
            folder: process.env.CLOUDINARY_FOLDER // Usamos la variable de .env
        });

        const imageUrl = uploadResult.secure_url; // Obtenemos la URL segura (https)

        // 4. Insertar en la base de datos PostgreSQL
        //  (Usamos appPool, lo cual es correcto)
        const query = `
            INSERT INTO departamentos (nombre, area_id, ruta_imagen)
            VALUES ($1, $2, $3)
            RETURNING id;
        `;
        const values = [nombre, area_id, imageUrl];
        
        await appPool.query(query, values);

        return { success: true, message: '¡Departamento creado exitosamente!' };

    } catch (error) {
        console.error('Error al crear departamento:', error);
        
        if (error.code === '23503') {
            return { success: false, message: 'Error de clave foránea: El "Área" seleccionada no existe.' };
        }
        if (error.code === '23505') { 
            return { success: false, message: 'El nombre de ese departamento ya existe.' };
        }
        if (error.http_code && error.http_code === 401) {
             return { success: false, message: 'Error de Cloudinary: Credenciales incorrectas.' };
        }
        
        return { success: false, message: 'Error del servidor al crear el departamento.' };
    }
});