<?php
include '../include/validate_admin.php';
include '../include/dbconnect.php';

if (isset($_GET['pid'])) {
    $post_id = intval($_GET['pid']);
    $query = "DELETE FROM posts WHERE post_id = $post_id";
    $result = $conn->query($query);

    if ($conn->affected_rows > 0) {
        $_SESSION['message'] = "Post deleted successfully.";
    } else {
        $_SESSION['message'] = "Error deleting post.";
    }
    $conn->close();

    header("Location: ../dashboard.php"); // Redirect back to dashboard
    exit();
}
