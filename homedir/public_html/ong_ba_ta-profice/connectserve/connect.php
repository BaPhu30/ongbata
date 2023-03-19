<?php

	// Database configuration 

	$sernamename = "localhost";
	$username    = "giaphaobt_user";
	$passoword   = "Qtthuchien2021";
	$databasename= "giaphaobt_data";
	
	

	// Create database connection
	$connect = new mysqli($sernamename, $username,$passoword,$databasename);
//   $connect -> set_charset("utf8");
	// Check connection
	if ($connect->connect_error) {
		die("Connection failed". $connect->connect_error);
	}

?>


