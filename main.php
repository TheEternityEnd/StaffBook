<?php
    session_start();

    if(!isset($_SESSION['usuario'])){
        header("location: index.php");
        session_destroy();
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StaffBook</title>
    <link rel="stylesheet" href="css/mainStyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <header class="header">
        <div class="menu-icon">
            <span>&#9776;</span>
        </div>
        <div class="logo">
            <h1>StaffBook</h1>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Buscar">
        </div>
        <div class="profile">
            <img src="https://via.placeholder.com/40" alt="Profile Picture" class="profile-img">
            <span>John Doe</span>
        </div>
    </header>
    <script src="js/mainScript.js "></script>
</body>

</html>