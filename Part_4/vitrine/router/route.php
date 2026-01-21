<?php 

// Here to add a new route
// $availableRoutes = 
// [
    // "filePath" => 
    // [
    //      "name" => name for conditions ("active" : "")
    //      "title" => your title of navigation tab
    //      "css" => file path of css dedicated to your new page 
    //      "js" => file path of js dedicated to your new page 
    //      "authorizeRole" => role you accept in your new page ("USER" / "ADMIN" / etc...)
    // ]
// ]


$availableRoutes = 
[
    
    // Homepage
    'home'    => 
    [
        'name' => 'home', // Customizable
        'title' => 'Homepage', // Customizable
        'css' => /*asset/css/*/'home'/*.css*/, // File Path / Not customizable
        'js' => 'script',
        'authorizeRole' => '', // Depends on how you declare your roles
    ],

    // About page
    'about' =>  
    [
        'name' => 'about',
        'title' => 'About', 
        'css' => 'about',
        'js' => 'script',
        'authorizeRole' => '',
    ],

    // Contact page
    'contact'   => 
    [
        'name' => 'contact',
        'title' => 'Contact', 
        'css' => 'contact',
        'js' => 'template/contact',
        'authorizeRole' => '',
    ],

    // Products page
    'products' =>  
    [
        'name' => 'products',
        'title' => 'Products', 
        'css' => 'products',
        'js' => 'script',
        'authorizeRole' => '',
    ],

    // Services page
    'services' =>  
    [
        'name' => 'services',
        'title' => 'Services', 
        'css' => 'services',
        'js' => 'script',
        'authorizeRole' => '',
    ],

    // Log in page
    'admin/login'   =>  
    [
        'name' => 'login',
        'title' => 'Log In', 
        'css' => 'admin/login',
        'js' => 'script',
        'authorizeRole' => '',
    ],

    // Admin products page (CRUD)
    'admin/products' =>  
    [
        'name' => 'adminProducts',
        'title' => 'ADMIN - Products',
        'css' => 'admin/products', 
        'js' => 'template/admin/products',
        'authorizeRole' => 'ADMIN',
    ],
 
    // Admin services page (CRUD)
    'admin/services' =>  
    [
        'name' => 'adminServices',
        'title' => 'ADMIN - Services', 
        'css' => 'admin/services',
        'js' => 'script',
        'authorizeRole' => 'ADMIN',
    ],

    // Admin dashboard page
    'admin/dashboard' =>  
    [
        'name' => 'dashboard',
        'title' => 'ADMIN - Dashboard', 
        'css' => 'admin/dashboard',
        'js' => 'script',
        'authorizeRole' => 'ADMIN',
    ],

    // Log out Page
    'admin/logout'   =>  
    [
        'name' => 'logout',
        'title' => 'Log out', 
        'css' => '',
        'js' => 'script',
        'authorizeRole' => 'ADMIN',
    ],
 
];

// $availableRoutes['home']['authorizeRole'] = '';
$route = 'home'; // Home is our "by default" page
$nameOfRoute = 'home';
$css = "home"; // By default is home
$js = "script"; // By default is script

if(!empty($_GET['route'])){
    $route = $_GET['route'];
}

//If $route exist in $availableRoutes
if(array_key_exists($route, $availableRoutes)) {
    $page = $route;
    $nameOfRoute = $availableRoutes[$route]['name'];
    $title = $availableRoutes[$route]['title'];
    $css = $availableRoutes[$route]['css'];
    $js = $availableRoutes[$route]['js'];
    $authorizeRole = $availableRoutes[$route]['authorizeRole'];
} else {
    // else Error 404 since your page as not been found
    http_response_code(404);
    $page = 'error/404';
    $title = 'Page not found';
    $css = "error/error";
    $js = "script";
    $authorizeRole = ""; // Need to be initialise empty, to prevent error and let everyone sees this page
}

?>