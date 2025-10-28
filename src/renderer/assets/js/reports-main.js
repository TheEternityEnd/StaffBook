import '../css/stylesGlobal.css';
import '../css/stylesReports.css';

document.addEventListener('DOMContentLoaded', () => {
    // --- DATOS DE EJEMPLO ---

    // Gráficos originales de StaffBook
    const staffbookBarData = {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
        datasets: [{
            label: 'Nuevos Empleados',
            data: [5, 8, 12, 7, 9, 4],
            backgroundColor: 'rgba(7, 33, 70, 0.8)',
        }]
    };

    const staffbookPieData = {
        labels: ['Tecnología', 'Marketing', 'Recursos Humanos', 'Ventas'],
        datasets: [{
            data: [12, 8, 5, 15],
            backgroundColor: ['#3498db', '#e67e22', '#9b59b6', '#2ecc71'],
        }]
    };

    // Nuevos gráficos de ControlPermisos
    const areaPermissionsData = {
        labels: ['Sub. Servicios Administrativos', 'Dirección General', 'Sub. Académica', 'Docencia'],
        datasets: [{
            data: [8, 3, 10, 15],
            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'],
        }]
    };
    
    const monthlyPermissionsData = {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
        datasets: [{
            label: 'Permisos Solicitados',
            data: [2, 1, 3, 0, 1, 4],
            backgroundColor: '#FFCE56',
        }]
    };


    // --- RENDERIZADO DE GRÁFICOS ---

    // 1. Gráfico de Barras (Original)
    const barCtx = document.getElementById('bar-chart');
    if (barCtx) {
        new Chart(barCtx, { type: 'bar', data: staffbookBarData, options: { responsive: true } });
    }

    // 2. Gráfico de Pastel (Original)
    const pieCtx = document.getElementById('pie-chart');
    if (pieCtx) {
        new Chart(pieCtx, { type: 'pie', data: staffbookPieData, options: { responsive: true } });
    }

    // 3. Gráfico de Solicitudes por Área (Nuevo)
    const areaCtx = document.getElementById('chartArea');
    if (areaCtx) {
        new Chart(areaCtx, {
            type: 'pie',
            data: areaPermissionsData,
            options: { responsive: true, plugins: { legend: { position: 'top' }}}
        });
    }

    // 4. Gráfico de Permisos Mensuales (Nuevo)
    const individualCtx = document.getElementById('chartIndividual');
    if (individualCtx) {
        new Chart(individualCtx, {
            type: 'bar',
            data: monthlyPermissionsData,
            options: {
                responsive: true,
                scales: { y: { beginAtZero: true } }
            }
        });
    }

    // --- LÓGICA DE FILTROS (SIMULADA) ---
    
    const btnGenerate = document.querySelector('.btn-generate');
    if (btnGenerate) {
        btnGenerate.addEventListener('click', () => alert('Generando reporte...'));
    }

    const btnExport = document.querySelector('.btn-export');
    if (btnExport) {
        btnExport.addEventListener('click', () => alert('Exportando a Excel...'));
    }
    
    const empleadoSelect = document.getElementById('chartEmpleadoSelect');
    if(empleadoSelect){
        empleadoSelect.addEventListener('change', (e) => {
            const selectedEmployee = e.target.value;
            alert(`Cargando datos de permisos para: ${selectedEmployee || 'Todos'}`);
            // Aquí se actualizaría el gráfico 'chartIndividual' con datos del empleado seleccionado
        });
    }
});