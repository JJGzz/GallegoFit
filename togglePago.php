<?php
session_start();
include("connection.php");

if(isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $currentStatus = $_POST['status'];

    // Invertir el estado
    $newStatus = $currentStatus == '1' ? '0' : '1';

    // Actualizar el estado en la base de datos
    $query = "UPDATE socios SET pago='$newStatus' WHERE id='$id'";
    mysqli_query($con, $query);

    echo $newStatus;
}
?>
