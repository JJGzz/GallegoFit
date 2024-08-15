<?php 

session_start();

	include("connection.php");
	include("functions.php");

    $user_data = check_login($con);


    //si de alguna manera alguien intenta entrar a la lista mediante url los redirecciona al index
    if (isset($_SESSION['user_id'])) {
        // El usuario está logueado, usar el ID del usuario
        $user_id = $_SESSION['user_id'];
    } else {
        // El usuario no está logueado, asignar valor predeterminado
        $user_id = 0;
    }

    if (!isset($_SESSION['user_id']) || !in_array($_SESSION['user_id'], [1, 2, 3])) {
        // Redirigir a index.php si el usuario no está autorizado
        header('Location: index.php');
        exit(); // Asegurarse de que el script se detenga después de la redirección
    }


    

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		
	}

    //carga los datos de los socios para la tabla
    $query = "SELECT * from socios";
    $result = mysqli_query($con, $query);
    //---------------------------------------

    if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$socios_name = $_POST['socios_name'];
		$socios_surname = $_POST['socios_surname'];
        $email = $_POST['email'];
        $datepago = $_POST['datepago'];

		if(!empty($socios_name) && !empty($socios_surname) && !is_numeric($socios_name) && !is_numeric($socios_surname))
		{

			//save to database
			$id = random_num(11);
			$query = "insert into socios (id,socios_name,socios_surname,email,pago,datepago) values ('$id','$socios_name','$socios_surname','$email','1','$datepago')";

			mysqli_query($con, $query);

			header("Location: listsocios.php");
			die;
		}else
		{
			echo "Ingrese informacion valida!";
		}
	}


    //EDIT

    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['edit_id']))
    {
        $edit_id = $_POST['edit_id'];
        $edit_socios_name = $_POST['edit_socios_name'];
        $edit_socios_surname = $_POST['edit_socios_surname'];
        $edit_email = $_POST['edit_email'];
        $edit_datepago = $_POST['edit_datepago'];

        if(!empty($edit_socios_name) && !empty($edit_socios_surname) && !is_numeric($edit_socios_name) && !is_numeric($edit_socios_surname) ) 
        {
            // Actualiza la base de datos
            $query = "UPDATE socios SET socios_name='$edit_socios_name', socios_surname='$edit_socios_surname', email='$edit_email', datepago='$edit_datepago' WHERE id='$edit_id'";
            mysqli_query($con, $query);

            header("Location: listsocios.php");
            die;
        }else
        {
            echo "Ingrese informacion valida!";
        }
    }




    //Cambiar pago a 0 despues de 1 mes



    // Obtener la fecha actual
    $currentDate = date('d-m-Y');

    // Actualizar la columna 'pago' a 0 si ha pasado más de un mes desde 'datepago'
    $query = "UPDATE socios SET pago = 0 WHERE DATE_ADD(datepago, INTERVAL 1 MONTH) <= '$currentDate'";
    mysqli_query($con, $query);


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
    <title>Socios</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                <li><a href="listsocios.html" style="color: #F0653B">Socios</a></li>
                <li><a href="#contacto">Info</a></li>
                <li><a href="logout.php">Cerrar sesion</a></li>
            </ul>
        </nav>
    </header>



    <!--Contenido pag-->

    <main>

        <!--Ingresar socio-->

        <br>
        <div id="botonToggle" class="notificaciones" style="text-align: center; display: flex; justify-content: space-between;">
            <div  onclick="toggleCuadro()">
                <img src="img/simbolomas.png" alt="Toggle Button" style="width: 100px; height: 100px;">
            </div>
            <div>
                <img src="img/bell.png" style="width: 100px; height: 100px;">
            </div>
        </div>

        



        <div class="padre">
            <div class="hijo">
                <H1 style="color: white;">Ingresar nuevo socio</H1>
                <br>
                <form method="post">
                    <div class="nombre input-group">
                        <h2 style="color: white; padding-right: 10px;">Nombre:</h2>
                        <br>
                        <input id="text" type="text" name="socios_name" required>
                    </div>
                    <br>
                    <div class="nombre input-group">
                        <h2 style="color: white; padding-right: 10px;">Apellido:</h2>
                        <br>
                        <input id="text" type="text" name="socios_surname" required>
                    </div>
                    <br>
                    <div class="nombre input-group">
                        <h2 style="color: white; padding-right: 10px;">Email:</h2>
                        <br>
                        <input id="text" type="text" name="email">
                    </div>

                    <br>
                    <div class="nombre input-group">
                        <h2 style="color: white; padding-right: 10px;">Fecha de pago:</h2>
                        <br>
                        <input id="text" type="date" name="datepago" required>
                    </div>

                    <br>
                    <div class="input-group cajasubmit">
                        <input type="submit" class="botonsubmit" value="Agregar">
                    </div>
                </form>
            </div>
        </div>



        <!--Edit modal-->



        <div id="editModal" class="modal">
            <span class="close">&times;</span>
            <div class="padreedit">
                <form id="editForm" method="post" class="formm">
                    <input type="hidden" name="edit_id" id="edit_id">
                    <div class="hijoedit" style="text-align: center;">
                        <div class="nombre input-group">
                            <h2 style="color: white; padding-right: 10px;">Nombre:</h2>
                            <input id="edit_socios_name" type="text" name="edit_socios_name" required>
                        </div>
                        <br>
                        <div class="nombre input-group">
                            <h2 style="color: white; padding-right: 10px;">Apellido:</h2>
                            <input id="edit_socios_surname" type="text" name="edit_socios_surname" required>
                        </div>
                        <br>
                        <div class="nombre input-group">
                            <h2 style="color: white; padding-right: 10px;">Email:</h2>
                            <input id="edit_email" type="text" name="edit_email">
                        </div>
                        <br>
                        <div class="nombre input-group">
                            <h2 style="color: white; padding-right: 10px;">Fecha:</h2>
                            <input id="edit_datepago" type="date" name="edit_datepago">
                        </div>
                        <br>
                        <div class="input-group cajasubmit">
                            <input type="submit" class="botonsubmit" value="Guardar Cambios">
                        </div>
                    </div>
                </form>
            </div>
        </div>



        <!-- Overlay de pagos pendientes -->
        <div id="combined-overlay" class="combined-overlay" style="display: none;"></div>

        <script>
            // Pasar la información de la sesión al script JavaScript
            var newUnpaidMembers = <?php echo $_SESSION['new_unpaid_members'] ? 'true' : 'false'; ?>;
        </script>


        <!-- Tablaaaa -->
        


        <div class="center">
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Buscar por nombre o apellido...">
                <button id="searchButton" class="agrandarlupa">
                    <img src="img/lupa.png" alt="Buscar" class="search-icon">
                </button>
            </div>
        
        <table class="tabla" id="sociosTable">
                <tr class="rows">
                    <td><h4 style="color: white">Nombre</h4></td>
                    <td><h4 style="color: white">Apellido</h4></td>
                    <td><h4 style="color: white">Email</h4></td>
                    <td class="mobilehide"><h4 style="color: white">Fecha de pago</h4></td>
                    <td><h4 style="color: white">Pago</h4></td>
                    <td><h4 style="color: white">Edicion</h4></td>
                </tr>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr class="gris">
                        <td><span class="edit_socios_name"><?php echo $row['socios_name']; ?></span></td>
                        <td><span class="edit_socios_surname"><?php echo $row['socios_surname']; ?></span></td>
                        <td><span class="edit_email"><?php echo $row['email']; ?></span></td>
                        <td class="mobilehide"><span class="edit_datepago" data-date="<?php echo $row['datepago']; ?>"><?php echo date('d-m-Y', strtotime($row['datepago'])); ?></span></td>
                        
                        <td>
                            <div class="agrandar">
                                <img src="img/<?php echo $row['pago'] ? 'on' : 'off'; ?>.png" alt="<?php echo $row['pago'] ? 'On' : 'Off'; ?>" 
                                class="toggle-pago" data-id="<?php echo $row['id']; ?>" data-status="<?php echo $row['pago']; ?>">
                            </div>
                        </td>
                        
                        <td>
                            <div class="editar">
                                <div class="agrandar">
                                    <input type="hidden" class="edit_id" value="<?php echo $row['id']; ?>">
                                    <img src="img/pen.png" alt="Editar" class="edit-button">
                                </div>
                                </div>
                                <div class="agrandar">
                                    <img src="img/bin.png" alt="Borrar" class="delete-button">
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>

            </table>
        </div>



        <!--eliminar-->


        <div class="overlay" id="overlay"></div>
        <div class="confirm-delete" id="confirm-delete">
            <p>¿Estás seguro de que deseas eliminar este socio?</p>
            <br>
            <div class="botonesborrar">
                <div class="sisnon hoverrojo" id="confirm-yes">Sí</div>
                <div class="sisnon hoverblanco" id="confirm-no">No</div>
            </div>
        </div>

    </main>


    
    
    <!--Scripts-->




    <script src="js/nav.js"></script>
    <script src="js/togglePago.js"></script>
    <script src="js/editModal.js"></script>
    <script src="js/deleteRow.js"></script>
    <script src="js/searchTable.js"></script>
    <script src="js/botonSocio.js"></script>
    <script src="js/campana.js"></script>
</body>
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

</html>