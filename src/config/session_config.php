<?php
//this php file will handle security configuration of a session

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
    'lifetime' => 0,            //session cookie will end once browser is closed 
    'domain' => 'localhost',    //the domain you're using
    'path' => '/',              // '/' means any directory or sub-pages in the path
    'secure' => true,           // only HTTPS
    'httponly' => true          // cannot be accessed using JS
]);