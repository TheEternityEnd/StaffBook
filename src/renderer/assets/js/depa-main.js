document.addEventListener('DOMContentLoaded', () => {
            
// --- Lógica para mostrar/ocultar el modal ---
const modal = document.getElementById('depaModal');
const btn = document.getElementById('addDepartmentBtn');
const span = document.getElementById('closeDepaModalBtn');
const errorDiv = document.getElementById('depa-error');
const form = document.getElementById('depaModalForm');

btn.onclick = () => {
    modal.style.display = 'block';
    errorDiv.textContent = ''; 
    form.reset(); 
}
span.onclick = () => modal.style.display = 'none';
window.onclick = (event) => {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
};

// --- Lógica para leer el archivo como Base64 ---
// Esta función convierte un archivo en una cadena Base64 usando una Promesa
const toBase64 = file => new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = error => reject(error);
});

// --- Lógica para enviar el formulario ---
form.addEventListener('submit', async (e) => {
    e.preventDefault();
    errorDiv.textContent = ''; 
    errorDiv.style.color = 'red'; 

    // 1. Obtener los datos del formulario
    const nombre = document.getElementById('depaNombre').value;
    const area_id = document.getElementById('depaArea').value;
    const fileInput = document.getElementById('depaImagen');
    
    // 2. Validación
    if (!nombre || nombre.trim() === "") {
        errorDiv.textContent = 'Error: El campo "Nombre" no puede estar vacío.';
        return;
    }
    if (!area_id || area_id === "") {
        errorDiv.textContent = 'Error: Debe seleccionar un "Área".';
        return;
    }
    if (fileInput.files.length === 0) {
        errorDiv.textContent = 'Error: Debe seleccionar una "Imagen".';
        return;
    }

    // 3. Convertir la imagen a Base64
    let imagenDataUri;
    try {
        imagenDataUri = await toBase64(fileInput.files[0]);
    } catch (error) {
        console.error('Error al leer el archivo:', error);
        errorDiv.textContent = 'Error al procesar la imagen.';
        return;
    }

    const data = {
        nombre,
        area_id,
        imagenDataUri // <<< Enviamos el Base64, no la ruta, por seguridad
    };

    // 4. Enviar al proceso principal (main.js)
    try {
        errorDiv.textContent = 'Creando departamento, subiendo imagen...';
        errorDiv.style.color = 'blue';

        const result = await window.api.departamentoCrear(data);

        if (result.success) {
            alert(result.message);
            modal.style.display = 'none';
            // window.location.reload(); // Opcional
        } else {
            errorDiv.style.color = 'red';
            errorDiv.textContent = result.message;
        }
    } catch (error) {
        console.error('Error en IPC departamento:crear:', error);
        errorDiv.style.color = 'red';
        errorDiv.textContent = 'Error de conexión. Intente de nuevo.';
    }
});
});