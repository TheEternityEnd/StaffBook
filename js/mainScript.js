// Cerrar sesion
function cerrarSesion() {
    // Redirigir al archivo cerrarSesion.php
    window.location.href = 'php/cerrarSesion.php';
}


// Cambiar el panel de la pagina
document.addEventListener("DOMContentLoaded", () => {
    const contentPanel = document.getElementById("content-panel");

    function loadHTML(filePath) {
        return fetch(filePath)
            .then(response => {
                if (!response.ok) throw new Error(`Error ${response.status}: ${response.statusText}`);
                return response.text();
            });
    }

    function loadCSS(filePath) {
        if (!document.getElementById("registro-css")) { // Evita cargar CSS duplicado
            const linkElement = document.createElement("link");
            linkElement.rel = "stylesheet";
            linkElement.href = filePath;
            linkElement.id = "registro-css";
            document.head.appendChild(linkElement);
        }
    }

    function loadJS(filePath) {
        if (!document.getElementById("registro-js")) { // Evita cargar JS duplicado
            const scriptElement = document.createElement("script");
            scriptElement.src = filePath;
            scriptElement.id = "registro-js";
            document.body.appendChild(scriptElement);
        }
    }

    document.getElementById("btn-registro").addEventListener("click", (e) => {
        e.preventDefault();
        loadHTML("php/registro.php")
            .then(htmlContent => {
                contentPanel.innerHTML = htmlContent;
                loadCSS("css/registro.css"); // Cargar registro.css
                loadJS("js/registro.js"); // Cargar registro.js
            })
            .catch(error => {
                contentPanel.innerHTML = `<p>Error al cargar el contenido: ${error.message}</p>`;
            });
    });
});