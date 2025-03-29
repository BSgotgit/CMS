<?php

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}

session_unset(); // Clear all session variables
session_destroy(); // Destroy session

header("Location: index.php");
exit();

?>
