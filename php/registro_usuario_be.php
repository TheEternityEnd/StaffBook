<?php
include 'conexion_be.php';  // Conexión a la base de datos

$usuario = $_POST['userRegister'];
$nombre = $_POST['name'];
$apellido = $_POST['lastname'];
$email = $_POST['email'];
$contrasena = $_POST['passRegister'];
$verificar_contrasena = $_POST['passRegisterCon'];

// Verificar que las contraseñas coincidan
if ($contrasena == $verificar_contrasena) {
    // Encriptación de la contraseña
    $contrasena = hash('sha512', $contrasena);

    // Verificar si el correo ya está registrado
    $stmt_email = $conexion->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt_email->bind_param('s', $email);  // 's' para string
    $stmt_email->execute();
    $resultado_email = $stmt_email->get_result();

    if ($resultado_email->num_rows > 0) {
        echo '
            <script>
                alert("Este correo ya está registrado.");
                window.location = "../index.php";
            </script>
        ';
        exit();
    }

    // Verificar si el usuario ya está registrado
    $stmt_usuario = $conexion->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt_usuario->bind_param('s', $usuario);
    $stmt_usuario->execute();
    $resultado_usuario = $stmt_usuario->get_result();

    if ($resultado_usuario->num_rows > 0) {
        echo '
            <script>
                alert("Este usuario ya está registrado.");
                window.location = "../index.php";
            </script>
        ';
        exit();
    }

    // Insertar el nuevo usuario en la base de datos
    $stmt_insert = $conexion->prepare("INSERT INTO usuarios (usuario, nombre, apellido, email, contrasena) VALUES (?, ?, ?, ?, ?)");
    $stmt_insert->bind_param('sssss', $usuario, $nombre, $apellido, $email, $contrasena);

    if ($stmt_insert->execute()) {
        echo '
            <script>
                window.location = "../index.php";
                alert("Usuario registrado exitosamente!");
            </script>
        ';
    } else {
        echo '
            <script>
                window.location = "../index.php";
                alert("Error al registrar el usuario, inténtalo de nuevo más tarde.");
            </script>
        ';
    }

    // Cerrar las sentencias y la conexión
    $stmt_email->close();
    $stmt_usuario->close();
    $stmt_insert->close();
    $conexion->close();

} else {
    echo '
        <script>
            window.location = "../index.php";
            alert("Las contraseñas no coinciden.");
        </script>
    ';
}
?>
