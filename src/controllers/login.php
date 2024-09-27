<?php
require_once __DIR__ . '/../utils/functions.php';
require_once __DIR__ . '/../db_modules/autoload_classes.php';
require_once __DIR__ . '/../utils/session_start.php';

$accountObj = new User();

$email = $username = null;
$password = '';
$loginE = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(filter_var($_POST['email_username'])){
        $email = clean_input($_POST['email_username']);
        var_dump($email);
    } else {
        $username = clean_input($_POST['email_username']);
        var_dump($username);
    }
    $password = clean_input($_POST['password']);


    if($accountObj->userLogin($email, $username, $password)) {
        echo "UserLogin is working";
        $data = $accountObj->fetchUser($email, $username);
        $_SESSION['account'] = $data;
        header("Location: /PHP/Web%20Pages/dashboard.php");
        
    } else {
        $loginE = 'Invalid username/password';

        $_SESSION['login_error'] = $loginE;
        header("Location: ..\..\public\html\login_form.php");
        exit;
    }
}