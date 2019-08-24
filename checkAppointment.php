<?php
	session_start();

	$conn = new mysqli("localhost", "root", "", "KYD");
	if($conn->connect_error)
	{
		die("Connection failed".$conn->connect_error);
	}
	$doctor=$_POST['docname'];
	$special = $_POST['spec'];
	$appdate=$_POST['appdate'];
	$weekday=date("l", strtotime($appdate));
	
	echo "Dr. ".$doctor."<br> Appointment day ".$weekday."<br>"."Specialization ".$special;

	$s = "SELECT * FROM Doctor WHERE doctorName=\"".$doctor."\" AND category=\"".$special."\"";
	$result = $conn->query($s);
	if($result->num_rows==1)
	{
		$w="";
		switch($weekday)
		{
			case "Monday" : {$w="M"; break;}
			case "Tuesday": {$w="T"; break;}
			case "Wednesday": {$w="W"; break;}
			case "Thursday" : {$w="Th"; break;}
			case "Friday"	: {$w="F"; break;}
			case "Saturday" : {$w="S"; break;}
			case "Sunday"	: {$w="Su"; break;}
		}
		
		$r=$result->fetch_assoc();
		$days = explode(",",$r['weekdays']);
		print_r($days);
		
		if(!in_array($w, $days))
		{
			$_SESSION['message']= $doctor." is available only on ".implode(',',$days);
			echo "<script>window.open('appointment.php','_self')</script>";
		}
		else
		{
			echo $r['consultation'];
			$_SESSION['fees']=$r['consultation'];
			header('location: paymentbegin.php');
		}
	}
	else
		echo "unsuccessful";
	
	$conn->close();
?>