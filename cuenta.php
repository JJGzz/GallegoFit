<?php 
session_start();

	include("connection.php");
	include("functions.php");

    
    if (isset($_SESSION['user_id'])) {
        // El usuario está logueado, usar el ID del usuario
        $user_id = $_SESSION['user_id'];
    } else {
        // El usuario no está logueado, asignar valor predeterminado
        $user_id = 0;
    }

    $user_data = check_login($con);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/cuenta.css">
    <link rel="icon" href="img/favicon.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Tipografia-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Oswald:wght@200..700&display=swap"
        rel="stylesheet">

    <!--Tipografia titulo-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <title>Inicio</title>
</head>

<body>
    <div class="content">
        <header>
            <nav>
                <div class="logo">
                    <a href="index.php">
                        <img src="img/gallegologo.png" class="imglogo" alt="Logo">
                        <h1 class="titulo"><span class="naranja">Gallego</span>Fit</h1>
                    </a>
                </div>
                <div class="menu-toggle" id="menu-toggle">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
                <ul class="nav-links" id="nav-links">
                    <li><a href="cuenta.php">Cuenta</a></li>
                    <li><a href="#clases">Rutinas</a></li>
                    <li><a href="#entrenadores">Entrenadores</a></li>
                    <li><a href="listsocios.php">Socios</a></li>
                    <li><a href="#contacto">Info</a></li>
                    <li><a href="logout.php">Cerrar sesion</a></li>
                </ul>
            </nav>
        </header>

        <!--Contenido pag-->


        <div class="profile-container">
            <div class="profile-header">
                <img src="img/sillycat.jpg" alt="Foto de Perfil" class="profile-picture">
                <h1 class="profile-name"><?php echo $user_data['user_name']; ?></h1>
            </div>
            <div class="profile-info">

                <p><strong>Email: </strong><?php echo $user_data['user_email']; ?></p>
                <div class="change-password">
                    Cambiar contraseña
                </div>
            </div>
        </div>

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        



        <!--footer-->
        <footer>
            <div>
                <!--hace que el copy quede al medio-->
            </div>
            <div class="textofooter">
                <a href="https://www.instagram.com/juan.jose.garcia/" style="text-decoration: none" target="_blank">
                    <p>
                        &copy; 2024 Juan José García, Argentina.
                    </p>
                </a>
            </div>
            <a href="https://www.instagram.com/gimnasioelgallego/" target="_blank">
                <div class="textofooter">
                    <img src="img/IG.png" alt="" class="redeslogo">
                </div>
            </a>
        </footer>

        <!--Scripts-->

        <script src="js/nav.js"></script>
    </div>
</body>

</html>