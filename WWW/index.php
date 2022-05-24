<?php require_once('../WWW/header.php');?>
<!DOCTYPE html>
<html>
<!DOCTYPE html>
<html>
<head>
  <title>HOME</title>
</head>
<body>

<p id="demo"></p>
<?php
    include('../config/db_login.php');

    if (isset($_SESSION['id'])) {
        $name = $_SESSION['name'];
        echo "<h1>Welcome,  $name</h1></br>;
                <h3>";             
    }else {
        echo "<h3>Please <a href=../php/login.php>Sign In</a>.</h3>";
        echo "<h3> Or <a href=../php/reg.php> Sing Up </a><h3>";
    }
    // close connection
    mysqli_close($conn);
?>
  <h3> SWE System <br>
    An online system to make you do your own schedule without the need to visit your university.</h3>
    <p>Please Sign In/Sign Up to Enroll courses or drop and check your enrolled classes</p>
</body>
</html>

