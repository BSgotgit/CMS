<?php
include '../include/validate_admin.php';
include '../include/dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['default_role'])) {
    $default_role = $_POST['default_role']; 
    $conn->query("UPDATE settings SET setting_value = '$default_role' WHERE setting_key = 'default_role' ");
    header("Location: ../dashboard.php");
    
    $conn->close();
    exit();
}
