<?php
//Parte del overlay que muestra los socios vencidos y cerca a vencer



include("connection.php");

// Obtener la fecha actual
$currentDate = date('Y-m-d');

// Obtener miembros con pago = 0
$query = "SELECT socios_name, socios_surname FROM socios WHERE pago = 0";
$result = mysqli_query($con, $query);
$unpaidMembers = [];
while ($row = mysqli_fetch_assoc($result)) {
    $unpaidMembers[] = $row;
}

// Obtener miembros con datepago hace 3 semanas pero no más de un mes
$query = "SELECT socios_name, socios_surname FROM socios WHERE DATE_ADD(datepago, INTERVAL 3 WEEK) <= '$currentDate' AND DATE_ADD(datepago, INTERVAL 1 MONTH) > '$currentDate' AND pago = 1";
$result = mysqli_query($con, $query);
$pendingPayments = [];
while ($row = mysqli_fetch_assoc($result)) {
    $pendingPayments[] = $row;
}

echo json_encode([
    'unpaidMembers' => $unpaidMembers,
    'pendingPayments' => $pendingPayments
]);
?>
