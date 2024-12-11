<?php
include './conexion_be.php';
session_start(); // Asegurar que la sesión esté iniciada

if (isset($_POST['ids'])) {
    $ids = $_POST['ids']; // Array de IDs seleccionados

    // Convertir los IDs en una cadena separada por comas para la consulta SQL
    $ids_string = implode(',', $ids);

    // Obtener los nombres de los empleados antes de eliminarlos
    $query_nombres = "SELECT nombre FROM empleados WHERE id IN ($ids_string)";
    $result_nombres = $conexion->query($query_nombres);

    if ($result_nombres) {
        $nombres = [];
        while ($row = $result_nombres->fetch_assoc()) {
            $nombres[] = $row['nombre'];
        }

        // Verificar si el usuario está almacenado en la sesión
        if (isset($_SESSION['usuario'])) {
            $usuario = $conexion->real_escape_string($_SESSION['usuario']);
        } else {
            echo "Error: No se encontró información del usuario en la sesión.";
            exit;
        }

        // Eliminar los empleados
        $sql = "DELETE FROM empleados WHERE id IN ($ids_string)";
        if ($conexion->query($sql) === TRUE) {
            echo "Registros eliminados exitosamente.";

            // Registrar en la tabla movimientos_log
            $fecha_hora = date('Y-m-d H:i:s');
            $accion = "Eliminación de empleados";

            foreach ($nombres as $nombre) {
                $detalle = "Empleado eliminado: $nombre";
                $log_sql = "INSERT INTO movimientos_log (fecha_hora, usuario, accion, detalle) VALUES ('$fecha_hora', '$usuario', '$accion', '$detalle')";
                $conexion->query($log_sql);
            }

            header("location: ../main.php");
        } else {
            echo "Error al eliminar registros: " . $conexion->error;
        }
    } else {
        echo "Error al obtener nombres de los empleados: " . $conexion->error;
    }
} else {
    echo "No se seleccionaron registros para eliminar.";
}

$conexion->close();
?>
