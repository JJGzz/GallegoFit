<?php
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($con);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];



    if ($new_password === $confirm_password) {
        // Hash de la nueva contraseña
        $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);

        // Actualizar la contraseña en la base de datos
        $user_id = $user_data['id'];
        $query = "UPDATE user SET password ='$new_password_hashed' WHERE id='$user_id'";
        mysqli_query($con, $query);

        $_SESSION['message'] = "Contraseña actualizada exitosamente.";
    } else {
        $_SESSION['message'] = "Las nuevas contraseñas no coinciden.";
    }

    header("Location: cuenta.php");
    die;
}
?>
