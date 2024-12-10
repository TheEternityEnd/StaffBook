<?php
include 'conexion_be.php';

if (isset($_POST['ids'])) {
    $ids = $_POST['ids']; // Array de IDs seleccionados

    // Convertir los IDs en una cadena separada por comas para la consulta SQL
    $ids_string = implode(',', $ids);

    $sql = "DELETE FROM empleados WHERE id IN ($ids_string)";
    if ($conexion->query($sql) === TRUE) {
        echo "Registros eliminados exitosamente.";
        header("location: ../main.php");

    } else {
        echo "Error al eliminar registros: " . $conexion->error;
    }
} else {
    echo "No se seleccionaron registros para eliminar.";
}

$conexion->close();
?>
