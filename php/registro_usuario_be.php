<?php
    include 'conexion_be.php';

    $usuario = $_POST['userRegister'];
    $nombre = $_POST['name'];
    $apellido = $_POST['lastname'];
    $email = $_POST['email'];
    $contrasena = $_POST['passRegister'];
    $verificar_contrasena = $_POST['passRegisterCon'];
    

    if ($contrasena == $verificar_contrasena){
        // Encriptacion de la contraseña
        $contrasena = hash('sha512', $contrasena);

        $query = "INSERT INTO usuarios(usuario, nombre, apellido, email, contrasena) 
                  VALUES('$usuario', '$nombre', '$apellido', '$email', '$contrasena')";

        // Verificar que el correo no se repita en la bd
        $verifyEmail = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email='$email' ");

        if(mysqli_num_rows($verifyEmail) > 0){
            echo '
                <script>
                    alert("Este correo ya esta registrado.");
                    window.location = "../index.php";
                </script>
            ';

            exit();
        }

        // Verificar que el usuario no se repita en la bd
        $verifyUser = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario='$usuario' ");

        if(mysqli_num_rows($verifyUser) > 0){
            echo '
                <script>
                    alert("Este usuario ya esta registrado.");
                    window.location = "../index.php";
                </script>
            ';

        exit();
        }

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

    } else{
        echo '
            <script>
                window.location = "../index.php";
                alert("Las contraseñas no coinciden.");
            </script>
        ';
    }
    
?>