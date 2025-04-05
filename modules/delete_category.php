<?php
include '../include/validate_admin.php';
include '../include/dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_category'])) {
    $id = $_POST['category_id'];
    $conn->query("DELETE FROM category WHERE id = '$id'");

    if ($conn->affected_rows > 0) {
        $_SESSION['message'] = "Category deleted successfully.";
    } else {
        $_SESSION['message'] = "Error deleting Category.";
    }
    $conn->close();
}
header("Location: ../dashboard.php");
exit;
