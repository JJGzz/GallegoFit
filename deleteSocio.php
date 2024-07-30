<?php
include("connection.php");

//listsocios.php borrar socios

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    if (!empty($id) && is_numeric($id)) {
        $query = "DELETE FROM socios WHERE id = '$id'";
        
        if (mysqli_query($con, $query)) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "invalid";
    }
}
?>
