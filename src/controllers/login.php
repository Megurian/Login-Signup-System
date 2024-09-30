<?php
require_once __DIR__ . '/../utils/functions.php';
require_once __DIR__ . '/../db_modules/autoload_classes.php';
require_once __DIR__ . '/../utils/session_start.php';

$accountObj = new User();

$email = $username = null;
$password = '';
$loginE = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(filter_var($_POST['email_username'], FILTER_VALIDATE_EMAIL)){
        $email = clean_input($_POST['email_username']);
        $_SESSION['email'] = $email;
    } else {
        $username = clean_input($_POST['email_username']);
        $_SESSION['username'] = $username;
    }

    $password = clean_input($_POST['password']);


    if($accountObj->userLogin($email, $username, $password)) {
        echo "UserLogin is working";
        $data = $accountObj->fetchUser($email, $username);
        $_SESSION['account'] = $data;
        header("Location: ..\..\public\html\customer_dashboard.php");
        
    } else {
        $loginE = 'Invalid username/password';

        $_SESSION['login_error'] = $loginE;
        header("Location: ..\..\public\html\login_form.php");
        exit;
    }
}