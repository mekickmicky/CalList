<?php

	// $hostname = 'localhost';
	// $username = 'u13550137';
	// $password = 'SpLH9x19fA';
	// $database = 'db13550137';

	$hostname = 'localhost';
	$username = 'root';
	$password = '';
	$database = 'callist';


	$con = mysqli_connect($hostname,$username,$password,$database);
	if (mysqli_connect_errno()){
	  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	mysqli_select_db($con,"callist");
	mysqli_set_charset($con,"utf8");
	date_default_timezone_set("Asia/Bangkok");
	ini_set('max_execution_time', 300);
	session_start();
 ?>
