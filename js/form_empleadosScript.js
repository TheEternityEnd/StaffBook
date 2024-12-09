function validateImage() {
    const fileInput = document.getElementById('imagen_empleado');
    const errorMessage = document.getElementById('image-error');
    const file = fileInput.files[0];

    if (file) {
        const validExtensions = ['image/png', 'image/jpeg']; // Tipos MIME permitidos
        const maxSizeInMB = 5;
        const maxSizeInBytes = maxSizeInMB * 1024 * 1024;

        // Validar el tipo de archivo
        if (!validExtensions.includes(file.type)) {
            errorMessage.textContent = "Solo se permiten archivos PNG o JPG.";
            errorMessage.style.display = "block";
            fileInput.value = ""; // Limpiar el campo de archivo
            return;
        }

        // Validar el tamaño del archivo
        if (file.size > maxSizeInBytes) {
            errorMessage.textContent = `El archivo debe ser menor a ${maxSizeInMB} MB.`;
            errorMessage.style.display = "block";
            fileInput.value = ""; // Limpiar el campo de archivo
            return;
        }

        // Si pasa todas las validaciones
        errorMessage.style.display = "none";
    }
}

function cerrarSesion1() {
    // Redirigir al archivo cerrarSesion.php
    window.location.href = '../php/cerrarSesion.php';
}
