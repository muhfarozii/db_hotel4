<?php
// Start session
session_start();

// Destroy all session data
session_unset();
session_destroy();

// Redirect to register.php
header("Location: home.php");
exit();
?>
