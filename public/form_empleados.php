<?php
    session_start();

    if(!isset($_SESSION['usuario'])){
        header("location: index.php");
        session_destroy();
        die();
    }
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

    <!--Formulario de registro-->
    <div class="container">
        <h1>Formulario de Registro de Empleado</h1>
        <form>
            <div>
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div>
                <label for="clave">Clave</label>
                <input type="text" id="clave" name="clave" required>
            </div>
            <div>
                <label for="funcion_empleado">Función del Empleado</label>
                <input type="text" id="funcion_empleado" name="funcion_empleado" required>
            </div>
            <div>
                <label for="tipo_empleado">Tipo de Empleado</label>
                <input type="text" id="tipo_empleado" name="tipo_empleado" required>
            </div>
            <div>
                <label for="area">Área</label>
                <input type="text" id="area" name="area" required>
            </div>
            <div>
                <label for="puesto">Puesto</label>
                <input type="text" id="puesto" name="puesto" required>
            </div>
            <div>
                <label for="escolaridad">Escolaridad</label>
                <input type="text" id="escolaridad" name="escolaridad" required>
            </div>
            <div>
                <label for="sexo">Sexo</label>
                <select id="sexo" name="sexo" required>
                    <option value="Hombre">Hombre</option>
                    <option value="Mujer">Mujer</option>
                </select>
            </div>
            <div>
                <label for="tipo_sangre">Tipo de Sangre</label>
                <input type="text" id="tipo_sangre" name="tipo_sangre" required>
            </div>
            <div>
                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
            </div>
            <div>
                <label for="estado_civil">Estado Civil</label>
                <input type="text" id="estado_civil" name="estado_civil" required>
            </div>
            <div>
                <label for="curp">CURP</label>
                <input type="text" id="curp" name="curp" required>
            </div>
            <div>
                <label for="rfc">RFC</label>
                <input type="text" id="rfc" name="rfc" required>
            </div>
            <div>
                <label for="afiliacion">Afiliación</label>
                <input type="text" id="afiliacion" name="afiliacion" required>
            </div>
            <div>
                <label for="fecha_ingreso">Fecha de Ingreso</label>
                <input type="date" id="fecha_ingreso" name="fecha_ingreso" required>
            </div>
            <div>
                <label for="fecha_baja">Fecha de Baja</label>
                <input type="date" id="fecha_baja" name="fecha_baja">
            </div>
            <div>
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono" required>
            </div>
            <div>
                <label for="domicilio">Domicilio</label>
                <input type="text" id="domicilio" name="domicilio" required>
            </div>
            <div>
                <label for="email_personal">Email Personal</label>
                <input type="email" id="email_personal" name="email_personal" required>
            </div>
            <div>
                <label for="email_tecnm">Email TecNM</label>
                <input type="email" id="email_tecnm" name="email_tecnm" required>
            </div>
            <div class="upload-image-section">
                <label for="imagen_empleado">Subir Imagen del Empleado (5 MB)</label>
                <input type="file" id="imagen_empleado" name="imagen_empleado" accept="image/*">
            </div>
            <button type="submit">Registrar Empleado</button>
        </form>
    </div>
</body>
</html>
