const filterIcon = document.querySelector('.filter-icon');
const removeFilterIcon = document.querySelector('.remove-filter');
const menuDesplegable = document.querySelector('.menu-desplegable');
const searchBox = document.querySelector('.search-box');

function cerrarSesion() {
    // Redirigir al archivo cerrarSesion.php
    window.location.href = 'php/cerrarSesion.php';
}

// Alternar visibilidad del menú al hacer clic en el icono de filtro
function toggleMenu(event) {
    event.stopPropagation();
    menuDesplegable.style.display = menuDesplegable.style.display === 'block' ? 'none' : 'block';
}

// Ocultar el menú si se hace clic fuera de él
function closeMenu(event) {
    if (!menuDesplegable.contains(event.target) && event.target !== filterIcon && event.target !== removeFilterIcon) {
        menuDesplegable.style.display = 'none';
    }
}

// Aplicar el filtro y actualizar el cuadro de texto
function applyFilter(menuOption, subMenuOption) {
    searchBox.value = `${menuOption}: ${subMenuOption}`;
    filterIcon.style.display = 'none'; // Cambiar el icono del filtro por la X
    removeFilterIcon.style.display = 'block';
    menuDesplegable.style.display = 'none'; // Ocultar menú
}

// Eliminar el filtro y limpiar el cuadro de texto
function removeFilter() {
    searchBox.value = ''; // Limpiar el cuadro de texto
    filterIcon.style.display = 'block'; // Mostrar el icono de filtro
    removeFilterIcon.style.display = 'none'; // Ocultar la X
}

// Añadir eventos de clic para cada opción de submenú
document.querySelectorAll('.menu-opcion').forEach(menu => {
    const menuText = menu.querySelector('a').textContent;
    menu.querySelectorAll('.submenu a').forEach(subMenu => {
        subMenu.addEventListener('click', (event) => {
            event.stopPropagation();
            const subMenuText = subMenu.textContent;
            applyFilter(menuText, subMenuText);
        });
    });
});

// Evento para mostrar/ocultar el menú al hacer clic en el icono de filtro
filterIcon.addEventListener('click', toggleMenu);

// Evento para cerrar el menú al hacer clic en cualquier lugar de la página
document.addEventListener('click', closeMenu);

// Evento para eliminar el filtro al hacer clic en la X
removeFilterIcon.addEventListener('click', removeFilter);