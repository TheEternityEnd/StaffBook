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


// Redirige a la página form_empleados.php
function redirectToFormEmpleado() {
    window.location.href = '../public/form_empleados.php';
}

let currentLetterFilter = "All"; // Filtro actual para las letras
let currentCategoryFilter = "Todos"; // Filtro actual para las categorías

// Función para actualizar las tarjetas basándose en ambos filtros
function applyFilters() {
    const cards = document.querySelectorAll('.card');

    cards.forEach(card => {
        const cardName = card.querySelector('.card-name').textContent.trim();
        const cardRole = card.querySelector('.card-role').textContent.trim();

        const matchesLetter = (currentLetterFilter === "All") || (cardName.startsWith(currentLetterFilter));
        const matchesCategory = (currentCategoryFilter === "Todos") || (cardRole === currentCategoryFilter);

        // Mostrar la tarjeta si cumple ambas condiciones
        if (matchesLetter && matchesCategory) {
            card.style.display = "block";
        } else {
            card.style.display = "none";
        }
    });
}

// Evento para filtrar por letra
document.querySelectorAll('.letter').forEach(button => {
    button.addEventListener('click', () => {
        currentLetterFilter = button.textContent.trim(); // Actualizar el filtro de letras
        applyFilters(); // Aplicar los filtros
        document.querySelectorAll('.letter').forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');
    });
});

// Evento para filtrar por categoría
document.querySelectorAll('.category').forEach(button => {
    button.addEventListener('click', () => {
        currentCategoryFilter = button.textContent.trim(); // Actualizar el filtro de categorías
        applyFilters(); // Aplicar los filtros
        document.querySelectorAll('.category').forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');
    });
});

// Función para desplazar hacia arriba
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth' // Desplazamiento suave
    });
}

// Mostrar u ocultar el botón dependiendo del scroll
window.addEventListener('scroll', () => {
    const scrollToTopButton = document.querySelector('.scroll-to-top');
    if (window.scrollY > 300) {
        scrollToTopButton.style.display = 'block'; // Mostrar el botón
    } else {
        scrollToTopButton.style.display = 'none'; // Ocultar el botón
    }
});

// Añadir el evento click al botón
document.querySelector('.scroll-to-top').addEventListener('click', scrollToTop);
