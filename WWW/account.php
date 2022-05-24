<?php require_once('../WWW/header.php');?>
<!DOCTYPE html>
<html>
<head>
    <title>Account</title>
</head>
<body>
<?php
    include('../config/db_login.php');
    if (isset($_SESSION['id'])) {
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        $id = $_SESSION['id'];
        echo "<h1>Welcome back $name.</h1><br>
                <h3>Your Email address is: $email <br>
                Your ID number is: $id </h3>";
    }else {
        echo "<h3>Please <a href=../php/login.php>Sign In</a>.</h3>";
        echo "<h3> Or <a href=../php/reg.php'> Register </a><h3>";
    }
    // close connection
    mysqli_close($conn);
?>
</body>
</html>
