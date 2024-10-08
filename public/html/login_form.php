<?php
require_once '../../src/utils/session_start.php'; 

$loginE = $_SESSION['login_error'] ?? '';

unset($_SESSION['login_error']);
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
    <form action="..\..\src\controllers\login.php" method="post">
        <h2>Login</h2>
        <?php if(!empty($loginE)): ?>
            <span class="error" style="color: red;"><?= htmlspecialchars($loginE) ?></span><br>
        <?php endif; ?>
        <hr><br>
        
        <label for="email_username">Enter email or username:</label><br>
        <input type="text" name="email_username" placeholder="Enter your email or username" value="">
        <br>

        <label for="password">Enter your password:</label><br>
        <input type="password" name="password" value="">
        <br>

        <input type="submit" value="Login" style="background-color: rgb(109, 202, 55);">
    </form>
    <br>
    <div style="display: flex; justify-content: space-evenly;">
        <a href="signup_form.php">Create an Account</a>
        <a href="">Forgot Password?</a>
    </div>
    
</body>
</html>