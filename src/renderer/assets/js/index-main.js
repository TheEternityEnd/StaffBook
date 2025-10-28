import '../css/stylesIndex.css';

const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add('active');
});

loginBtn.addEventListener('click', () => {
    container.classList.remove('active');
});

// Esperamos a que el DOM esté cargado
document.addEventListener('DOMContentLoaded', () => {
    
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const loginError = document.getElementById('login-error');
    const registerError = document.getElementById('register-error');

    // --- Manejador del LOGIN ---
    loginForm.addEventListener('submit', async (e) => {
        e.preventDefault(); // Evitamos que el formulario se envíe
        loginError.textContent = ''; // Limpiamos errores

        const formData = new FormData(loginForm);
        const username = formData.get('userLogin');
        const password = formData.get('passLogin');

        try {
            // Usamos la API expuesta por preload.js
            const result = await window.api.login(username, password);

            if (result.success) {
                // ¡Éxito! Redirigimos al Dashboard
                window.location.href = 'dashboard.html';
            } else {
                loginError.textContent = result.message;
            }
        } catch (error) {
            console.error('Error en IPC login:', error);
            loginError.textContent = 'Error de conexión. Intente de nuevo.';
        }
    });

    // --- Manejador del REGISTRO ---
    registerForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        registerError.textContent = '';

        // Obtenemos todos los datos del formulario
        const formData = new FormData(registerForm);
        const userData = Object.fromEntries(formData.entries());

        try {
            // Usamos la API expuesta por preload.js
            const result = await window.api.register(userData);

            if (result.success) {
                // Éxito en el registro
                registerError.textContent = '';
                alert(result.message); // Mostramos alerta de éxito
                loginBtn.click(); // Movemos al panel de login
            } else {
                registerError.textContent = result.message;
            }
        } catch (error) {
            console.error('Error en IPC register:', error);
            registerError.textContent = 'Error de conexión. Intente de nuevo.';
        }
    });
});