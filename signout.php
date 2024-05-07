<?php
// Start session
session_start();

// If user is logged in, destroy the session and redirect to login page
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to login page
    header("Location: login.html");
    exit;
} else {
    // If user is not logged in, redirect to login page
    header("Location: login.html");
    exit;
}
?>
