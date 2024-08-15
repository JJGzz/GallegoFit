<?php
session_start();
include("connection.php");

if (isset($_FILES['cropped_img'])) {
    // Leer los datos del archivo
    $imgData = file_get_contents($_FILES['cropped_img']['tmp_name']);
    $user_id = $_SESSION['user_id'];
    
    // Insertar la imagen en la base de datos
    $stmt = $con->prepare("UPDATE user SET img = ? WHERE user_id = ?");
    $stmt->bind_param("si", $imgData, $user_id);
    
    if ($stmt->execute()) {
        echo "Imagen subida exitosamente.";
        
    } else {
        echo "Error al subir la imagen.";
    }
    header("Location: cuenta.php");
    $stmt->close();
    header("Location: cuenta.php");
    exit;
} else {
    echo "No se recibió ninguna imagen.";
}
?>
