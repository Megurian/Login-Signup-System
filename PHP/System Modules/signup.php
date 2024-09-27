<?php
require_once 'C:\xampp\htdocs\LoginSignup System\PHP\DB_Modules\account.class.php';
require_once 'functions.php';

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
    }

    //Validation Last name
    if(empty($last_name)) {
        $last_nameE = 'First name is required to signup';
    } elseif(is_numeric($last_name)) {
        $last_nameE = 'Enter a valid first name';
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
        $salt = bin2hex(random_bytes(16));
        $encrytedPassword = modifiedPasswordHashing($confirm_password, $salt);

        $accountObj->username = $username;
        $accountObj->email = $email;
        $accountObj->first_name = $first_name;
        $accountObj->last_name = $last_name;
        $accountObj->password = $encrytedPassword;
        $accountObj->salt = $salt;
            
        if($accountObj->userSignup()) {
            header('location: login.php');
        } else {
            echo '<script>alert("Something went wrong when signing up")</script>';
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="https://classless.de/classless.css">
</head>
<body>
    <form action="" method="post">
        <h2>Account Sign-up</h2>
        <p>All field are required</p>
        <hr><br>
        
        <label for="email">Enter your email:</label><br>
        <input type="text" name="email" placeholder="Enter your email:" value="<?php echo $email; ?>">
        <?php if(!empty($emailE)): ?>
            <span class="error" style="color: red;"><?= $emailE ?></span><br>
        <?php endif; ?>
        <br>

        <label for="first_name">Enter your first name:</label><br>
        <input type="text" name="first_name" placeholder="Enter first name:" value="<?php echo $first_name; ?>">
        <?php if(!empty($first_nameE)): ?>
            <span class="error" style="color: red;"><?= $first_nameE ?></span><br>
        <?php endif; ?>
        <br>

        <label for="last_name">Enter your last name:</label><br>
        <input type="text" name="last_name" placeholder="Enter last name:" value="<?php echo $last_name; ?>">
        <?php if(!empty($last_nameE)): ?>
            <span class="error" style="color: red;"><?= $last_nameE ?></span><br>
        <?php endif; ?>
        <br>
        
        <label for="password">Create password:</label><br>
        <input type="password" id="password" name="password" placeholder="Enter at least 8 characters password">
        <?php if(!empty($passwordE)): ?>
            <span class="error" style="color: red;"><?= $passwordE ?></span><br>
        <?php endif; ?>
        <br>

        <label for="confirm_password">Confirm your password</label><br>
        <input type="password" name="confirm_password" placeholder="Confirm your password">
        <?php if(!empty($confirm_passwordE)): ?>
            <span class="error" style="color: red;"><?= $confirm_passwordE ?></span><br>
        <?php endif; ?>
        <br>

        <input type="submit" value="Sign-up" style="background-color: rgb(109, 202, 55);">
    </form>
</body>
</html>