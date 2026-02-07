<?php 

    // If constant is not defined error 403 + exit().
    if (!defined('ACCESS_GRANTED')) {
        http_response_code(403);
        exit();
    }

    require_once (INC_PATH.'/database.php');

    require_once (CORE_PATH_CLASS.'/email.php');
    require_once (CORE_PATH_CLASS.'/account.php');
?>