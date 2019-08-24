<?php
	session_start();
	include 'header.php';
?>

<html>
	<head>
		<title>Book an appointment</title>
		<?php
			if(isset($_SESSION['message']))
			{
				$errormsg=$_SESSION['message'];
				echo "<script type='text/javascript'>alert('$errormsg');</script>";
				unset($_SESSION['message']);
			}
		?>
		<script type="text/javascript">
		function AjaxFunction()
		{
			var httpxml;
			try
			{
				// Firefox, Opera 8.0+, Safari
				httpxml=new XMLHttpRequest();
			}
			catch (e)
			{
				// Internet Explorer
				try
   			 	{
					httpxml=new ActiveXObject("Msxml2.XMLHTTP");
    			}
				catch (e)
				{
					try
					{
						httpxml=new ActiveXObject("Microsoft.XMLHTTP");
					}
					catch (e)
					{
						alert("Your browser does not support AJAX!");
						return false;
					}
				}
			}
			function stateck() 
			{
				if(httpxml.readyState==4)
				{	
					var myarray = JSON.parse(httpxml.responseText);
					// Remove the options from 2nd dropdown list 
					for(j=document.testform.docname.options.length-1;j>=0;j--)
					{
						document.testform.docname.remove(j);
					}
					for (i=0;i<myarray.data.length;i++)
					{
						var optn = document.createElement("OPTION");
						optn.text = myarray.data[i];
						optn.value = myarray.data[i];
						document.testform.docname.options.add(optn);

					} 
				}
			} // end of function stateck
			var url="editDoctorList.php";
			var category=document.getElementById('spec').value;
			url=url+"?category="+category;
			url=url+"&sid="+Math.random();
			httpxml.onreadystatechange=stateck;
			
			httpxml.open("GET",url,true);
			httpxml.send(null);
		}
		
		function validateInput()
		{
			var spec = document.getElementById("spec").value;
			if(spec == "" || spec == "None")
			{
				alert("Please select SPECIALIZATION.");
				return false;
			}
			else
			{
				var doc = document.getElementById("docname").value;
				if(doc == "")
				{
					alert("Please select DOCTOR.");
					return false;
				}
			}
			return true
		}
</script>
		
		
		
	</head>

	<body>
		<br><br>
		<div style="width:100%">

			<div style="float:left; width:70%; margin-left:20px; height:50%">
				
				<form name="testform" method="POST" action="checkAppointment.php" onsubmit="return validateInput()">
					
					<font face = "Monsteraat Light" > SPECIALIZATION </font>		: <select name="spec" id="spec" onchange=AjaxFunction()>
							<option value="None" disabled selected>Select</option>
							<?php
								$conn = new mysqli("localhost","root","","KYD");
								if($conn->connect_error)
								{
									die("Connection failed : ". $conn->connect_error);
								}
								$s = "SELECT DISTINCT category FROM Doctor";
								$r = $conn->query($s);
								if($r->num_rows>=1)
								{
									while($row = $r->fetch_assoc())
									{
										$category = $row['category'];
										echo "<option value=\"".$category."\">".$category."</option>";
									}	
								}
								$conn->close();
							?>
					  	  </select><br><br>
						  
					<font face = "Monsteraat Light" > DOCTOR'S NAME : </font> <select name="docname" id="docname">
					</select> <br><br>
					
					<font face = "Monsteraat Light" > DATE OF APPOINTMENT : </font> <input type="date" name="appdate" min="<?php echo date('Y-m-d');?>" max="<?php $Date = date('Y-m-d'); echo date('Y-m-d', strtotime($Date.'+ 10 days'));?>"> <br><br>
					<input type="submit">
					
				</form>
			</div> 

		</div>
	</body>
</html>