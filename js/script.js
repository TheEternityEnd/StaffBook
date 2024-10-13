// Botones para cambiar entre formularios
const toForm2Button = document.getElementById('toForm2');
const toForm1Button = document.getElementById('toForm1');

// Formularios
const form1 = document.getElementById('form1');
const form2 = document.getElementById('form2');

// Función para hacer el fade out del formulario actual y el fade in del otro
function switchForms(formToHide, formToShow) {
    formToHide.classList.remove('visible');
    setTimeout(() => {
        formToHide.style.visibility = 'hidden'; // Escondemos completamente el formulario
        formToShow.style.visibility = 'visible'; // Hacemos visible el otro formulario
        formToShow.classList.add('visible'); // Ahora el otro formulario hace el fade in
    }, 500); // Esperamos 500ms para que la transición de fade out termine
}

// Event listeners para los botones
toForm2Button.addEventListener('click', function() {
    switchForms(form1, form2); // Cambia de form1 a form2
});

toForm1Button.addEventListener('click', function() {
    switchForms(form2, form1); // Cambia de form2 a form1
});