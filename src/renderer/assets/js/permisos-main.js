
import '../css/stylesGlobal.css';
import '../css/stylesPermisos.css';

// Script para manejar la ventana modal
const modal = document.getElementById('permisoModal');
const btn = document.getElementById('solicitarPermisoBtn');
const span = document.getElementsByClassName('close-btn')[0];

btn.onclick = () => modal.style.display = 'block';
span.onclick = () => modal.style.display = 'none';
window.onclick = (event) => {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
};