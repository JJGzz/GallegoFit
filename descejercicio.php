<?php
session_start();
include("connection.php");
include("functions.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT nombre, descripcion, grupoMuscular, url FROM ejercicios WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $nombre = htmlspecialchars($row['nombre']);
        $descripcion = htmlspecialchars($row['descripcion']);
        $grupoMuscular = htmlspecialchars($row['grupoMuscular']);
        $url = htmlspecialchars($row['url']);
    } else {
        echo "Ejercicio no encontrado.";
        exit;
    }
} else {
    echo "No se ha proporcionado un ID de ejercicio.";
    exit;
}

// Función para convertir URL de YouTube en un iframe
function getYoutubeEmbedUrl($url) {
    $pattern = '/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+$/';
    if (preg_match($pattern, $url)) {
        parse_str(parse_url($url, PHP_URL_QUERY), $queryVars);
        return 'https://www.youtube.com/embed/' . $queryVars['v'];
    }
    return false;
}

$embedUrl = getYoutubeEmbedUrl($url);



$grupoMuscularNombres = [
    1 => "Abdomen",
    2 => "Hombro",
    3 => "Triceps",
    4 => "Biceps",
    5 => "Pecho",
    6 => "Espalda",
    7 => "Antebrazo"
];

// Obtener el nombre del grupo muscular
$grupoMuscularNombre = $grupoMuscularNombres[$grupoMuscular];


// IDs a los cuales se les muestra la edicion y la eliminacion
$allowed_ids = [1, 2, 3];

if (isset($_SESSION['user_id'])) {
    // El usuario está logueado, usar el ID del usuario
    $user_id = $_SESSION['user_id'];
} else {
    // El usuario no está logueado, asignar valor predeterminado
    $user_id = 0;
}
?>

<!DOCTYPE html>
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
    <title><?php echo $nombre; ?></title>
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
        <div class="infopadre">
            <div class="infohijo">
                
                <div class="editarborrar">
                    <h1 style="color: white;padding-left:20px"><?php echo $nombre; ?></h1>
                    <div style="padding: 10px 10px 0 0;">
                        <!--Esto solo se muestra a IDs seleccionados-->
                        <?php if (in_array($user_id, $allowed_ids)): ?>
                            <img src="img/pen.png" alt="Editar" class="icono">
                            <img src="img/bin.png" alt="Borrar" class="icono">
                        <?php endif; ?>

                    </div>
                </div>
                <p style="color: white; padding-left: 40px; padding-top:10px"><strong>Grupo Muscular:</strong> <?php echo $grupoMuscularNombre; ?></p>
                <p style="color: white; padding-left: 70px; padding-top:10px;"><strong>Descripción:</strong></p>
                
                <div style="padding: 10px 90px 10px 90px">
                    <div class="textodesc">
                        <p style="color: white; text-align: center; padding: 15px 20px 15px 20px"><?php echo $descripcion; ?></p>
                    </div>
                </div>

                <?php if ($embedUrl): ?>
                    <!-- Incrustar video de YouTube -->
                    <div class="video-container">
                        <iframe width="560" height="315" src="<?php echo $embedUrl; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                <?php else: ?>
                    <!-- Mostrar video de archivo directo -->
                    <div class="video-container">
                        <video width="560" height="315" controls>
                            <source src="<?php echo $url; ?>" type="video/mp4">
                            Tu navegador no soporta la reproducción de video.
                        </video>
                    </div>
                <?php endif; ?>
            </div>
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
