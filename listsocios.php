<?php 

session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		
	}


    $query = "SELECT * from socios";
    $result = mysqli_query($con, $query);
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/listsocios.css">
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
    <title>Clientes</title>
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
                <li><a href="#contacto">Socios</a></li>
                <li><a href="#contacto">Info</a></li>
                <li><a href="logout.php">Cerrar sesion</a></li>
            </ul>
        </nav>
    </header>

    <!--Contenido pag-->
    <div class="center">
        <table class="tabla">
            <tr class="rows">
                <td class="center">Nombre</td>
                <td>Apellido</td>
                <td>Email</td>
                <td>Pago</td>
            </tr>
            <tr>
            <?php
                while($row = mysqli_fetch_assoc($result))
                {
            ?>
                <td><?php echo $row['socios_name']?></td>
                <td><?php echo $row['socios_surname']?></td>
                <td><?php echo $row['email']?></td>
                <td><?php echo $row['pago']?></td>

            </tr>
            <?php
                }
            ?>

        </table>
    </div>
    
    <!--Scripts-->

    <script src="js/nav.js"></script>
</body>

</html>