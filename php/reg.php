<?php require_once('../WWW/header.php');?>
<!DOCTYPE html>
<html>
<head>
  <title>Register</title>

</head>
<body>
  <center> 
  <h1> SIGN UP </h1>

  <form action="../php/reg_comfirm.php" method="post" onSubmit="return validate(this)">
    <label>Student Full Name: </label> 
    <input type="text" name="full_name" maxlength="32" id="fullname" placeholder="Full Name"> <br><br>

    <label>Your E-Mail Address:  </label> 
    <input type="text" name="email" maxlength="32" id="emailAddress" placeholder="Email Address"> <br><br>

    <label for="1password">Enter Your Password: </label> 
    <input type="Password" name="user_password" maxlength="32" id="1password" placeholder="Password" onkeyup="passwordCheck();"> <br><br>

    <label for="2password">Re-Type Your Password: </label> 
    <input type="Password" name="user_password2" maxlength="32" id="2password" placeholder="Password" onkeyup="passwordCheck();"> 
    
    <p id=pwasswordMessage>  </p>

    <input type="submit" value="Register!" id="btn"/>
  </form> </center>
</body>
</html>
