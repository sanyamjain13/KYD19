<?php
	session_start();
	include 'connection.php';
?>
<?php
	
	if(isset($_REQUEST['email']))
	{
		$sql="SELECT * FROM users WHERE Email='".$_REQUEST['email']."'";
		$result=$conn->query($sql);
		if($result->num_rows>0)
		{
			echo "Email ID already exists.";
		}
	
	}

	if(isset($_REQUEST['phoneNo']))
	{
		$sql="SELECT * FROM users WHERE Mobile='".$_REQUEST['phoneNo']."'";
		$result=$conn->query($sql);
		if($result->num_rows>0)
		{
			echo "Mobile No already registered.";
		}
	}

	if(isset($_REQUEST['fname'])){

		$fname=$_REQUEST['fname'];
		$lname=$_REQUEST['lname'];
		$email=$_REQUEST['email'];
		$password=$_REQUEST['password'];
		$phoneNo=$_REQUEST['phoneNo'];
		$gender=$_REQUEST['gender'];
		$sql2="INSERT INTO users(Fname, Lname, Email, Password,Mobile,Gender) VALUES('$fname','$lname','$email','$password',$phoneNo,'$gender')";
		if ($conn->query($sql2) === TRUE)
		{
			$_SESSION['user']=$fname." ".$lname;
			$sql="SELECT * FROM users WHERE Email='".$_REQUEST['emailID']."'";
			$result=$conn->query($sql);
			$rows=mysqli_fetch_assoc($result);
			$_SESSION['userID']=$rows['UserId'];

		}

	}
	
	if(isset($_REQUEST['emailID']) && isset($_REQUEST['passwordID']))
	{
		$sql="SELECT * FROM users WHERE Email='".$_REQUEST['emailID']."' AND Password='".$_REQUEST['passwordID']."'";
		$result=$conn->query($sql);
		if($result->num_rows<=0)
		{
			echo "Invalid email or password";
		}
		else{
			$rows=mysqli_fetch_assoc($result);
			$_SESSION['user']=$rows['Fname']." ".$rows['Lname'];
			$_SESSION['userID']=$rows['UserId'];
		}

	}

	if(isset($_REQUEST['signOut']))
	{
		unset($_SESSION['user']);
		unset($_SESSION['userID']);
	}
?>