<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['role'];

// For DASHBOARD
if ($role != 'admin' && $role != 'editor'){
    header("Location: user.php");
    exit();
}
?>