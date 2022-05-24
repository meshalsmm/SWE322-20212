<?php

	// constants 
    define("host_ip", "localhost"); // 127.0.0.1
    define("username", "root");
    define("password", "");
    define("database", "course_enrollment_db");

	$conn = mysqli_connect(host_ip, username, password, database);

	if(!$conn){
		echo "Debugging error nomber: " . mysqli_connect_errno();
		echo "<br>";
		echo "Debugging error: ". mysqli_connect_error();
		exit;
	}

?>
