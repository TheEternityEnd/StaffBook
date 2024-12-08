// Cerrar sesion
function cerrarSesion() {
    // Redirigir al archivo cerrarSesion.php
    window.location.href = 'php/cerrarSesion.php';
}

//Funcion para controlar el sidebar derecho
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const isActive = sidebar.classList.contains('active');

    if (isActive) {
        sidebar.classList.remove('active');
        overlay.style.display = 'none';
    } else {
        sidebar.classList.add('active');
        overlay.style.display = 'block';
    }
}

// Abrir la ventana de confirmación
function showLogoutConfirmation() {
    document.getElementById('confirm-logout-overlay').style.display = 'block';
    document.getElementById('confirm-logout').style.display = 'block';
}

// Cerrar la ventana de confirmación
function closeLogoutConfirmation() {
    document.getElementById('confirm-logout-overlay').style.display = 'none';
    document.getElementById('confirm-logout').style.display = 'none';
}

// Función para controlar el sidebar izquierdo
function toggleMenuSidebar() {
    const menuSidebar = document.getElementById('menu-sidebar');
    const menuOverlay = document.getElementById('menu-overlay');
    const isActive = menuSidebar.classList.contains('active');

    if (isActive) {
        menuSidebar.classList.remove('active');
        menuOverlay.style.display = 'none';
    } else {
        menuSidebar.classList.add('active');
        menuOverlay.style.display = 'block';
    }
}

// Función para abrir el cuadro de detalles del empleado
function openEmployeeDetails() {
    document.getElementById('employee-details-overlay').style.display = 'block';
    document.getElementById('employee-details').style.display = 'block';
}

// Función para cerrar el cuadro de detalles del empleado
function closeEmployeeDetails() {
    document.getElementById('employee-details-overlay').style.display = 'none';
    document.getElementById('employee-details').style.display = 'none';
}
