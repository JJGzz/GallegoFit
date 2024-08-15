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

    
    if (isset($_SESSION['user_id'])) {
        // El usuario está logueado, usar el ID del usuario
        $user_id = $_SESSION['user_id'];
    } else {
        // El usuario no está logueado, asignar valor predeterminado
        $user_id = 0;
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/login.css">
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

    <title>Inicio de sesion</title>
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
            </ul>
        </nav>
    </header>

    <!--Contenido pag-->
    <div class="padre">
        <div class="hijo">
            <img src="img/gallegologo.png" alt="Logo" style="height: 150px; width:auto">
            <H1 style="color: white;">Inicio de sesion</H1>
            <br>
            <form method="post">
                <div class="nombre input-group">
                    <h2 style="color: white; padding-right: 10px;">Usuario:</h2>
                    <br>
                    <input id="text" type="text" name="user_name" required>
                </div>
                <br>
                <div class="nombre input-group">
                    <h2 style="color: white; padding-right: 10px;">Contraseña:</h2>
                    <br>
                    <input id="text" type="password" name="password" required>
                </div>

<!--   Este php hace que el mensaje de contraseña incorrecta aparezca dentro del cuadro-->
                <?php
                if($_SERVER['REQUEST_METHOD'] == "POST")
                { 
                    if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
                    {
            
                        //read from database
                        $query = "select * from user where user_name = '$user_name' limit 1";
                        $result = mysqli_query($con, $query);
            
                        if($result)
                        {
                            if($result && mysqli_num_rows($result) > 0)
                            {
            
                                $user_data = mysqli_fetch_assoc($result);
                                //el hash cambia la encriptacion de la base de datos a string
                                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                                //verifica que la contraseña tipeada sea igual que a la traduccion del hash
                                if (password_verify($password, $hashed_password)) {
                                    $_SESSION['user_id'] = $user_data['user_id'];
                                    header("Location: index.php");
                                    die;
                                }
                            
                            }
                        }
                        
                        echo "Usuario o contraseña incorrecta!";
                    }else
                    {
                        echo "Usuario o contraseña incorrecta!";
                    }
                }
                ?>


                <br>
                <div class="input-group cajasubmit">
                    <input type="submit" class="botonsubmit" value="Iniciar Sesion">
                </div>
            </form>
        </div>
    </div>


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