<?php require_once('../WWW/header.php');?>
<!DOCTYPE html>
<html>
<head>
    <title>Course Enrollment</title>
</head>
<body>
<?php 
  include('../config/db_login.php');
  echo "<h1>Available Courses</h1>";

  if (isset($_SESSION['id'])) {
  	$id = htmlspecialchars($_SESSION['id']);

    // show only courses not enrolled for the current user in session
    $query = "SELECT * FROM course WHERE course_id NOT IN (SELECT course_id FROM enrollment WHERE user_id = '$id');";
    $result = mysqli_query($conn, $query);

    if(mysqli_query($conn, $query)){
      if(mysqli_num_rows($result) > 0){
        echo (
          "<h3><table class='center'>
             <tr>
               <th> Select </th>
               <th> Course Code </th>
               <th> Course Name </th>
               <th> Remaining seats </th>
             </tr>");

         while($rows = mysqli_fetch_row($result)){
          if ($rows[3] < $rows[4]) {  // check if class not full
            echo (
            "<tr> <form action='../www/courses.php' method='post'>
              <td> <input type='checkbox' name='class_id[]' value='$rows[0]'></td>
              <td> $rows[1] </td>
              <td> $rows[2] </td>
              <td> $rows[4] - $rows[3] </td>
            </tr>");
            $class_id_num_enrolled[$rows[0]] = $rows[3]; // array of fetched classes id --> number of students enrolled
          }
        }
          echo ("</table> <br/> <input type='submit' name='enrollment' value='Confirm Erollment'/> </h3>");
      }
    }
  }else {
  	echo "<h3>Please <a href=../php/login.php>Sign In</a> to see available courses.</h3>";
  }

  // if post request has class checked classes, confirm adding classes
  if (isset($_POST['enrollment']) && !empty($_POST['class_id'])) {
    $enrolled_classes_id = $_POST['class_id']; // array of classes id to enroll
    $num_classes = count($enrolled_classes_id);

    // update database with new num of students and add new enrollment rows
    for ($i = 0; $i < $num_classes; $i++) {
        $new_num_enrolled = $class_id_num_enrolled[$enrolled_classes_id[$i]]+1;

        // update number of enrolled in course table
        $query1 = "UPDATE course SET number_enrolled_students = '$new_num_enrolled' WHERE course_id = '$enrolled_classes_id[$i]'";

        // insert new enrollment row in enrollment table
        $query2 = "INSERT INTO enrollment (user_id, course_id) VALUES ($id , $enrolled_classes_id[$i])";

        $result1 = mysqli_query($conn, $query1);
        $result2 = mysqli_query($conn, $query2);

        
        if (!$result1 = mysqli_query($conn, $query1) || !$result2 = mysqli_query($conn, $query2)) {
            die('An error occurred');
        }
    }
    echo("<meta http-equiv='refresh' content='0'>"); // reload the page to update content

  }else if(isset($_POST['enrollment']) && empty($_POST['class_id'])) { // if pressed confirm and no classes selected
    echo "<h3> Choose <a href='../www/courses.php'>Courses</a> you want to enroll </h3> <br>";
  }

  // close connection
  mysqli_close($conn);
?>
</body>
</html>