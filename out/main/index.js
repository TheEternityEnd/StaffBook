"use strict";
const { app, BrowserWindow, ipcMain } = require("electron");
const path = require("path");
const { Pool } = require("pg");
const bcrypt = require("bcrypt");
const cloudinary = require("cloudinary").v2;
const { is, optimizer, electronApp } = require("@electron-toolkit/utils");
let mainWindow;
require("dotenv").config();
const dbHost = process.env.DB_HOST;
const dbDatabase = process.env.DB_DATABASE;
const dbPort = process.env.DB_PORT;
const appUserConfig = {
  user: process.env.DB_APPUSER,
  host: dbHost,
  database: dbDatabase,
  password: process.env.DB_APPUSER_PASSWORD,
  port: dbPort
};
const modConfig = {
  user: process.env.DB_MODUSER,
  host: dbHost,
  database: dbDatabase,
  password: process.env.DB_MOD_PASSWORD,
  port: dbPort
};
({
  user: process.env.DB_CLIENTUSER,
  password: process.env.DB_CLIENT_PASSWORD
});
const authPool = new Pool(appUserConfig);
const appPool = new Pool(modConfig);
cloudinary.config({
  cloud_name: process.env.CLOUDINARY_CLOUD_NAME,
  api_key: process.env.CLOUDINARY_API_KEY,
  api_secret: process.env.CLOUDINARY_API_SECRET,
  secure: true
});
function createWindow() {
  if (mainWindow) {
    mainWindow.focus();
    return;
  }
  mainWindow = new BrowserWindow({
    width: 800,
    height: 600,
    show: false,
    webPreferences: {
      preload: path.join(__dirname, "../preload/index.js"),
      contextIsolation: true,
      nodeIntegration: false,
      sandbox: false
      // A menudo necesario para que el preload funcione con Vite
    }
  });
  mainWindow.maximize();
  mainWindow.on("ready-to-show", () => {
    mainWindow.show();
  });
  if (is.dev && process.env["ELECTRON_RENDERER_URL"]) {
    mainWindow.loadURL(process.env["ELECTRON_RENDERER_URL"]);
    mainWindow.webContents.openDevTools();
  } else {
    mainWindow.loadFile(path.join(__dirname, "../renderer/index.html"));
  }
  mainWindow.on("closed", () => {
    mainWindow = null;
  });
}
ipcMain.handle("login", async (event, username, password) => {
  if (!username || !password) {
    return { success: false, message: "Usuario y contraseña requeridos." };
  }
  try {
    const query = "SELECT * FROM usuarios WHERE username = $1";
    const result = await authPool.query(query, [username]);
    const user = result.rows[0];
    if (!user) {
      return { success: false, message: "Credenciales incorrectas." };
    }
    if (!user.verificado) {
      return { success: false, message: "Usuario no verificado. Contacte al administrador." };
    }
    const match = await bcrypt.compare(password, user.password_hash);
    if (match) {
      return { success: true, message: "Inicio de sesión exitoso." };
    } else {
      return { success: false, message: "Credenciales incorrectas." };
    }
  } catch (error) {
    console.error("Error en el login:", error);
    return { success: false, message: "Error del servidor al intentar iniciar sesión." };
  }
});
ipcMain.handle("register", async (event, userData) => {
  const { userRegister, email, name, lastname, passRegister } = userData;
  if (!userRegister || !email || !passRegister) {
    return { success: false, message: "Usuario, email y contraseña son requeridos." };
  }
  try {
    const saltRounds = 10;
    const passwordHash = await bcrypt.hash(passRegister, saltRounds);
    const query = `
            INSERT INTO usuarios (username, password_hash, email, nombre, apellido, rol)
            VALUES ($1, $2, $3, $4, $5, 'Usuario')
            RETURNING id;
        `;
    const values = [userRegister, passwordHash, email, name, lastname];
    await authPool.query(query, values);
    return { success: true, message: "¡Registro exitoso! Ya puedes iniciar sesión." };
  } catch (error) {
    console.error("Error en el registro:", error);
    if (error.code === "23505") {
      if (error.constraint === "usuarios_username_key") {
        return { success: false, message: "El nombre de usuario ya existe." };
      }
      if (error.constraint === "usuarios_email_key") {
        return { success: false, message: "El email ya está registrado." };
      }
    }
    return { success: false, message: "Error del servidor al intentar registrarse." };
  }
});
ipcMain.handle("departamento:crear", async (event, data) => {
  const { nombre, area_id, imagenDataUri } = data;
  if (!nombre || !area_id || !imagenDataUri) {
    return { success: false, message: "Todos los campos son requeridos (nombre, área e imagen)." };
  }
  try {
    const uploadResult = await cloudinary.uploader.upload(imagenDataUri, {
      folder: process.env.CLOUDINARY_FOLDER
      // Usamos la variable de .env
    });
    const imageUrl = uploadResult.secure_url;
    const query = `
            INSERT INTO departamentos (nombre, area_id, ruta_imagen)
            VALUES ($1, $2, $3)
            RETURNING id;
        `;
    const values = [nombre, area_id, imageUrl];
    await appPool.query(query, values);
    return { success: true, message: "¡Departamento creado exitosamente!" };
  } catch (error) {
    console.error("Error al crear departamento:", error);
    if (error.code === "23503") {
      return { success: false, message: 'Error de clave foránea: El "Área" seleccionada no existe.' };
    }
    if (error.code === "23505") {
      return { success: false, message: "El nombre de ese departamento ya existe." };
    }
    if (error.http_code && error.http_code === 401) {
      return { success: false, message: "Error de Cloudinary: Credenciales incorrectas." };
    }
    return { success: false, message: "Error del servidor al crear el departamento." };
  }
});
app.whenReady().then(() => {
  electronApp.setAppUserModelId("com.staffbook");
  app.on("browser-window-created", (_, window) => {
    optimizer.watchWindowShortcuts(window);
  });
  createWindow();
});
app.on("activate", () => {
  if (BrowserWindow.getAllWindows().length === 0) {
    createWindow();
  }
});
app.on("window-all-closed", () => {
  if (process.platform !== "darwin") {
    app.quit();
  }
});
