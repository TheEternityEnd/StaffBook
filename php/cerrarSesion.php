<?php
session_start();
include 'conexion_be.php';  // Conexión a la base de datos

if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];

    // Registrar la acción en log_usuarios
    $accion = "cierre_sesion";
    $detalle = "Cierre de sesión desde IP: " . $_SERVER['REMOTE_ADDR'];

    // Preparar la consulta para insertar en movimientos_log
    $stmt_log = $conexion->prepare("INSERT INTO movimientos_log (usuario, accion, detalle) VALUES (?, ?, ?)");
    $stmt_log->bind_param('sss', $usuario, $accion, $detalle);
    $stmt_log->execute();
    $stmt_log->close();
}

// Destruir la sesión y redirigir al index
session_destroy();
header("location: ../index.php");
exit();
?>
