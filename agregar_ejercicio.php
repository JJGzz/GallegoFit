<?php
session_start();
include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $grupoMuscular = $_POST['grupoMuscular'];
    $descripcion = $_POST['descripcion'];
    $url = $_POST['url'];

    // Imagen
    $imgData = addslashes(file_get_contents($_FILES['img']['tmp_name']));

    // Inserción en la base de datos
    $query = "INSERT INTO ejercicios (nombre, grupoMuscular, descripcion, url, img) VALUES ('$nombre', '$grupoMuscular', '$descripcion', '$url', '$imgData')";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "<script>alert('Ejercicio agregado exitosamente');</script>";
    } else {
        echo "<script>alert('Error al agregar ejercicio');</script>";
    }

    header("Location: listejercicios.php");
    die;
}
?>
