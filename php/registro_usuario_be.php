<?php
    include 'conexion_be.php';

    $usuario = $_POST['userRegister'];
    $nombre = $_POST['name'];
    $apellido = $_POST['lastname'];
    $email = $_POST['email'];
    $contrasena = $_POST['passRegister'];

    $query = "INSERT INTO usuarios(usuario, nombre, apellido, email, contrasena) 
               VALUES('$usuario', '$nombre', '$apellido', '$email', '$contrasena')";

    $ejecutar = mysqli_query($conexion, $query);

    if($ejecutar){
        echo '
            <script>
                window.location = "../index.php";
                alert("Usuario registrado exitosamente!");
            </script>
        ';
    } else{
        echo '
            <script>
                window.location = "../index.php";
                alert("Error al registrar el usuario, Intentalo de nuevo mas tarde.");
            </script>
        ';
    }

    mysqli_close($conexion);
?>