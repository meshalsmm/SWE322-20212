<?php
    require_once('../WWW/header.php');
    include('../config/db_login.php');

   // values from the user input in the form
   $full_name =  $_POST['full_name'];
   $email = $_POST['email'];
   $user_password =  password_hash($_POST['user_password'], PASSWORD_DEFAULT);

   // find user with matching email and verify
   $query = "SELECT * from user WHERE email = '$email'";
   $result = mysqli_query($conn, $query);

   // check connection and perform query to check if email already exist or not
   if(mysqli_num_rows($result) == 0){
       add_user($conn, $full_name, $email, $user_password);
   }else {
       echo "<h1>Email already registered</h1>"; 
       echo "<h3>Go to the <a href=../php/login.php>Login</a> page to sign in</h3>";
       echo "<h3> Or <a href=../php/reg.php> Register </a> with different Email<h3>";
   }
   
   // insert into table "user"
   function add_user($conn, $usser_name, $email, $pass){
       $stmt = $conn->prepare('INSERT INTO user (full_name, email, user_password) VALUES(?,?,?)');
       $stmt->bind_param('sss', $usser_name, $email, $pass);
       $stmt->execute();
       echo "<h1>Registered Successfully</h1>"; 
       echo "<h3>Go to the <a href=../php/login.php>Login</a> page to sign in </h3>";
       $stmt->close();
   }

   // Close connection
   mysqli_close($conn);
?>