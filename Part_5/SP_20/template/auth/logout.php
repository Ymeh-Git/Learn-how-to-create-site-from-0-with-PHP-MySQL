<?php

// If constant is not defined error 403 + exit().
if (!defined('ACCESS_GRANTED')) {
    http_response_code(403);
    exit();
}

session_unset(); // Empty session's variables
session_destroy(); // Destroy session

// Then you go back to homepage
header('location: index.php');
exit(); 
?>