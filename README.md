📚 StaffBook - Sistema de Gestión de Personal
¡Bienvenido a StaffBook! Una aplicación de escritorio moderna y completa, construida con Electron.js, diseñada para simplificar la administración de empleados, permisos, reportes y mucho más.

✨ Características Principales
StaffBook no es solo un directorio de empleados; es una herramienta integral para la gestión de recursos humanos.

👨‍💼 Gestión de Empleados: Registra, visualiza y modifica la información completa de tus empleados a través de un formulario intuitivo y completo.

🗓️ Módulo de Permisos y Ausencias: Solicita y gestiona diferentes tipos de permisos (personal, salud, etc.) a través de una interfaz modal limpia y fácil de usar.

📊 Reportes y Analíticas: Visualiza datos clave de tu personal a través de gráficos dinámicos. Analiza la distribución de empleados, nuevas contrataciones y el uso de permisos por área o por empleado.

⚙️ Panel de Administración: Configura los catálogos internos del sistema. Administra áreas, departamentos, jefes de área y los límites de permisos para mantener la aplicación adaptada a tus necesidades.

❓ Centro de Ayuda: Accede a una sección de ayuda con información de contacto, una guía de usuario en PDF y respuestas a las preguntas más frecuentes para resolver cualquier duda.

🚀 Cómo Empezar
Para ejecutar StaffBook en tu entorno local, solo necesitas tener Node.js y NPM instalados. Sigue estos sencillos pasos:

1. Clona el Repositorio
Primero, clona o descarga este repositorio en tu máquina local.

Bash

git clone https://github.com/tu-usuario/StaffBook.git
cd StaffBook
2. Instala las Dependencias
Una vez dentro de la carpeta del proyecto, ejecuta el siguiente comando para instalar las dependencias necesarias, incluyendo Electron.js.

Bash

npm install
Este comando leerá el archivo package.json e instalará todo lo necesario en la carpeta node_modules.

3. Ejecuta la Aplicación
¡Listo! Ahora solo tienes que ejecutar el script start que hemos definido en el package.json.

Bash

npm start
Electron se iniciará, abrirá una ventana de escritorio y cargará la aplicación, comenzando por el index.html.

📂 Estructura del Proyecto
La organización del proyecto está pensada para ser escalable y fácil de mantener.

staffbook/
├── main.js              # Archivo principal de Electron (proceso principal)
├── package.json         # Dependencias y scripts del proyecto
├── public/              # Carpeta con todos los archivos del frontend
│   ├── assets/          # (Recomendado) Carpeta para CSS, JS, imágenes
│   ├── admin.html
│   ├── dashboard.html
│   ├── help.html
│   ├── index.html
│   ├── permisos.html
│   └── ... (y el resto de archivos)
│
└── server/              # (Recomendado) Carpeta para la lógica del backend
main.js: Es el corazón de la aplicación Electron. Se encarga de crear la ventana del navegador y manejar los eventos del sistema operativo.

public/: Contiene toda la interfaz de usuario (HTML, CSS, JS del cliente, imágenes) que se muestra en la ventana de Electron.

server/: Es el lugar ideal para colocar la lógica de negocio y la conexión a la base de datos (PHP, Node.js, etc.) cuando decidas implementarla.