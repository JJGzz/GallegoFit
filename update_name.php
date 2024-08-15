<?php
session_start();
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $new_name = $input['user_name'];
    $user_id = $_SESSION['user_id'];

    if (!empty($new_name) && !empty($user_id)) {
        $query = "UPDATE user SET user_name = '$new_name' WHERE user_id = '$user_id'";
        $result = mysqli_query($con, $query);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error al actualizar el nombre en la base de datos']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Datos inválidos']);
    }
}
?>
