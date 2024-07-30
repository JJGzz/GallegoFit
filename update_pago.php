<?php
session_start();
include("connection.php");


//Al pasar un mes del pago la variable 'pago' cambia a 0 automaticamente




if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $currentStatus = $_POST['currentStatus'];

    // Determinar el nuevo estado de 'pago'
    $newStatus = $currentStatus ? 0 : 1;

    // Obtener la fecha actual
    $currentDate = date("d-m-Y");

    // Actualizar el campo 'pago' y 'datepago' en la base de datos
    $query = "UPDATE socios SET pago = $newStatus, datepago = IF($newStatus = 1, '$currentDate', datepago) WHERE id = $id";
    mysqli_query($con, $query);
    
    echo json_encode(['newStatus' => $newStatus]);
}
?>
