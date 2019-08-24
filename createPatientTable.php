<?php
	$serverName = "localhost";
	$username = "root";
	$password = "";
	$dbname = "KYD";
	
	$conn = new mysqli($serverName, $username, $password, $dbname);
	
	if($conn->connect_error)
	{
		die("Connection failed: ".$conn->connect_error);
	}
	
	$sql = "CREATE TABLE Patient(
	patientName VARCHAR(50) NOT NULL,
	email VARCHAR(50) PRIMARY KEY,
	password VARCHAR(30) NOT NULL,
	phoneNo INT(10) UNSIGNED NOT NULL,
	gender CHAR NOT NULL,
	dob DATE NOT NULL)";
	
	if($conn->query($sql) === TRUE)
	{
		echo "Patient table created.";
	}
	else
	{
		echo "Error creating table: ".$conn->error;
	}
	
 	$conn->close();
?>
