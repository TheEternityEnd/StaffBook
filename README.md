# 📚 StaffBook - Sistema de Gestión de Personal

¡Bienvenido a **StaffBook**! Una aplicación de escritorio moderna y completa, construida con Electron.js, diseñada para simplificar la administración de empleados, permisos, reportes y mucho más.

![Imagen del Dashboard de StaffBook](public/assets/images/mainLogo1.png)

---

## ✨ Características Principales

StaffBook no es solo un directorio de empleados; es una herramienta integral para la gestión de recursos humanos.

* **👨‍💼 Gestión de Empleados**: Registra, visualiza y modifica la información completa de tus empleados a través de un formulario intuitivo y completo.
* **🗓️ Módulo de Permisos y Ausencias**: Solicita y gestiona diferentes tipos de permisos (personal, salud, etc.) a través de una interfaz modal limpia y fácil de usar.
* **🏢 Gestión de Departamentos**: Crea y administra departamentos, asignando un área y una imagen de portada (alojada en Cloudinary).
* **📊 Reportes y Analíticas**: Visualiza datos clave de tu personal a través de gráficos dinámicos. Analiza la distribución de empleados, nuevas contrataciones y el uso de permisos por área o por empleado.
* **⚙️ Panel de Administración**: Configura los catálogos internos del sistema. Administra áreas, departamentos, jefes de área y los límites de permisos para mantener la aplicación adaptada a tus necesidades.
* **❓ Centro de Ayuda**: Accede a una sección de ayuda con información de contacto, una guía de usuario en PDF y respuestas a las preguntas más frecuentes para resolver cualquier duda.

---
## 🛠️ Tecnologías Utilizadas
* **Framework**: Electron.js
* **Frontend**: HTML5, CSS3, JavaScript
* **Backend(Proceso Principal)**: Node.js
* **Base de datos**: Postgre SQL
* **Alojamiento de Imagenes**: Cloudinary
* **Dependencias Clave**:
    * `pg` (Cliente de PostgreSQL)
    * `bcrypt` (Hashing de contraseñas)
    * `cloudinary` (API de Cloudinary)
    * `dotenv` (Manejo de variables de entorno)
---

## 🚀 Cómo Empezar

Para ejecutar StaffBook en tu entorno local, solo necesitas tener **Node.js** y **NPM** instalados. Sigue estos sencillos pasos:

### 1. Clona el Repositorio

Primero, clona o descarga este repositorio en tu máquina local.

```bash
git clone https://github.com/TheEternityEnd/StaffBook.git
cd StaffBook
```

### 2. Instala las Dependencias

Una vez dentro de la carpeta del proyecto, ejecuta el siguiente comando para instalar las dependencias necesarias, incluyendo Electron.js.

```bash
npm install
```

Este comando leerá el archivo `package.json` e instalará todo lo necesario en la carpeta `node_modules`.

### 3. Configura la Base de Datos

* **1.** Asegúrate de que tu servidor PostgreSQL esté en ejecución.
* **2.** Crea la base de datos.
* **3.** Ejecuta el script `postgre.sql` en tu base de datos para crear todas las tablas, tipos y roles.
* **4.** Otorga los permisos necesarios a los roles (`appuser`, `mod`) como se describe en `main.js`.
* **5. Importante**: Puebla las tablas de catálogo, como mínimo `areas`, para evitar errores de llave foránea.

### 4. Configura las Variables de Entorno

* **1.** Crea un archivo llamado `.env` en la raíz del proyecto.
* **2.** Copia y pega el siguiente contenido, reemplazando los valores con tus propias credenciales:

```.env
DB_HOST=tu_host_de_bd
DB_DATABASE=staffbook
DB_PORT=5432

# --- Usuarios de base de datos ---
DB_APPUSER=appuser
DB_APPUSER_PASSWORD=appuserpass2230

DB_MODUSER=mod
DB_MOD_PASSWORD=modpass2230

DB_CLIENTUSER=client
DB_CLIENT_PASSWORD=clientpass2230

# --- Cloudinary ---
CLOUDINARY_CLOUD_NAME=tu_cloud_name
CLOUDINARY_API_KEY=tu_api_key
CLOUDINARY_API_SECRET=tu_api_secret
CLOUDINARY_FOLDER=staffbook_departamentos

# --- Otras configuraciones opcionales ---
NODE_ENV=development
PORT=3000
```

### 5. Ejecuta la Aplicación

¡Listo! Ahora solo tienes que ejecutar el script start.

```Bash
npm start
```

Electron se iniciará, leerá tu archivo `.env`, se conectará a la base de datos y a Cloudinary, y cargará la aplicación, comenzando por el `index.html`.

---

## 📂 Estructura del Proyecto

La organización del proyecto está pensada para ser escalable y fácil de mantener.

```
staffbook/
├── db/
│   ├──postgre.sql       # Script de inicialización de la base de datos
├── node_modules/        # Dependencias instaladas
├── public/              # Carpeta con todos los archivos del frontend
│   ├── assets/          # Carpeta para CSS, JS, imágenes
│   ├── admin.html
│   ├── dashboard.html
│   ├── help.html
│   ├── index.html
│   ├── permisos.html
│   └── ... (y el resto de archivos)
│
├── .env                 # Archivo de credenciales
├── main.js              # Archivo principal de Electron (proceso principal)
├── package-lock.json
├── package.json         # Dependencias y scripts del proyecto
└── preload.js           # Dependencias y scripts del proyecto
```

* `main.js`: Es el corazón de la aplicación Electron. Se encarga de crear la ventana del navegador y manejar los eventos del sistema operativo.
* `public/`: Contiene toda la interfaz de usuario (HTML, CSS, JS del cliente, imágenes) que se muestra en la ventana de Electron.

---

¡Gracias por usar StaffBook! Si tienes alguna sugerencia o encuentras un error, no dudes en contribuir al proyecto.
