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
</head>

<body>
    <header>
        <div class="container">
            <div class="header-content">
                <h1>AGENDA DEL INSTITUTO TECNOLOGICO SUPERIOR DE PUERTO PEÑASCO</h1>
                <div class="user-info">
                    <img src="https://dummyimage.com/40x40/000/fff.png" alt="Foto de perfil">
                    <div>
                        <p>Jane Doe</p>
                        <p type="button" class="btnLogout" onclick="cerrarSesion()">Cerrar Sesion</p>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="main-wrapper">
        <aside class="sidebar">
            <nav>
                <a href="#" aria-label="Ir a Registro"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>Registro</a>
                <a href="#" aria-label="Ir a Exportar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>Exportar</a>
                <a href="#" aria-label="Ir a Ajustes"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>Ajustes</a>
            </nav>
        </aside>
        <main class="main-content">
            <div class="panel">
                <!--Barra de busqueda, filtros y botones-->
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search...">
                    <button class="search-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>    
                    </button>
                </div>

                <!--panel de items-->
                <div class="card-grid">
                    <!-- Repetir este bloque 8 veces para los 8 estudiantes -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-image"></div>
                            <div>
                                <h3>John Doe</h3>
                                <p>Ingeniería en Sistemas</p>
                            </div>
                        </div>
                        <div>
                            <p>ing.johndoe@gmail.com</p>
                            <p>6381120930</p>
                            <p>&lt;ID de empleado&gt;</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-image"></div>
                            <div>
                                <h3>John Doe</h3>
                                <p>Ingeniería en Sistemas</p>
                            </div>
                        </div>
                        <div>
                            <p>ing.johndoe@gmail.com</p>
                            <p>6381120930</p>
                            <p>&lt;ID de empleado&gt;</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-image"></div>
                            <div>
                                <h3>John Doe</h3>
                                <p>Ingeniería en Sistemas</p>
                            </div>
                        </div>
                        <div>
                            <p>ing.johndoe@gmail.com</p>
                            <p>6381120930</p>
                            <p>&lt;ID de empleado&gt;</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-image"></div>
                            <div>
                                <h3>John Doe</h3>
                                <p>Ingeniería en Sistemas</p>
                            </div>
                        </div>
                        <div>
                            <p>ing.johndoe@gmail.com</p>
                            <p>6381120930</p>
                            <p>&lt;ID de empleado&gt;</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-image"></div>
                            <div>
                                <h3>John Doe</h3>
                                <p>Ingeniería en Sistemas</p>
                            </div>
                        </div>
                        <div>
                            <p>ing.johndoe@gmail.com</p>
                            <p>6381120930</p>
                            <p>&lt;ID de empleado&gt;</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-image"></div>
                            <div>
                                <h3>John Doe</h3>
                                <p>Ingeniería en Sistemas</p>
                            </div>
                        </div>
                        <div>
                            <p>ing.johndoe@gmail.com</p>
                            <p>6381120930</p>
                            <p>&lt;ID de empleado&gt;</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-image"></div>
                            <div>
                                <h3>John Doe</h3>
                                <p>Ingeniería en Sistemas</p>
                            </div>
                        </div>
                        <div>
                            <p>ing.johndoe@gmail.com</p>
                            <p>6381120930</p>
                            <p>&lt;ID de empleado&gt;</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-image"></div>
                            <div>
                                <h3>John Doe</h3>
                                <p>Ingeniería en Sistemas</p>
                            </div>
                        </div>
                        <div>
                            <p>ing.johndoe@gmail.com</p>
                            <p>6381120930</p>
                            <p>&lt;ID de empleado&gt;</p>
                        </div>
                    </div>
                    <!-- Fin del bloque repetido -->
                </div>

                <!-- Paginacion o navegacion-->
                <div class="pagination">
                    <button aria-label="Página anterior">&lt;</button>
                    <button class="active">1</button>
                    <button>2</button>
                    <button>3</button>
                    <span>...</span>
                    <button>23</button>
                    <button>24</button>
                    <button aria-label="Página siguiente">&gt;</button>
                </div>
            </div>
        </main>
    </div>
    <script src="js/mainScript.js "></script>
</body>

</html>