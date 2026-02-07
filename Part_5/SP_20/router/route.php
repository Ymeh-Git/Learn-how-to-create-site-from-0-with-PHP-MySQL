<?php 

// If constant is not defined error 403 + exit().
if (!defined('ACCESS_GRANTED')) {
    http_response_code(403);
    exit();
}

// How to add a new route
// $available_routes = 
// [
    // "filePath" => 
    // [
    //      "name" => name for conditions ("active" : "")
    //      "title" => your title of navigation tab
    // ]
// ]


$available_routes = 
[
    
    // Homepage
    'home'    => 
    [
        'name' => 'home', // Customizable
        'title' => 'Homepage', // Customizable
    ],
    
    // account page
    'account' =>  
    [
        'name' => 'account',
        'title' => 'Account',
    ],
    
    // signup page
    'auth/signup' =>  
    [
        'name' => 'signup',
        'title' => 'Sign up', 
    ],
        
    
    // activate account page
    'auth/activate-account' =>  
    [
        'name' => 'activate',
        'title' => 'Activate Account',
    ],
    
    // login page
    'auth/login' =>  
    [
        'name' => 'login',
        'title' => 'Log In',
    ],

    // logout page
    'auth/logout' =>  
    [
        'name' => 'logout',
        'title' => 'Log Out',
    ],
    
];

// $available_routes['home']['authorizeRole'] = '';
$route = 'home'; // Home is our "by default" page
$name_route = 'home';

if(!empty($_GET['route'])){
    $route = $_GET['route'];
}

//If $route exist in $available_routes
if(array_key_exists($route, $available_routes)) {
    $page = $route;
    $name_route = $available_routes[$route]['name'];
    $title = $available_routes[$route]['title'];
} else {
    // else Error 404 since your page as not been found
    http_response_code(404);
    $page = 'error/404';
    $title = 'Page not found';
}

?>