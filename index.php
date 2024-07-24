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

    $allowed_ids = [1, 2, 3];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/style.css">
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

    <section class="hero-section">
        
        <div class="card-grid">
            <a class="card" href="ejercicios.html">
                <div class="card__background" style="background-image: url(img/ejercicio.jpeg)">
                </div>
                <div class="card__content">
                    <h3 class="card__heading">Ejercicios</h3>
                </div>
            </a>
            <a class="card" href="#">
                <div class="card__background" style="background-image: url(img/istockphoto-538325934-612x612.jpg)">
                </div>
                <div class="card__content">
                    <h3 class="card__heading">Rutinas</h3>
                </div>
            </a>

            <a class="card" href="#">
                <div class="card__background" style="background-image: url(img/entrenadores2.png)">
                </div>
                <div class="card__content">
                    <h3 class="card__heading">Entrenadores</h3>
                </div>
            </a>
            <?php if (in_array($user_id, $allowed_ids)): ?>
                <a class="card" href="listsocios.php">
                    <div class="card__background" style="background-image: url(img/socios.png)">
                    </div>
                    <div class="card__content">
                        <h3 class="card__heading">Socios</h3>
                    </div>
                </a>
            <?php endif; ?>
            <div>
    </section>


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
</body>

</html>