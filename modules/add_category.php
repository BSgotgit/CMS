<?php
include '../include/validate_admin.php';
include '../include/dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_category'])) {
    $name = trim($_POST['category_name']);
    $conn->query("INSERT INTO category (name) VALUES ('$name')");

    if ($conn->affected_rows > 0) {
        $_SESSION['message'] = "Category Added successfully.";
    } else {
        $_SESSION['message'] = "Error adding Category.";
    }
    $conn->close();
}
header("Location: ../dashboard.php");
exit;
