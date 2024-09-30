<?php
require_once __DIR__ . '/../utils/functions.php';
require_once __DIR__ . '/../db_modules/autoload_classes.php';
require_once __DIR__ . '/../utils/session_start.php';

$accountObj = new User();


$email = $first_name = $last_name = $password = $confirm_password = '';
$emailE = $first_nameE = $last_nameE = $passwordE = $confirm_passwordE = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = clean_input($_POST['email']);
    $first_name = clean_input($_POST['first_name']);
    $last_name = clean_input($_POST['last_name']);
    $password = clean_input($_POST['password']);
    $confirm_password = clean_input($_POST['confirm_password']);

    //Validation Email
    if(empty($email)) {
        $emailE = 'Email is required to signup';
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailE = 'Please enter a valid email';
    }


    //Validation First name
    if(empty($first_name)) {
        $first_nameE = 'First name is required to signup';
    } elseif(is_numeric($first_name)) {
        $first_nameE = 'Enter a valid first name';
    } elseif(strlen($first_name) <= 1) {
        $first_nameE = 'Enter a valid first name';
    }

    //Validation Last name
    if(empty($last_name)) {
        $last_nameE = 'Last name is required to signup';
    } elseif(is_numeric($last_name)) {
        $last_nameE = 'Enter a valid last name';
    } elseif(strlen($last_name) <= 1) {
        $last_nameE = 'Enter a valid last name';
    }

    //Validation Password
    if(empty($password)) {
        $passwordE = 'Password is required to signup';
    } elseif(strlen($password) < 8) {
        $passwordE = 'Enter atleast 8 characters password';
    } elseif(empty($confirm_password)) {
        $confirm_passwordE = 'Please confirm your password';
    } elseif($confirm_password != $password) {
        $confirm_passwordE = 'Password does not match!';
    }
    
    if(empty($emailE) && empty($first_nameE) && empty($last_nameE) &&
       empty($passwordE) && empty($confirm_passwordE)) {
        
        $username = extractUsername($email);
        /* $salt = bin2hex(random_bytes(16)); */

        $encrytedPassword = password_hash($confirm_password, PASSWORD_ARGON2ID,['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 2]);    //this set the computational expense


        $accountObj->username = $username;
        $accountObj->email = $email;
        $accountObj->first_name = $first_name;
        $accountObj->last_name = $last_name;
        $accountObj->password = $encrytedPassword;
        /* $accountObj->salt = $salt; */
            
        if($accountObj->userSignup()) {
            header('location: ..\..\public\html\login_form.php');
        } else {
            echo '<script>alert("Something went wrong when signing up")</script>';
        }
     }else {
        $_SESSION['email'] = $email;
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['email_errors'] = $emailE;
        $_SESSION['first_name_errors'] = $first_nameE;
        $_SESSION['last_name_errors'] = $last_nameE;
        $_SESSION['password_errors'] = $passwordE;
        $_SESSION['confirm_password_errors'] = $confirm_passwordE;

        header('location: ..\..\public\html\signup_form.php');
        exit;
    }

}

