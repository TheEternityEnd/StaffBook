<?php
    session_start();
    include 'conexion_be.php';

    $usuario = $_POST['userLogin'];
    $contrasena = $_POST['passLogin'];
    $contrasena = hash('sha512', $contrasena);  

    $validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario = '$usuario' and contrasena = '$contrasena'");

    if(mysqli_num_rows($validar_login) > 0){
        $_SESSION['usuario'] = $usuario;
        header("location: ../main.php");
        mysqli_query($conexion, "UPDATE usuarios SET ultima_sesion = CURRENT_TIMESTAMP WHERE usuario = '$usuario'");

        exit();
    } else{
        echo '
            <script>
                alert(Usuario y/o contraseña incorrectos.);
                window.location = "../index.php";
            </script>
        ';

        exit();
    }


?>