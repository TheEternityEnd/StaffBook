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
</head>
<body>
    <h1>Hola Mundo!</h1>
    <a href="php/cerrarSesion.php">Cerrar Sesion</a>
</body>
</html>