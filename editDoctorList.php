<?php

	@$category=$_GET['category'];

	$serverName = "localhost";
	$username = "root";
	$password = "";
	$dbname = "KYD";
	
	$conn = new mysqli($serverName, $username, $password, $dbname);

	if($conn->connect_error)
	{
		die("Connection failed : ".$conn->connect_error);
	}
	$sql = "SELECT doctorName from Doctor WHERE category='$category'";
	
	$result = $conn->query($sql);
	
	if($result->num_rows>=1)
	{
		$i=0;
		$doc=Array();
		while($row = $result->fetch_assoc())
		{
			$doc[$i] = $row['doctorName'];
			$i+=1;
		}
		$main = array('data'=>$doc);
		echo json_encode($main);
	}
	else
		echo "unsuccessful";
 ?>