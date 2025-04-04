<?php
include '../include/validate_admin.php';
include '../include/dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['post_id'])) {
    $post_id = intval($_POST['post_id']);

    // Fetch current status
    $result = $conn->query("SELECT published FROM posts WHERE post_id = $post_id");
    if ($row = $result->fetch_assoc()) {
        $newStatus = ($row['published'] == 1) ? 0 : 1; // Toggle status

        $conn->query("UPDATE posts SET published = $newStatus WHERE post_id = $post_id");
        header("Location: ../dashboard.php");
        exit();
    }
}
?>
