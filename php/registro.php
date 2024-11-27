<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "admin", "railway", 3306);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Consulta SQL para obtener los empleados
$query = "SELECT nombre, puesto, email_personal, telefono, clave FROM empleados";
$result = mysqli_query($conexion, $query);

if (!$result) {
    die("Error en la consulta: " . mysqli_error($conexion));
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="registro.css">
</head>

<body>
    <!-- Barra de búsqueda, filtros y botones -->
    <div class="search-container">
        <div class="search-bar">
            <input type="text" placeholder="Buscar...">
            <button>
                <i class="fas fa-search"></i>
            </button>
        </div>

        <div class="menu-container">
            <!-- Cuadro de texto -->
            <input type="text" class="search-box" placeholder=" Filtros" readonly>

            <!-- Icono de filtro -->
            <i class="fas fa-filter filter-icon"></i>

            <!-- X para eliminar el filtro -->
            <i class="fas fa-times remove-filter"></i>

            <!-- Menú desplegable -->
            <div class="menu-desplegable">
                <div class="menu-opcion">
                    <a href="#">Funcion</a>
                    <div class="submenu">
                        <a href="#">Administrativo</a>
                        <a href="#">Analista</a>
                        <a href="#">Apoyo</a>
                        <a href="#">Docencia</a>
                        <a href="#">Incapacidad</a>
                        <a href="#">Incapacidad Permanente</a>
                        <a href="#">Servicio</a>
                    </div>
                </div>
                <div class="menu-opcion">
                    <a href="#">Opción 2</a>
                    <div class="submenu">
                        <a href="#">Sub-Opción 2-1</a>
                        <a href="#">Sub-Opción 2-2</a>
                    </div>
                </div>
                <div class="menu-opcion">
                    <a href="#">Opción 3</a>
                    <div class="submenu">
                        <a href="#">Sub-Opción 3-1</a>
                        <a href="#">Sub-Opción 3-2</a>
                        <a href="#">Sub-Opción 3-3</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Panel de cartas -->
    <div class="card-grid">
        <?php
        // Generar las cartas desde los datos de la base de datos
        while ($empleado = mysqli_fetch_assoc($result)) {
            echo '<div class="card">
                    <div class="card-header">
                        <div class="card-image">
                            <img src="https://via.placeholder.com/150" alt="Foto de ' . htmlspecialchars($empleado['nombre']) . '" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <h3>' . htmlspecialchars($empleado['nombre']) . '</h3>
                    </div>
                    <p>' . htmlspecialchars($empleado['puesto']) . '</p>
                    <p>' . htmlspecialchars($empleado['email_personal']) . '</p>
                    <p>' . htmlspecialchars($empleado['telefono']) . '</p>
                    <p>' . htmlspecialchars($empleado['clave']) . '</p>
                </div>';
        }
        ?>
    </div>

    <!-- Paginación o navegación -->
    <div class="pagination" id="pagination">
        <!-- La paginación puede generarse dinámicamente aquí -->
    </div>

    <script src="registro.js"></script>
</body>

</html>

<?php
// Cerrar la conexión
mysqli_close($conexion);
?>
