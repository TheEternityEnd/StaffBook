import  '../css/stylesGlobal.css';
import  '../css/stylesSettings.css';
import  '../css/stylesSettings1.css';

document.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelectorAll('.tab');
    const tabContents = document.querySelectorAll('.tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // Quitar la clase 'active' de todas las pestañas y contenidos
            tabs.forEach(t => t.classList.remove('active'));
            tabContents.forEach(c => c.classList.remove('active'));

            // Añadir 'active' a la pestaña seleccionada y su contenido
            tab.classList.add('active');
            const activeContent = document.getElementById(tab.dataset.tab);
            if (activeContent) {
                activeContent.classList.add('active');
            }
        });
    });
});