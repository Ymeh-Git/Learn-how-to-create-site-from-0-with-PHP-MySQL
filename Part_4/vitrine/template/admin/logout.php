<?php

session_unset(); // Empty session's variables
session_destroy(); // Destroy session

// Then you go back to homepage
header('location: index.php');
exit(); 
?>