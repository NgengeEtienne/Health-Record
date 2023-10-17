<?php
// Start the session
session_start();

// Check if the session is active
if (session_status() === PHP_SESSION_ACTIVE) {
  // Unset all session variables
  $_SESSION = array();

  // Destroy the session
  session_destroy();
}

// Redirect to the login page or home page
header("Location: index.php");
exit();
?>