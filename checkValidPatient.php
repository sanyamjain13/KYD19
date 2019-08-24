<?php
	session_start();
?>
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
	
	$email=$_POST['email'];
	$password=$_POST['password'];
	

	$e = (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? FALSE : TRUE;


	if($e)
	{
		$sql="SELECT * FROM Patient WHERE password=\"".$password."\" AND email=\"".$email."\"";
	}
	else
	{
		$sql="SELECT * FROM Patient WHERE password=\"".$password."\" AND phoneNo=\"".$email."\"";
	}
	
	$result=$conn->query($sql);
	
	if($result->num_rows==1)
	{
		$row=$row = $result->fetch_assoc();
		$_SESSION['pname']=$row['patientName'];
		header('location: sidebar.php');
	}
	else
	{
		$_SESSION['email']=$email;
		$_SESSION['message'] = "Invalid password.";
		echo "<script>window.open('loginModal.php','_self')</script>";
	}
	$conn->close();
?>