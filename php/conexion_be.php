<?php
    //Conexion a la base de datos
    //$conexion = mysqli_connect("roundhouse.proxy.rlwy.net", "root", "hvwoQOsgAfqNDykwHukQJHdNsgpdUtbY", "railway", 43188);

    //Conexion a la base de datos local
    $conexion = mysqli_connect("localhost", "root", "admin", "railway", 3306);

    /* Comprobacion de la conexion
    if($conexion){
        echo 'conextado exitosamente a la bd';
    } else{
        echo 'no se ha podido conectar a la bd';
    }
    */

    
?>