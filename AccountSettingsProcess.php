<?php session_start();
include 'connection.php';
$userid=$_SESSION['userID'];


if (isset($_REQUEST['fname'])){

	$fname=$_REQUEST['fname'];
	$lname=$_REQUEST['lname'];
	$_SESSION['user']=$fname.' '.$lname;
	$update="UPDATE users SET Fname='$fname',Lname='$lname' WHERE UserId='$userid'";
	$run=mysqli_query($conn,$update);

}

if (isset($_REQUEST['contact'])) {

	$update="UPDATE users SET Mobile='$_REQUEST[contact]' WHERE UserId='$userid'";
	$run=mysqli_query($conn,$update);
}

if (isset($_REQUEST['contactCheck'])) {

	$mobile=$_REQUEST['contactCheck'];	
	$select="SELECT * FROM users WHERE UserId !=$userid AND Mobile LIKE '".$mobile."%'";
	$run=mysqli_query($conn,$select);
	
	if(mysqli_num_rows($run)) {echo 'duplicate' ;}
	
	else{ echo 'correct';}
	
}


if (isset($_REQUEST['password'])) {
	
	$select="SELECT * FROM users WHERE UserId='$userid'";
	$run=mysqli_query($conn,$select);
	if(mysqli_num_rows($run))

	$row=mysqli_fetch_assoc($run);
	
	if ($_REQUEST['password']=="") {
		echo "";		
	}

	else if($row['Password']==$_REQUEST['password'])
	{
		echo "<i class='fas fa-check text-success small'></i>";
	}

	else
	{
		echo "<i class='fas fa-times text-danger small'></i>";

	}
	
}

?>