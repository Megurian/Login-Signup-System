<?php
require_once '../../src/utils/session_start.php'; 

/* if(isset($_SESSION['account'])){
    if(!$_SESSION['account']['is_staff']){
        header('location: login.php');
    }
}else{
    header('location: login.php');
} */

echo 'Your emails: ' . $_SESSION['account']['email'] . '<br>';
echo 'Your username: ' . $_SESSION['account']['username'] . '<br>';
echo 'Your password: ' . $_SESSION['account']['password'] . '<br>';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="..\..\src\utils\session_end.php"> Logout </a>   
</body>
</html>