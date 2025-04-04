<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['email'])) {
    $logged_in = true;
    $email = $_SESSION['email'];
    $role = $_SESSION['role'];
} else {
    header("Location: login.php");
    exit();
}
