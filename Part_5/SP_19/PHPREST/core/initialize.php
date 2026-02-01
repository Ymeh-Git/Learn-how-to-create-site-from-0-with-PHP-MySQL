<?php 

    defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
    defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'xampp'.DS.'htdocs'.DS.'Programme Kaizen'.DS.'Part_5'.DS.'SP_19'.DS.'PHPREST');

    defined('INC_PATH') ? null : define('INC_PATH', SITE_ROOT.DS.'includes');
    
    defined('CORE_PATH') ? null : define('CORE_PATH', SITE_ROOT.DS.'core');
    defined('CORE_PATH_CLASS') ? null : define('CORE_PATH_CLASS', CORE_PATH.DS.'class');

    // Load the config file first
    require_once(INC_PATH.DS.'config.php');

    // core classes
    require_once(CORE_PATH_CLASS.DS.'post.php');
?>