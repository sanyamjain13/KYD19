<?php
	$serverName = "localhost";
	$username = "root";
	$password = "";
	$dbName="KYD";
	
	$conn = new mysqli($serverName, $username, $password);
	
	if($conn->connect_error)
	{
		die("Connection failed".$conn->connect_error);
	}
	
	//Create database
	$sql = "CREATE DATABASE ".$dbName;
	if($conn->query($sql) === TRUE)
	{
		echo "Database created successfully";
	}	
	else
	{
		echo "Error creating database: ".$conn->error;
	}
	
	$conn->close();
?>