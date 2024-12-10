<?php
    session_start();
    include '../php/conexion_be.php';

    if (!isset($_SESSION['usuario'])) {
        header("location: ../index.php");
        session_destroy();
        die();
    }

    // Verificar si el ID está presente en la URL
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        echo "ID del empleado no proporcionado.";
        exit;
    }

    $id = $_GET['id'];

    // Consulta para obtener los datos del empleado
    $query = "SELECT * FROM empleados WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "Empleado no encontrado.";
        exit;
    }

    $empleado = $result->fetch_assoc();
    $stmt->close();
    $conexion->close();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro de Empleado</title>
    <link rel="stylesheet" href="../css/form-empleadosStyles.css">
</head>
<body>
    <!--Header-->
    <header class="header">
        <div class="left-section">
            <div class="menu-icon" onclick="toggleMenuSidebar()">
                <span>&#9776;</span>
            </div>
            <div class="logo">
                <form action="../php/redirigirMain.php" method="POST" class="staffbook-button">
                    <button type="submit" class="staffbook-button">
                        <h1>StaffBook</h1>
                    </button>
                </form>
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
        <button class="logout" onclick="showLogoutConfirmation()" style="background: none;"><span>⬅️</span> Cerrar Sesión</button>
    </div>

    <!-- Sidebar izquierdo de menu-->
    <div class="menu-overlay" id="menu-overlay" onclick="toggleMenuSidebar()"></div>
    <div class="menu-sidebar" id="menu-sidebar">
        <div class="menu-header">
            <button class="menu-close" style="background: none;" onclick="toggleMenuSidebar()">⬅️</button>
        </div>
        <ul class="menu-items">
            <li>
                <form action="../php/redirigirEmpleado.php" method="POST" style="display: inline;">
                    <button type="submit" style="background: none; border: none; font-size: inherit; cursor: pointer; color: black">
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

    <!-- Ventana de confirmación para cerrar sesión -->
    <div class="confirm-logout-overlay" id="confirm-logout-overlay" onclick="closeLogoutConfirmation()"></div>
    <div class="confirm-logout" id="confirm-logout">
        <p>¿Seguro que quieres cerrar sesión?</p>
        <div class="confirm-buttons">
            <button class="confirm-logout-btn" onclick="cerrarSesion1()">Cerrar sesión</button>
            <button class="cancel-logout-btn" onclick="closeLogoutConfirmation()">Cancelar</button>
        </div>
    </div>

    <!--Formulario de registro-->
    
    <div class="container">
        <h1>Formulario de Registro de Empleado</h1>
        <form action="../php/procesar_empleado.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div>
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($empleado['nombre'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div>
                <label for="clave">Clave</label>
                <input type="text" id="clave" name="clave" value="<?php echo htmlspecialchars($empleado['clave'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div>
                <label for="funcion_empleado">Función del Empleado</label>
                <select id="funcion_empleado" name="funcion_empleado" required>
                    <option value="NA">-Seleccione una opcion-</option>
                    <option value="Administrativo" <?php if ($empleado['funcion_empleado'] === 'Administrativo') echo 'selected'; ?>>Administrativo</option>
                    <option value="Analista" <?php if ($empleado['funcion_empleado'] === 'Analista') echo 'selected'; ?>>Analista</option>
                    <option value="Apoyo" <?php if ($empleado['funcion_empleado'] === 'Apoyo') echo 'selected'; ?>>Apoyo</option>
                    <option value="Docencia" <?php if ($empleado['funcion_empleado'] === 'Docencia') echo 'selected'; ?>>Docencia</option>
                    <option value="Incapacidad" <?php if ($empleado['funcion_empleado'] === 'Incapacidad') echo 'selected'; ?>>Incapacidad</option>
                    <option value="Incapacidad Permanente" <?php if ($empleado['funcion_empleado'] === 'Incapacidad Permanente') echo 'selected'; ?>>Incapacidad Permanente</option>
                    <option value="Servicio" <?php if ($empleado['funcion_empleado'] === 'Servicio') echo 'selected'; ?>>Servicio</option>
                </select>
            </div>
            <div>
                <label for="tipo_empleado">Tipo de Empleado</label>
                <select type="text" id="tipo_empleado" name="tipo_empleado" required>
                    <option value="NA">-Seleccione una opcion-</option>
                    <option value="Confianza" <?php if ($empleado['tipo_empleado'] === 'Confianza') echo 'selected'; ?>>Confianza</option>
                    <option value="Determinado">Determinado</option>
                    <option value="Indeterminado">Indeterminado</option>
                    <option value="Eventual">Eventual</option>
                </select>
            </div>
            <div>
                <label for="area">Área</label>
                <select id="area" name="area" required>
                    <option value="NA">-Seleccione una opcion-</option>
                    <option value="Sub. de Serv. Administrativos">Sub. de Serv. Administrativos</option>
                    <option value="Direccion General">Direccion General</option>
                    <option value="Sub. Academica">Sub. Academica</option>
                    <option value="Sub. de Admon. y Finanzas">Sub. de Admon. y Finanzas</option>
                    <option value="Sub. de Plan. y Vinculacion">Sub. de Plan. y Vinculacion</option>
                </select>
            </div>
            <div>
                <label for="puesto">Puesto</label>
                <input type="text" id="puesto" name="puesto" value="<?php echo htmlspecialchars($empleado['puesto'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div>
                <label for="escolaridad">Escolaridad</label>
                <select id="escolaridad" name="escolaridad" required>
                    <option value="NA">-Selecciona una opcion-</option>
                    <option value="Ing. en Sistemas Computacionales">Ing. en Sistemas Computacionales</option>
                    <option value="Ing. Civil">Ing. Civil</option>
                    <option value="Ing. Industrial">Ing. Industrial</option>
                    <option value="Lic. en Administracion">Lic. en Administracion</option>
                    <option value="No es Docente">No es Docente</option>
                </select>
            </div>
            <div>
                <label for="sexo">Sexo</label>
                <select id="sexo" name="sexo" required>
                    <option value="NA">-Seleccione una opcion-</option>
                    <option value="Hombre">Hombre</option>
                    <option value="Mujer">Mujer</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>
            <div>
                <label for="tipo_sangre">Tipo de Sangre</label>
                <select id="tipo_sangre" name="tipo_sangre" required>
                    <option value="NA">-Seleccione una opcion-</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB+">AB+</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>
            </div>
            <div>
                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo htmlspecialchars($empleado['fecha_nacimiento'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div>
                <label for="estado_civil">Estado Civil</label>
                <select id="estado_civil" name="estado_civil" required>
                    <option value="NA">-Seleccione una opcion-</option>
                    <option value="Casado">Casado</option>
                    <option value="Soltero">Soltero</option>
                    <option value="Viudo">Viudo</option>
                    <option value="Divorciado">Divorciado</option>
                </select>
            </div>
            <div>
                <label for="curp">CURP</label>
                <input type="text" id="curp" name="curp" value="<?php echo htmlspecialchars($empleado['curp'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div>
                <label for="rfc">RFC</label>
                <input type="text" id="rfc" name="rfc" value="<?php echo htmlspecialchars($empleado['rfc'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div>
                <label for="afiliacion">Afiliación</label>
                <input type="text" id="afiliacion" name="afiliacion" value="<?php echo htmlspecialchars($empleado['afiliacion'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div>
                <label for="fecha_ingreso">Fecha de Ingreso</label>
                <input type="date" id="fecha_ingreso" name="fecha_ingreso" value="<?php echo htmlspecialchars($empleado['fecha_ingreso'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div>
                <label for="fecha_baja">Fecha de Baja</label>
                <input type="date" id="fecha_baja" name="fecha_baja" value="<?php echo htmlspecialchars($empleado['fecha_baja'], ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div>
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($empleado['telefono'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div>
                <label for="domicilio">Domicilio</label>
                <input type="text" id="domicilio" name="domicilio" value="<?php echo htmlspecialchars($empleado['domicilio'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div>
                <label for="email_personal">Email Personal</label>
                <input type="email" id="email_personal" name="email_personal" value="<?php echo htmlspecialchars($empleado['email_personal'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div>
                <label for="email_tecnm">Email TecNM</label>
                <input type="email" id="email_tecnm" name="email_tecnm" value="<?php echo htmlspecialchars($empleado['email_tecnm'], ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>
            <div class="upload-image-section">
                <label for="imagen_empleado">Subir Imagen del Empleado (PNG o JPG, 5MB)</label>
                <input 
                    type="file" 
                    id="imagen_empleado" 
                    name="imagen_empleado" 
                    accept=".png, .jpg" 
                    onchange="validateImage()" 
                    value="<?php echo htmlspecialchars($empleado['img'], ENT_QUOTES, 'UTF-8'); ?>"
                >
                <p id="image-error" style="color: red; font-size: 14px; display: none;">El archivo debe ser una imagen PNG o JPG menor a 5 MB.</p>
            </div>

            <button type="submit">Registrar Empleado</button>
        </form>
    </div>

    <script src="../js/form_empleadosScript.js"></script>
    <script src="../js/mainScript.js"></script>
</body>
</html>
