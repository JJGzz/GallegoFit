<?php

session_start();

if (isset($_SESSION['user_id'])) {
    unset($_SESSION['user_id']);
}

// Redirigir a la página anterior si existe, de lo contrario redirigir a la página principal
if (isset($_SERVER['HTTP_REFERER'])) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    header("Location: index.php");
}

die();