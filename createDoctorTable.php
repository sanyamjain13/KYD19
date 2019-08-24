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

	$sql2 = "CREATE TABLE Doctor(
	doctorName VARCHAR(50) NOT NULL,
	email VARCHAR(50) PRIMARY KEY,
	password VARCHAR(50) NOT NULL,
	phoneNo INT(10) UNSIGNED NOT NULL,
	category VARCHAR(20) NOT NULL,
	weekdays CHAR(9) NOT NULL,
	timeSlotFrom TIME NOT NULL,
	timeSLotTo TIME NOT NULL,
	consultation INT NOT NULL);";

	if($conn->query($sql2) === TRUE)
	{
		echo "Doctor table created.";
	}
	else
	{
		echo "Error ".$conn->error;
	}

	$conn->close();
?>