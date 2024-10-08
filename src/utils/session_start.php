<?php
require_once __DIR__ . '/../config/session_config.php';
session_start();

//regenerate session ID every 10minutes
if (!isset($_SESSION['last_regenerated_session'])){ //check if a regenerated session ID exist if non-then regenerate one and timestamp

    session_regenerate_id(true);
    $_SESSION['last_regenerated_session'] = time();
} else {    //if existing
    $session_interval = 60 * 10;    //60sec * 30 = 30mins

    if (time() - $_SESSION['last_regenerated_session'] >= $session_interval){ //check if the existing session ID already expired, if yes regenerature new one
        
        session_regenerate_id(true);
        $_SESSION['last_regenerated_session'] = time();
    }
}