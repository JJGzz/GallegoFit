<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

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
                <li><a href="login.php">Cuenta</a></li>
                <li><a href="#clases">Rutinas</a></li>
                <li><a href="#entrenadores">Entrenadores</a></li>
                <li><a href="listsocios.php">Socios</a></li>
                <li><a href="#contacto">Info</a></li>
                <li><a href="logout.php">Cerrar sesion</a></li>
            </ul>
        </nav>
    </header>

    <!--Contenido pag-->

    <H1>Bienvenido <?php echo $user_data['user_name']; ?></H1>
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
                </li>
                <a class="card" href="listsocios.php">
                    <div class="card__background" style="background-image: url(img/socios.png)">
                    </div>
                    <div class="card__content">
                        <h3 class="card__heading">Socios</h3>
                    </div>
                </a>
                <div>
    </section>


    <!--Scripts-->

    <script src="js/nav.js"></script>
</body>

</html>