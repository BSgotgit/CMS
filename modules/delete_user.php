<?php
include '../include/validate_admin.php';
include '../include/dbconnect.php';

if (isset($_POST['remove_user']) && isset($_POST['user_id'])) {
    $user_id = intval($_POST['user_id']);
    $query = "DELETE FROM users WHERE user_id = $user_id";
    $result = $conn->query($query);

    if ($conn->affected_rows > 0) {
        $_SESSION['message'] = "User deleted successfully.";
    } else {
        $_SESSION['message'] = "Error deleting User.";
    }
    $conn->close();

    header("Location: ../dashboard.php"); // Redirect back to dashboard
    exit();
}
?>