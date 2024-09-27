<?php
require_once 'C:\xampp\htdocs\LoginSignup System\PHP\DB_Modules\account.class.php';
require_once 'functions.php';
require_once 'session_start.php';

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
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://classless.de/classless.css">
</head>
<body>
    <form action="" method="post">
        <h2>Login</h2>
        <?php if(!empty($loginE)): ?>
            <span class="error" style="color: red;"><?= $loginE ?></span><br>
        <?php endif; ?>
        <hr><br>
        
        <label for="email_username">Enter email or username:</label><br>
        <input type="text" name="email_username" placeholder="Enter your email or username">
        <br>

        <label for="password">Enter your password:</label><br>
        <input type="password" name="password">
        <br>

        <input type="submit" value="Login" style="background-color: rgb(109, 202, 55);">
    </form>
    
</body>
</html>