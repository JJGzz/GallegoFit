<?php

session_start();

	include("connection.php");
	include("functions.php");


    $query = "SELECT id, nombre, img FROM ejercicios";
    $result = mysqli_query($con, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/listejercicios.css">
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
    <title>Ejercicios</title>
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


    <main>


        <!--Contenido pag-->
        <div class="agregarpadre">
            <div class="agregar">
                <h1 class="btnAgregar" id="agregarEjercicioBtn">Agregar Ejercicio</h1>
            </div>
        </div>

        <!-- Overlay -->
        <div id="overlay" class="overlay">
            <div class="overlay-content">
                <span id="closeOverlay" class="close">&times;</span>
                <h2>Agregar Ejercicio</h2>
                <form action="agregar_ejercicio.php" method="post" enctype="multipart/form-data">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>

                    <label for="grupoMuscular">Grupo Muscular:</label>
                    <select id="grupoMuscular" name="grupoMuscular" required>
                        <option value="1">Abdomen</option>
                        <option value="2">Hombro</option>
                        <option value="3">Triceps</option>
                        <option value="4">Biceps</option>
                        <option value="5">Pecho</option>
                        <option value="6">Espalda</option>
                        <option value="7">Antebrazo</option>
                    </select>

                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" required></textarea>

                    <label for="url">URL:</label>
                    <input type="url" id="url" name="url" required>

                    <label for="img">Imagen:</label>
                    <input type="file" id="img" name="img" accept="image/*" required>

                    <input type="submit" value="Agregar Ejercicio">
                </form>
            </div>
        </div>



        <div class="cuadrolist">
            <?php
            // Recorremos los resultados de la consulta
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $nombre = $row['nombre'];
                $imgData = $row['img'];
                $imgBase64 = base64_encode($imgData);
            
                echo '
                <a href="descejercicio.php?id=' . urlencode($id) . '" alt="' . htmlspecialchars($nombre) . '">
                    <div class="cardPadre">
                        <div class="card">
                            <div class="wrapper">
                                <img src="data:image/jpeg;base64,' . $imgBase64 . '" class="cover-image" alt="' . htmlspecialchars($nombre) . '" />
                            </div>
                            <h1 class="link">' . htmlspecialchars($nombre) . '</h1>
                        </div>
                    </div>
                </a>';
            }
            ?>
        </div>

    </main>


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