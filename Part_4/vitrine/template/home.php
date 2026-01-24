<?php 
// If constant is not defined error 403 + exit().
if (!defined('ACCESS_GRANTED')) {
    http_response_code(403);
    exit();
}

?>
<h1>HOMEPAGE</h1>