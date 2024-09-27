<?php
require_once '../../src/utils/session_start.php'; 

$email =                $_SESSION['email'] ?? '';
$first_name =           $_SESSION['first_name'] ?? '';
$last_name =            $_SESSION['last_name'] ?? '';
$emailE =               $_SESSION['email_errors'] ?? '';
$first_nameE =          $_SESSION['first_name_errors'] ?? '';
$last_nameE =           $_SESSION['last_name_errors'] ?? '';
$passwordE =            $_SESSION['password_errors'] ?? '';
$confirm_passwordE =    $_SESSION['confirm_password_errors'] ?? '';

// Clear session variables after use
unset($_SESSION['email'],               $_SESSION['first_name'], 
      $_SESSION['last_name'],           $_SESSION['email_errors'], 
      $_SESSION['first_name_errors'],   $_SESSION['last_name_errors'], 
      $_SESSION['password_errors'],     $_SESSION['confirm_password_errors']);

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
    <form action="..\..\src\controllers\signup.php" method="post">
        <h2>Account Sign-up</h2>
        <p>All field are required</p>
        <hr><br>
        
        <label for="email">Enter your email:</label><br>
        <input type="text" name="email" placeholder="Enter your email:" value="<?php echo htmlspecialchars($email); ?>">
        <?php if(!empty($emailE)): ?>
            <span class="error" style="color: red;"><?= htmlspecialchars($emailE) ?></span><br>
        <?php endif; ?>
        <br>

        <label for="first_name">Enter your first name:</label><br>
        <input type="text" name="first_name" placeholder="Enter first name:" value="<?php echo htmlspecialchars($first_name); ?>">
        <?php if(!empty($first_nameE)): ?>
            <span class="error" style="color: red;"><?= htmlspecialchars($first_nameE) ?></span><br>
        <?php endif; ?>
        <br>

        <label for="last_name">Enter your last name:</label><br>
        <input type="text" name="last_name" placeholder="Enter last name:" value="<?php echo htmlspecialchars($last_name); ?>">
        <?php if(!empty($last_nameE)): ?>
            <span class="error" style="color: red;"><?= htmlspecialchars($last_nameE) ?></span><br>
        <?php endif; ?>
        <br>
        
        <label for="password">Create password:</label><br>
        <input type="password" id="password" name="password" placeholder="Enter at least 8 characters password">
        <?php if(!empty($passwordE)): ?>
            <span class="error" style="color: red;"><?= htmlspecialchars($passwordE) ?></span><br>
        <?php endif; ?>
        <br>

        <label for="confirm_password">Confirm your password</label><br>
        <input type="password" name="confirm_password" placeholder="Confirm your password">
        <?php if(!empty($confirm_passwordE)): ?>
            <span class="error" style="color: red;"><?= htmlspecialchars($passwordE) ?></span><br>
        <?php endif; ?>
        <br>

        <input type="submit" value="Sign-up" style="background-color: rgb(109, 202, 55);">
    </form>
</body>
</html>