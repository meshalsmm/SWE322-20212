<?php require_once('../WWW/header.php');?>
<!DOCTYPE html>
<html>
<head>
    <title>Registerd courses</title>
</head>
<body>
<?php
    include('../config/db_login.php');
    echo "<h1>Student courses</h1>";

    if (isset($_SESSION['id'])) {
        $id = htmlspecialchars($_SESSION['id']);

        // show only courses enrolled for the current user in session
        $query = "SELECT * FROM course WHERE course_id IN (SELECT course_id FROM enrollment WHERE user_id = '$id');";
        $result = mysqli_query($conn, $query);

        if(mysqli_query($conn, $query)){
          if(mysqli_num_rows($result) > 0){
            echo (
              "<h3><table class='center'>
                 <tr>
                   <th> Drop </th>
                   <th> Course Code </th>
                   <th> Course Name </th>
                 </tr>");

             while($rows = mysqli_fetch_row($result)){
              if ($rows[3] < $rows[4]) {  // check if class not full
                echo (
                "<tr> <form action='course_schedule.php' method='post'>
                  <td> <input type='checkbox' name='class_id[]' value='$rows[0]'></td>
                  <td> $rows[1] </td>
                  <td> $rows[2] </td>
                </tr>");
                $class_id_num_enrolled[$rows[0]] = $rows[3]; // array of all classes id , number of students enrolled
              }
            }
              echo ("</table> <br/> <input type='submit' name='drop' value='Confirm Dropping'/> </h3>");
          }
        }
    }else {
    echo "<h3>Please <a href=login.php>Sign In</a> to see your courses.</h3>";
    }

    // if post request has class checked classes, confirm dropping selected classes
    if (isset($_POST['drop']) && !empty($_POST['class_id'])) {
    $drop_classes_id = $_POST['class_id']; // array of classes id to drop
    $num_classes = count($drop_classes_id);

    // update database with new num of students and drop enrollment rows
    for ($i = 0; $i < $num_classes; $i++) {
        $new_num_enrolled = $class_id_num_enrolled[$drop_classes_id[$i]]-1;

        // update number of enrolled in course table
        $query1 = "UPDATE course SET number_enrolled_students = '$new_num_enrolled' WHERE course_id = '$drop_classes_id[$i]'";

        // drop enrollment row in enrollment table
        $query2 = "DELETE FROM enrollment WHERE user_id = $id && $drop_classes_id[$i] = course_id";

        $result1 = mysqli_query($conn, $query1);
        $result2 = mysqli_query($conn, $query2);

        
        if (!$result1 = mysqli_query($conn, $query1) || !$result2 = mysqli_query($conn, $query2)) {
            die('An error occurred');
        }
    }
    echo("<meta http-equiv='refresh' content='0'>"); // reload the page to update content

    }else if(isset($_POST['drop']) && empty($_POST['class_id'])) { // if pressed confirm and no classes selected
        echo "<h3> Please select <a href='course_schedule.php'>Courses</a> to drop from </h3> <br>";
    }

    // close connection
    mysqli_close($conn);
?>
</body>
</html>
