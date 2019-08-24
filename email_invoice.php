<?php session_start();
include 'connection.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Bootstrap.css version 4.3.1 CDN -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<!--Fontawesome CDN -->
	<script src="https://kit.fontawesome.com/e79df9883a.js"></script>
	
	<!-- jquery cdn -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
	<script src="../../jquery/js/jquery.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>

	<body class="bg-light">


	<?php
	if (isset($_GET['oid'])) 
	{	
		$userId=$_SESSION['userID'];
		
		$select_user="SELECT * FROM users WHERE UserId='$userId'";
		$run_user=mysqli_query($conn,$select_user);
		$row_user=mysqli_fetch_assoc($run_user);
		$email_id=$row_user['Email'];

		$orderID=$_GET['oid'];
		
		require 'PHPMailerAutoload.php';
		require 'PhpMailer/credentials.php';

		$mail = new PHPMailer;
		$mail->SMTPDebug = false;                               // Enable verbose debug output

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com;smtp.yahoo.com';  	  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                              // Enable SMTP authentication
		$mail->Username = email;                 			// SMTP username
		$mail->Password = password;                         // SMTP password
		$mail->SMTPSecure = 'tls';                          // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                  // TCP port to connect to

		$mail->setFrom(email,'Know Your Disease ');  		//from which email id
		$mail->addAddress($email_id);     					//Add a recipient to whom we want to send

		$mail->addReplyTo(email);							//reply to which email

		// $mail->addCC('cc@example.com');
		// $mail->addBCC('bcc@example.com');

		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		
		$mail->isHTML(true);                                  // Set email format to HTML

		
		$select="SELECT * FROM orderhistory WHERE orderID='$orderID'";
		$run=mysqli_query($conn,$select);
		$orow=mysqli_fetch_assoc($run);

		$mail->Subject = "KYD ORDER RECEIPT: $orderID";

		$arr_pid=explode(',', $orow['PID']);
		$arr_qty=explode(',', $orow['quantity']);
		
		$totalItems=sizeof($arr_pid);


		$select_address="SELECT * FROM shipping_details WHERE radio_id='$orow[add_id]'";
		$run_add=mysqli_query($conn,$select_address);
		$addrow=mysqli_fetch_assoc($run_add);


		$mail->Body = 
		
		"		
		<table width='900'  align='center' cellpadding='14' >
		<thead>
			<tr bgcolor='#5bc0de' height='58'>
				<th style='font-size: 30px; font-family: sans-serif; letter-spacing: 1px; 
				text-shadow: 0 4px 8px white; box-shadow: 2px 0 4px grey;'>
					Thank you for your order 
				</th>
			</tr>

			<tr style='font-size: 15px; color: grey;
			letter-spacing: 1px; line-height: 23px; font-style: italic; word-spacing: 1px;'>
				<th align='left'>
					Your order has been received and is now being processed. Your order details
					are shown below for your reference. 
				</th>
			</tr>
		</thead>
		<tbody>
		<tr>
			<td style='font-size: 27px; font-family: Calibri; border-top: 3px solid #f1f1f1;
			border-bottom: 3px solid #f1f1f1; letter-spacing: 1.5px; text-shadow: 0 0 2px; color: grey;
			font-weight:bold;'>
			<span style='color: #5bc0de;'>ORDER</span> NO: $orderID</td>
		</tr>

		<tr>
			<td style='box-shadow: 0 0 14px #f1f1f1'>
				<table width='100%' border='1' cellspacing='0' cellpadding='10' bordercolor='#f1f1f1'>
					<thead>
					<tr style='font-size: 17px; letter-spacing: 2px; color: grey; font-weight: bold;'>
							<td>Product</td>
							<td>Quantity</td>
							<td>Price (&#8377;)</td>
						</tr>
					</thead>

					<tbody>

		";

			for($i=0; $i<sizeof($arr_pid);$i++) 
			{	
				$sel_product="SELECT * FROM medicineinfo WHERE PID = '$arr_pid[$i]'";
				$product_run=mysqli_query($conn,$sel_product);
				$product_row=mysqli_fetch_assoc($product_run);
				$mail->Body.=
				"<tr style='font-size: 15px; text-transform: capitalize; font-weight: bold;
				letter-spacing: 0.5px; word-spacing: 1px;'>
					<td>$product_row[Name]</td>
					<td>$arr_qty[$i]</td>
					<td>$product_row[Price]</td>
				</tr>"
				;
			}

			$mail->Body.=
			"
					<tr bgcolor='#f1f1f1'>
						<td colspan='3'></td>
					</tr>
					</tbody>
					<tbody>
						<tr>
							<td colspan='2' style='font-size: 17px; color: grey; font-weight: bold; letter-spacing: 1px;'>Cart Total &#8377;</td>
							<td style='font-size: 15px; font-weight: bold;'>$orow[total]</td>
						</tr>
						<tr>
							<td colspan='2' style='font-size: 17px; color: grey; font-weight: bold; letter-spacing: 1px;'>Total Number of Items</td>
							<td style='font-size: 15px; font-weight: bold; text-transform: capitalize;'>
							$totalItems</td>
						</tr>
						<tr>
							<td colspan='2' style='font-size: 17px; color: grey; font-weight: bold; letter-spacing: 1px;'>Payment Mode</td>
							<td style='font-size: 15px; font-weight: bold; text-transform: capitalize;'>
							$orow[payment_mode]</td>
						</tr>

					</tbody>
				</table>
			</td>
		</tr>

		<tr>
			<td style='font-size: 27px; font-family: Calibri; border-bottom: 3px solid #f1f1f1;
			letter-spacing: 1.5px; text-shadow: 0 0 2px; color: grey; font-weight:bold;'>
			<span style='color: #5bc0de;'>CUSTOMER</span> DETAILS</td>
		</tr>

		<tr>
			<td style='box-shadow: 0 0 10px #f1f1f1; border-bottom: 3px solid #f1f1f1;'>
				<table width='100%' cellspacing='1' cellpadding='6' >
					<tbody>
						<tr>
							<td colspan='2' style='font-size: 17px; font-family: Calibiri; 
							font-weight: bold;'>Buyer's Name</td>
							<td style='font-size: 15px; text-transform: capitalize; letter-spacing: 1px; color: grey'>$addrow[name]
							</td>
						</tr>
						<tr>
							<td colspan='2' style='font-size: 17px; font-family: Calibiri; 
							font-weight: bold; letter-spacing: 1px'>Email</td>
							<td style='font-size: 15px; text-transform: capitalize; letter-spacing: 1px; color: grey'>$email_id
							</td>
						</tr>
						<tr>
							<td colspan='2' style='font-size: 17px; font-family: Calibiri; 
							font-weight: bold; letter-spacing: 1px'>Contact</td>
							<td style='font-size: 15px; text-transform: capitalize; letter-spacing: 1px; color: grey'>+91-$addrow[contact]
							</td>
						</tr>

						<tr>
							<td colspan='2' style='font-size: 17px; font-family: Calibiri; 
							font-weight: bold; letter-spacing: 1px'>Shipping Address</td>
							<td width='46%' style='font-size: 15px; text-transform: capitalize; letter-spacing:0.5px; color: grey;line-height: 24px;'>
							$addrow[houseno] $addrow[area] $addrow[town] near $addrow[landmark]
							$addrow[state]-$addrow[pincode]
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>

		";
			
		$mail->AltBody = 'This is Your Order receipt!';

		if(!$mail->send()) {
		  
		    echo "<script>alert('message failed!')</script>";
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} 
		
		else {
		    echo "<script>alert('Invoice Successfully sent to Your Registered Email, Thank You ! ');
			window.location='buy_medicines.php';
		    </script>";
		}

	}	
?>
</body>
</html>