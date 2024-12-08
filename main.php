<?php
    session_start();

    if(!isset($_SESSION['usuario'])){
        header("location: index.php");
        session_destroy();
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StaffBook</title>
    <link rel="stylesheet" href="css/mainStyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <!--Header de la pagina-->
    <header class="header">
        <div class="left-section">
            <div class="menu-icon" onclick="toggleMenuSidebar()">
                <span>&#9776;</span>
            </div>
            <div class="logo">
                <h1>StaffBook</h1>
            </div>
        </div>
        <div class="search-bar">
            <div class="search-container">
                <button class="search-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </button>
                <input type="text" placeholder="Buscar">
            </div>
        </div>
        <div class="profile" onclick="toggleSidebar()">
            <img src="https://dummyimage.com/50x50/000/fff.png" alt="Profile Picture" class="profile-img">
            <span>Quandale Dingle</span>
        </div>
    </header>

    <!--Sidebar derecho del perfil de usuario-->
    <div class="sidebar-overlay" id="sidebar-overlay" onclick="toggleSidebar()"></div>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <img src="https://dummyimage.com/80x80/000/fff.png" alt="Profile Picture" class="sidebar-img">
            <div>
                <h3>Quandale Dingle</h3>
                <p>email@example.com</p>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li><span>⚙️</span> Configuración</li>
            <li><span>🗂️</span> Historial</li>
            <li><span>📊</span> Exportar a Excel</li>
        </ul>
        <button class="logout" onclick="showLogoutConfirmation()"><span>⬅️</span> Cerrar Sesión</button>
    </div>

    <!-- Sidebar izquierdo de menu-->
    <div class="menu-overlay" id="menu-overlay" onclick="toggleMenuSidebar()"></div>
    <div class="menu-sidebar" id="menu-sidebar">
        <div class="menu-header">
            <button class="menu-close" onclick="toggleMenuSidebar()">⬅️</button>
        </div>
        <ul class="menu-items">
            <li>
                <form action="php/redirigirEmpleado.php" method="POST" style="display: inline;">
                    <button type="submit" style="background: none; border: none; font-size: inherit; cursor: pointer;">
                        <span>👤➕</span> Agregar Empleado
                    </button>
                </form>
            </li>
            <li>
                <span>📖</span> 
                <a href="public/StaffBook - Guia de usuario.pdf" target="_blank" style="text-decoration: none; color: inherit;">Guía</a>
            </li>
        </ul>
    </div>

    <!--Filtros-->
    <main class="filters-section">
        <div class="categories">
            <button class="category active">Todos</button>
            <button class="category">Administrativo</button>
            <button class="category">Analista</button>
            <button class="category">Apoyo</button>
            <button class="category">Docencia</button>
            <button class="category">Incapacidad</button>
            <button class="category">Incapacidad Permanente</button>
            <button class="category">Servicio</button>
        </div>

        <div class="alphabet">
            <button class="letter">All</button>
            <button class="letter">A</button>
            <button class="letter">B</button>
            <button class="letter">C</button>
            <button class="letter">D</button>
            <button class="letter">E</button>
            <button class="letter">F</button>
            <button class="letter">G</button>
            <button class="letter">H</button>
            <button class="letter">I</button>
            <button class="letter">J</button>
            <button class="letter">K</button>
            <button class="letter">L</button>
            <button class="letter">M</button>
            <button class="letter">N</button>
            <!--Me importa un carajo si falta la "ñ", ningun jodido nombre empieza con esa letra-->
            <button class="letter">O</button>
            <button class="letter">P</button>
            <button class="letter">Q</button>
            <button class="letter">R</button>
            <button class="letter">S</button>
            <button class="letter">T</button>
            <button class="letter">U</button>
            <button class="letter">V</button>
            <button class="letter">W</button>
            <button class="letter">X</button>
            <button class="letter">Y</button>
            <button class="letter">Z</button>
        </div>

        <div class="filters">
            <select>
                <option>Puesto</option>
                <option>Administrativo</option>
                <option>Analista</option>
                <option>Docente</option>
            </select>
            <select>
                <option>Sexo</option>
                <option>Masculino</option>
                <option>Femenino</option>
            </select>
            <select>
                <option>T.S.</option>
                <option>Técnico</option>
                <option>Superior</option>
            </select>
            <select>
                <option>Escolaridad</option>
                <option>Bachillerato</option>
                <option>Licenciatura</option>
                <option>Maestría</option>
            </select>
            <select>
                <option>Tipo</option>
                <option>Tiempo Completo</option>
                <option>Medio Tiempo</option>
            </select>
            <button class="reset-filters">
                <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 100 125" x="0px" y="0px" width="55" height="55" fill="#B0B0B0">
                    <path d="M81.12,77.88l-6.88-6.88,6.88-6.88c.57-.57,.88-1.32,.88-2.12s-.31-1.55-.88-2.12h0c-1.13-1.13-3.11-1.13-4.24,0l-6.88,6.88-6.88-6.88c-1.13-1.13-3.11-1.13-4.24,0-.57,.57-.88,1.32-.88,2.12s.31,1.55,.88,2.12l6.88,6.88-6.88,6.88c-.57,.57-.88,1.32-.88,2.12s.31,1.55,.88,2.12c1.13,1.14,3.11,1.14,4.24,0l6.88-6.88,6.88,6.88c1.13,1.13,3.11,1.13,4.24,0,.57-.57,.88-1.32,.88-2.12s-.31-1.55-.88-2.12Z"/>
                    <path d="M72,29.51v-5.51c0-3.87-3.13-7-7-7H25c-3.87,0-7,3.13-7,7v5.51c0,3.47,1.35,6.74,3.81,9.19l12.19,12.19v21.1c0,2.44,1.24,4.67,3.32,5.95,2.03,1.25,4.68,1.38,6.81,.31l4.1-2.05c1.48-.74,2.19-2.54,1.48-4.03-.35-.74-.98-1.3-1.76-1.56-.76-.25-1.57-.2-2.29,.16l-4.21,2.11c-.66,.33-1.45-.15-1.45-.89v-23.59l-13.95-13.95c-1.32-1.32-2.05-3.08-2.05-4.95v-5.51c0-.55,.45-1,1-1h40c.55,0,1,.45,1,1v5.51c0,1.87-.73,3.63-2.05,4.95l-10.34,10.34c-.52,.52-.88,1.19-.94,1.93-.08,.9,.24,1.76,.87,2.39,1.13,1.14,3.11,1.14,4.24,0l10.42-10.41c2.46-2.45,3.81-5.72,3.81-9.19Z"/>
                </svg>
            </button>
        </div>
    </main>

    <!--Grid de la pagina-->
    <div class="card-grid">
        <button class="card" onclick="openEmployeeDetails()">
            <img src="https://dummyimage.com/180x180/000/fff" alt="Foto de perfil" class="card-img">
            <h3 class="card-name">Aaron Campbell</h3>
            <p class="card-role">Administrativo</p>
            <p class="card-info">📞 638-105-5882</p>
            <p class="card-info">📅 17/mar/94</p>
            <p class="card-info">✉️ email@example.com</p>
        </button>
        <button class="card" onclick="openEmployeeDetails()">
            <img src="https://dummyimage.com/180x180/000/fff" alt="Foto de perfil" class="card-img">
            <h3 class="card-name">Aaron Campbell</h3>
            <p class="card-role">Administrativo</p>
            <p class="card-info">📞 638-105-5882</p>
            <p class="card-info">📅 17/mar/94</p>
            <p class="card-info">✉️ email@example.com</p>
        </button>
        <button class="card" onclick="openEmployeeDetails()">
            <img src="https://dummyimage.com/180x180/000/fff" alt="Foto de perfil" class="card-img">
            <h3 class="card-name">Aaron Campbell</h3>
            <p class="card-role">Administrativo</p>
            <p class="card-info">📞 638-105-5882</p>
            <p class="card-info">📅 17/mar/94</p>
            <p class="card-info">✉️ email@example.com</p>
        </button>
        <button class="card" onclick="openEmployeeDetails()">
            <img src="https://dummyimage.com/180x180/000/fff" alt="Foto de perfil" class="card-img">
            <h3 class="card-name">Aaron Campbell</h3>
            <p class="card-role">Administrativo</p>
            <p class="card-info">📞 638-105-5882</p>
            <p class="card-info">📅 17/mar/94</p>
            <p class="card-info">✉️ email@example.com</p>
        </button>
        <button class="card" onclick="openEmployeeDetails()">
            <img src="https://dummyimage.com/180x180/000/fff" alt="Foto de perfil" class="card-img">
            <h3 class="card-name">Aaron Campbell</h3>
            <p class="card-role">Administrativo</p>
            <p class="card-info">📞 638-105-5882</p>
            <p class="card-info">📅 17/mar/94</p>
            <p class="card-info">✉️ email@example.com</p>
        </button>
        <button class="card" onclick="openEmployeeDetails()">
            <img src="https://dummyimage.com/180x180/000/fff" alt="Foto de perfil" class="card-img">
            <h3 class="card-name">Aaron Campbell</h3>
            <p class="card-role">Administrativo</p>
            <p class="card-info">📞 638-105-5882</p>
            <p class="card-info">📅 17/mar/94</p>
            <p class="card-info">✉️ email@example.com</p>
        </button>
        <button class="card" onclick="openEmployeeDetails()">
            <img src="https://dummyimage.com/180x180/000/fff" alt="Foto de perfil" class="card-img">
            <h3 class="card-name">Aaron Campbell</h3>
            <p class="card-role">Administrativo</p>
            <p class="card-info">📞 638-105-5882</p>
            <p class="card-info">📅 17/mar/94</p>
            <p class="card-info">✉️ email@example.com</p>
        </button>
        <button class="card" onclick="openEmployeeDetails()">
            <img src="https://dummyimage.com/180x180/000/fff" alt="Foto de perfil" class="card-img">
            <h3 class="card-name">Aaron Campbell</h3>
            <p class="card-role">Administrativo</p>
            <p class="card-info">📞 638-105-5882</p>
            <p class="card-info">📅 17/mar/94</p>
            <p class="card-info">✉️ email@example.com</p>
        </button>
        <button class="card" onclick="openEmployeeDetails()">
            <img src="https://dummyimage.com/180x180/000/fff" alt="Foto de perfil" class="card-img">
            <h3 class="card-name">Aaron Campbell</h3>
            <p class="card-role">Administrativo</p>
            <p class="card-info">📞 638-105-5882</p>
            <p class="card-info">📅 17/mar/94</p>
            <p class="card-info">✉️ email@example.com</p>
        </button>
        <button class="card" onclick="openEmployeeDetails()">
            <img src="https://dummyimage.com/180x180/000/fff" alt="Foto de perfil" class="card-img">
            <h3 class="card-name">Aaron Campbell</h3>
            <p class="card-role">Administrativo</p>
            <p class="card-info">📞 638-105-5882</p>
            <p class="card-info">📅 17/mar/94</p>
            <p class="card-info">✉️ email@example.com</p>
        </button>
        <button class="card" onclick="openEmployeeDetails()">
            <img src="https://dummyimage.com/180x180/000/fff" alt="Foto de perfil" class="card-img">
            <h3 class="card-name">Aaron Campbell</h3>
            <p class="card-role">Administrativo</p>
            <p class="card-info">📞 638-105-5882</p>
            <p class="card-info">📅 17/mar/94</p>
            <p class="card-info">✉️ email@example.com</p>
        </button>
        <button class="card" onclick="openEmployeeDetails()">
            <img src="https://dummyimage.com/180x180/000/fff" alt="Foto de perfil" class="card-img">
            <h3 class="card-name">Aaron Campbell</h3>
            <p class="card-role">Administrativo</p>
            <p class="card-info">📞 638-105-5882</p>
            <p class="card-info">📅 17/mar/94</p>
            <p class="card-info">✉️ email@example.com</p>
        </button>
        <button class="card" onclick="openEmployeeDetails()">
            <img src="https://dummyimage.com/180x180/000/fff" alt="Foto de perfil" class="card-img">
            <h3 class="card-name">Aaron Campbell</h3>
            <p class="card-role">Administrativo</p>
            <p class="card-info">📞 638-105-5882</p>
            <p class="card-info">📅 17/mar/94</p>
            <p class="card-info">✉️ email@example.com</p>
        </button>
        <button class="card" onclick="openEmployeeDetails()">
            <img src="https://dummyimage.com/180x180/000/fff" alt="Foto de perfil" class="card-img">
            <h3 class="card-name">Aaron Campbell</h3>
            <p class="card-role">Administrativo</p>
            <p class="card-info">📞 638-105-5882</p>
            <p class="card-info">📅 17/mar/94</p>
            <p class="card-info">✉️ email@example.com</p>
        </button>
        <button class="card" onclick="openEmployeeDetails()">
            <img src="https://dummyimage.com/180x180/000/fff" alt="Foto de perfil" class="card-img">
            <h3 class="card-name">Aaron Campbell</h3>
            <p class="card-role">Administrativo</p>
            <p class="card-info">📞 638-105-5882</p>
            <p class="card-info">📅 17/mar/94</p>
            <p class="card-info">✉️ email@example.com</p>
        </button>
        <button class="card" onclick="openEmployeeDetails()">
            <img src="https://dummyimage.com/180x180/000/fff" alt="Foto de perfil" class="card-img">
            <h3 class="card-name">Aaron Campbell</h3>
            <p class="card-role">Administrativo</p>
            <p class="card-info">📞 638-105-5882</p>
            <p class="card-info">📅 17/mar/94</p>
            <p class="card-info">✉️ email@example.com</p>
        </button>
    </div>

    <!-- Cuadro de detalles del empleado -->
    <div class="employee-details-overlay" id="employee-details-overlay" onclick="closeEmployeeDetails()"></div>
    <div class="employee-details" id="employee-details">
        <!-- Sección superior -->
        <div class="details-top">
            <img src="https://dummyimage.com/230x230/000/fff" alt="Foto de perfil">
            <div>
                <h1>Aaron Campbell</h1>
                <p>525</p>
                <p>Administrativo</p>
                <p>Jefe del departamento de Extraescolares y de Innovacion y Calidad</p>
                <p>Confianza</p>
                <p>jose.ag@puertopeñasco.tecnm.mx</p>
            </div>
        </div>

        <!-- Sección media -->
        <div class="details-middle">
            <p><strong>Email:</strong> <span>email@example.com</span></p>
            <p><strong>Teléfono:</strong> <span>638-105-5882</span></p>
            <p><strong>Cumpleaños:</strong> <span>17 marzo</span></p>
            <p><strong>Ingreso:</strong> <span>17 marzo</span></p>
            <p><strong>Baja:</strong> <span>NA</span></p>
            <p><strong>Afiliación:</strong> <span>11585501</span></p>
        </div>

        <!-- Sección inferior -->
        <div class="details-bottom">
            <p><strong>Tipo de sangre:</strong> <span>A+</span></p>
            <p><strong>Sexo:</strong> <span>Hombre</span></p>
            <p><strong>Estado Civil:</strong> <span>Soltero</span></p>
            <p><strong>CURP:</strong> <span>AEMA940317MSRNCL04</span></p>
            <p><strong>Puesto:</strong> <span>SUB. DE PLAN. Y VINCULACIÓN</span></p>
            <p><strong>Domicilio:</strong> <span>CALLEJÓN MELCHOR OCAMPO ENTRE AVE. LOS ANGELES Y 2 DE NOV. No.423</span></p>
            <p><strong>Escolaridad:</strong> <span>LIC. EN DERECHO</span></p>
            <p><strong>RFC:</strong> <span>AEMA940317N74</span></p>
        </div>
        <!-- Botón de edición dentro del .employee-details-overlay -->
        <button class="edit-button" onclick="editEmployeeDetails(event)">
            ✏️
        </button>

    </div>


    <!--Boton para ir arriba de la pagina-->
    <button class="scroll-to-top">
        <svg xmlns="http://www.w3.org/2000/svg" width="43" height="43" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="18 15 12 9 6 15"></polyline>
        </svg>
    </button>

    <!-- Ventana de confirmación para cerrar sesión -->
    <div class="confirm-logout-overlay" id="confirm-logout-overlay" onclick="closeLogoutConfirmation()"></div>
    <div class="confirm-logout" id="confirm-logout">
        <p>¿Seguro que quieres cerrar sesión?</p>
        <div class="confirm-buttons">
            <button class="confirm-logout-btn" onclick="cerrarSesion()">Cerrar sesión</button>
            <button class="cancel-logout-btn" onclick="closeLogoutConfirmation()">Cancelar</button>
        </div>
    </div>

    <!--Script-->
    <script src="./js/mainScript.js"></script>
</body>

</html>