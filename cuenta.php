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



    //Cambio de contraseña

    // Mostrar mensaje de la sesión si existe
    if (isset($_SESSION['message'])) {
        echo "<div class='message'>" . $_SESSION['message'] . "</div>";
        // Borrar el mensaje de la sesión
        unset($_SESSION['message']);
    }



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

    <!--Cropper-->
    <link href="https://unpkg.com/cropperjs/dist/cropper.min.css" rel="stylesheet">
    <script src="https://unpkg.com/cropperjs"></script>
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
                    <li><a href="cuenta.php" style="color: #F0653B">Cuenta</a></li>
                    <li><a href="#clases">Rutinas</a></li>
                    <li><a href="#entrenadores">Entrenadores</a></li>
                    <li><a href="listsocios.php">Socios</a></li>
                    <li><a href="#contacto">Info</a></li>
                    <li><a href="logout.php">Cerrar sesion</a></li>
                </ul>
            </nav>
        </header>

        <!--Contenido pag-->
        <main>

            <div class="profile-container">
                <div class="profile-header">
                    <?php if($user_data['img']) { ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($user_data['img']); ?>" alt="Foto de Perfil" class="profile-picture"/>
                    <?php } else { ?>
                        <img src="img/default_profile.png" alt="Foto de Perfil" class="profile-picture"/>
                    <?php } ?>
                    <img src="img/pen.png" alt="Editar" class="edit-icon" onclick="toggleEditForm()">
                </div>
                <div style="display:flex; align-items: center;" class="nombre">
                    <h1 class="profile-name" id="profile-name"><?php echo $user_data['user_name']; ?></h1>
                    <input type="text" id="name-input" class="profile-name-input" value="<?php echo $user_data['user_name']; ?>" style="display: none;">
                    <img src="img/pen.png" alt="Editar" style="width:22px; height:35px; cursor: pointer;" onclick="enableNameEdit()">
                </div>
                <div class="guardarname">
                    <button id="save-name-button" style="display: none; background-color: #F0653B; padding: 8px 15px" onclick="saveName()">Guardar</button>
                </div>
                <div class="profile-info">
                    <p><strong>Email: </strong><?php echo $user_data['user_email']; ?></p>
                    <div class="change-password">
                        Cambiar contraseña
                    </div>
                </div>
            </div>


                <!-- Overlay cambiar contraseña -->

            <div class="change-password-overlay" id="change-password-overlay">
                <div class="change-password-container">
                    <form action="change_password.php" method="post">
                        <h2>Cambiar Contraseña</h2>
                        <div class="form-group">
                            <label for="new-password" class="nohover" style="color: white">Nueva Contraseña</label>
                            <input type="password" id="new-password" name="new_password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm-password" class="nohover" style="color: white">Confirmar Nueva Contraseña</label>
                            <input type="password" id="confirm-password" name="confirm_password" required>
                        </div>
                        <div class="form-buttons">
                            <button type="submit" class="botonfoto">Guardar</button>
                            <button type="button" onclick="toggleChangePasswordForm()" class="botonfoto">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>


            

            <!-- Overlay cambiar foto -->
            <div class="edit-form-overlay" id="edit-form-overlay">
                <div class="edit-form-container">
                    <form id="crop-form" action="upload.php" method="post" enctype="multipart/form-data">
                        <br>
                        <div class="green" id="green">
                            <input type="file" name="img" id="img" class="custom-file-input">
                            <label for="img" class="custom-file-label">Selecciona una nueva imagen</label>
                        </div>
                        <br>
                        <!-- Contenedor para mostrar la imagen recortada -->
                        <div class="img-container">
                            <img id="image-preview" style="max-width: 30%;">
                        </div>
                        <br>
                        <div class="subir">
                            <input type="hidden" id="cropped-img" name="cropped_img">
                            <input type="submit" value="Guardar" name="submit" class="botonfoto">
                            <button type="button" onclick="toggleEditForm()" class="botonfoto">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>


        </main>   



        <!--footer-->
        

        <!--Scripts-->



        <script src="js/nav.js"></script>
        <script src="js/editFoto.js"></script>
        <script src="js/editName.js"></script>
    </div>
</body>

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

</html>