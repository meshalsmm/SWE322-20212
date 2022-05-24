<?php
  session_start();

  // check cookie to auto logout
  if (!isset($_COOKIE['timer'])) {
    logout();   
  }

  // each activity update the time
  setcookie('timer', 'x', time()+600); 

  // if "user agent" and "session ip" not equal to the curent user, logout 
  if (isset($_SESSION['check']) && $_SESSION['check'] !=  hash('ripemd128', $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'])) {
    logout();
  }

  // logout user when called
  function logout(){
    echo "<script> location.href='../php/logout.php'; </script>"; 
  }
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../src/style.css">
</head>
<body>
<div class="topnav">
  <a href="../www/index.php">Home</a>
  <a href="../www/courses.php">Courses</a>
  <a href="../www/course_schedule.php">Registerd courses</a>
  <a href="../www/about.php">About</a>
  <div class="topnav-right">
    <?php
      if (isset($_SESSION['id'])) {
        echo "<a href=../www/account.php >". $_SESSION['name']. "</a>";
        echo "<a href=../php/logout.php >Sign Out</a>";
      }else{
        echo "<a href=../php/login.php>Sign In</a>";
        echo "<a href=../php/reg.php>Sign Up</a>";
      }
    ?>
  </div>
</div>
</body>
</html>