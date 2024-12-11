<?php
include './conexion_be.php'; // Conexión a la base de datos

header('Content-Type: text/html; charset=utf-8');

// Consulta para obtener los registros de la tabla movimientos_log
$query = "SELECT id, fecha_hora, usuario, accion, detalle FROM movimientos_log ORDER BY fecha_hora DESC";
$result = $conexion->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['fecha_hora']) . "</td>";
        echo "<td>" . htmlspecialchars($row['usuario']) . "</td>";
        echo "<td>" . htmlspecialchars($row['accion']) . "</td>";
        echo "<td>" . htmlspecialchars($row['detalle']) . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No hay registros disponibles.</td></tr>";
}

// Cerrar la conexión a la base de datos
$result->close();
$conexion->close();
?>
