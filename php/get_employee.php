<?php
include 'conexion_be.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clave = $_POST['clave'];

    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conexion->prepare("SELECT * FROM empleados WHERE clave = ?");
    $stmt->bind_param("s", $clave);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $employee = $result->fetch_assoc();
        echo json_encode($employee);
    } else {
        echo json_encode(['error' => 'Empleado no encontrado']);
    }

    // Cerrar la sentencia y la conexión
    $stmt->close();
    $conexion->close();
} else {
    echo json_encode(['error' => 'Método no permitido']);
}
?>
