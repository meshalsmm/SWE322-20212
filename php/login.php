<?php require_once('../WWW/header.php');?>
<!DOCTYPE html>
<html>
<head>
  <title>Sing In</title>
</head>
<body>
<center>

<h1> SIGN IN </h1>

<form action="../php/login_auth.php" method="post">
  <label>  E-Mail Adress: </label>
  <input type="text" name="email" id="EmailAdress" placeholder="Email Adress"><br><br>

  <label>  Password: </label>
  <input type="Password" name="password" id="Password" placeholder="Password"><br><br>

  <input type="submit" value="Sign In"/>

</form> </center>

</body>
</html>