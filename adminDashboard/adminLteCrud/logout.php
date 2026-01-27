<?php
session_start();
session_unset();    // Clear session variables
session_destroy();  // Destroy the actual session
header("Location: ../login.php");
exit();
?> 