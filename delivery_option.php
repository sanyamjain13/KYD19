<?php session_start();
include 'connection.php';
?>
<!DOCTYPE html>
<html>
<head>
	
	<title>DELIVERY</title>

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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/delivery_option.css">
	<link rel="stylesheet" type="text/css" href="css/buy_medicines.css">
	<link rel="stylesheet" type="text/css" href="css/progress_bar.css">
	
	<!-- Cabin for Title -->
	<link href='https://fonts.googleapis.com/css?family=Cabin' rel='stylesheet' type='text/css'>
	<script>

		//function to check which radio button address is checked and retrieving the value
		//value of button is the primary key or the id in database
		//getting the value of the id of address in database and passing it with the link
		function get_radio_val(val)
		{
			
			window.location='payment.php?addID='+val;

		}

		//function to delete address from the database and the list

		//onclicking the cross button deleting the address
		function deleteAddress(eleid)
		{
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function()
			{
				if(xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					document.getElementById('refreshAjax').innerHTML=xmlhttp.responseText;
				}
			}
			xmlhttp.open('GET','category_process.php?addressID='+eleid,true);
			xmlhttp.send();
		}

		function redirect()
		{
			window.location='cart.php';
		}

		
	</script>

</head>
<style>
	input::placeholder{
	color: white;
}
</style>

<body style="background: #f1f1f1;">
<!-- --------------------------------------------------------------------------------------------- -->

<!-- THE DELIVERY GIF -->
<img src="images/delivery.gif" class="col-md-7 offset-6 pt-5 pr-0" 
style="height: 80%; width: 50%; position: absolute; top: 16%;  z-index: -1">

<div id="refreshAjax"><!-- Ajax data for refresh coming after deleting --></div>

<!-- --------------------------------------------------------------------------------------------- -->

<!-- NAVBAR 1 -->
<nav class="navbar navbar-expand-sm bg-light" id="navbar1">
	<div class="container">
		
		<!-- brand name -->
		<div class="navbar-brand flex-column">
			<div id="brand" class="text-center"> <i class="fas fa-capsules text-muted small"></i> kyd<span id="brand_com" class="text-muted">.com</span></div>
			<div id="brand_subhead" class="mt-n1 text-muted text-center">Humari Pharmacy</div>
		</div>
		
		<!-- cart -->
		<div class=" text-dark p-1 ml-auto" style="border:none; cursor: pointer;" onclick="redirect()">
			<img src="images/cart.png" class="img-fluid">
		</div>
		<span id="cart-count" class="mt-n4 ml-n3 pr-1 pl-1 text-center">
		<?php
			if(sizeof($_SESSION['cart'])==0)
			{echo '';}
			
			else { echo sizeof($_SESSION['cart']);  } 
		?>
			
		</span>
			
		<!-- greeting -->
		<div id="greetings" class="text-muted ml-2 pl-1">Hi, <?php echo $_SESSION['user'];?>!</div>
	</div>
</nav>

<!-- ----------------------------------------------------------------------------------------------- -->
	<!-- PROCESS STATUS BAR -->

	<div class="col-md-12 row justify-content-center py-2 mx-0" style="background: #116daa;">
		
		<!-- buy med -->
		<div class="widget">
			<div class="status_icons rounded-circle border-info bg-light glow" title="Medicines Selected"
			onclick="window.location='buy_medicines.php'">
				<div class="fas fa-check text-info my-auto"></div>
			</div>
			<div class="widget-text">Medicines Selected</div>
		</div>
		<hr class="custom-hr-solid">

		<!-- cart -->
		<div class="widget">
			<div class="status_icons rounded-circle border-info bg-light glow" title="Items Added to the Cart"
			onclick="window.location='cart.php'">
				<div class="fas fa-check text-info my-auto"></div>
			</div>
			<div class="widget-text">Cart</div>
		</div>
		<hr class="custom-hr-solid">
		
		<!-- delivery address -->
		<div class="widget">
			<div class="status_icons rounded-circle border-info glow" title="Select Your Delivery Address">
				<div class="fas fa-map-pin text-light my-auto"></div>
			</div>
			<div class="widget-text">Delivery Address</div>
		</div>
		<hr class="custom-hr-dashed">
			
		<!-- payment -->
		<div class="widget">
			<div class="status_icons rounded-circle border-info" title="Make Your Payment">
				<div class="far fa-credit-card text-info my-auto"></div>
			</div>
			<div class="widget-text">Payment Options</div>
		</div>
		<hr class="custom-hr-dashed">
		
		<!-- receipt -->
		<div class="widget">
			<div class="status_icons rounded-circle border-info" title="Generate Your Receipt">
				<div class="fas fa-file-invoice text-info my-auto"></div>
			</div>
			<div class="widget-text">Receipt</div>
		</div>

	</div>

<div class="container-fluid pl-4">


<!-- --------------------------------------------------------------------------------------- -->
	<div id="deliver_to" class="mt-4">
		
		<!-- heading "deliver to" -->
		<div class=" col-md-3 text-secondary pl-0"id="head_deliver_to">  
			Deliver To &nbsp;<i class="fas fa-map-marker-alt"></i>
			
		</div>
		
		<!-- list of all the address user have saved -->
		<form class="list-group col-md-6 py-1 mt-2" id="address_list" >

			<!-- RADIO BUTTON FOR THE SAVED ADDRESSES -->
			<?php
				$userid=$_SESSION['userID'];
				$select="SELECT * FROM shipping_details WHERE user_id='$userid'";
				$run=mysqli_query($conn,$select);
				if(mysqli_num_rows($run))
				{
					while ($rows=mysqli_fetch_assoc($run)) 
					{
					echo "
					<div class='list-group-item  bg-light d-flex flex-row py-2 user_address' style='box-shadow:0 0 6px grey; opacity:0.7;'>

						<input type='radio' name='deliver_to' class='my-auto' 
						value='$rows[radio_id]' style='transform:scale(1.3,1.3);' 
						onclick='get_radio_val(this.value);'> 
						
						<label class='col-md-10 pl-3 add_detail'>
									
							<div class='font-weight-bold text-capitalize py-1' style='font-size:18px;'>$rows[name] - $rows[contact]</div>

							<div class='small text-capitalize font-italic '> $rows[houseno]  $rows[area]  
							 near $rows[landmark] , $rows[state]  $rows[town]-$rows[pincode] </div>
						
						</label>

						<button class='close small px-3 col-md-2' title='Delete Address'
						onclick='deleteAddress($rows[radio_id]);'>&times;</button>

					</div>
					";    
					}
				}
			?>
		
			<!-- ADD NEW ADDRESS OPTION -->
			<div class="btn btn-info" id="add_address" data-toggle='modal' data-target='#shipping_add' data-keyboard='false' data-backdrop='static'>
				
				Add a new delivery address
				<div class="fas fa-home col-md-1  py-2 small text-light ml-auto"></div>
			</div> 
		<!-- list ends -->

		</form>
		
	</div>

	
</div>

	
<!-- ----------------------------------------------------------------------------------------------- -->
	
	<script>
		function resetForm()
		{
			var form= document.getElementById('address_form');
			form.reset();
		}
	</script>
	<!-- form for adding new address where delivery should happen -->
	
	<div id="shipping_add" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header bg-light">
					<div id="shipping_details_heading">
						<i class="fas fa-home"></i> &nbsp;Enter Your Shipping Details 
					</div>

					<button class="close small pt-0 pr-2" onclick="resetForm();" data-dismiss='modal' id="closeModal">&times;
					</button>
				</div>

				<form method="post" class="modal-body py-1 px-3" id="address_form">

					<!-- name -->
					<div class="form-group">
						<input type="text" name="name" class="input_text form-control" 
						placeholder=" Full name" required>
					</div>
					
					<!-- contact no -->
					<div class="form-group">
						<input type="text" name="mobile_no" class="input_text form-control" placeholder="Mobile number" required>
					</div>
					
					<!-- pincode -->
					<div class="form-group">
						<input type="text" name="pincode" class="input_text form-control" 
						placeholder="Pincode" required>
					</div>
					
					<!-- Town or city -->
					<div class="form-group">
						<input type="text" name="town" class="input_text form-control" placeholder="Town/City" required>
					</div>
					
					<!-- state -->
					<div class="form-group">
						<input type="text" name="state" class="input_text form-control" placeholder="State" required>
					</div>
					
					<!-- house number -->
					<div class="form-group">
						<input type="text" name="houseno" class="input_text form-control" placeholder="Flat, House no, Building, Company, Apartment" required >
					</div>
					
					<!-- area,colony,locality -->
					<div class="form-group">
						<input type="text" name="area" class="input_text form-control" placeholder="Area, Colony, Street, Sector, Village" required>
					</div>
					
					<!-- landmark -->
					<div class="form-group">
						<input type="text" name="landmark" class="input_text form-control" placeholder="Landmark e.g. near akash hospital" required >
					</div>

					<input type="submit" name="submit_address" value="Submit Details" 
					class="btn btn-info btn-block my-3">
				
				</form>					
			</div>
		</div>
	</div>
<!-- -------------------------------------------------------------------------------------------------------- -->
	<?php
		// PHP CODE FOR ENTERING THE DETAILS OF ADDRESS INTO THE DATABASE
		if (isset($_POST['submit_address'])) 
		{
			$name=mysqli_real_escape_string($conn,$_POST['name']);
			$contact=mysqli_real_escape_string($conn,$_POST['mobile_no']);
			$pin=mysqli_real_escape_string($conn,$_POST['pincode']);
			$town=mysqli_real_escape_string($conn,$_POST['town']);
			$state=mysqli_real_escape_string($conn,$_POST['state']);
			$houseno=mysqli_real_escape_string($conn,$_POST['houseno']);
			$area=mysqli_real_escape_string($conn,$_POST['area']);
			$landmark=mysqli_real_escape_string($conn,$_POST['landmark']);
			$userid=$_SESSION['userID'];

			$insert="INSERT INTO `shipping_details` (`radio_id`, `user_id`, `name`, `contact`, `pincode`, `town`, `state`, `houseno`, `area`, `landmark`) VALUES (NULL, $userid, '$name', $contact, $pin, '$town', '$state', '$houseno', '$area', '$landmark')";

			// $conn->query($insert);
			mysqli_query($conn,$insert);
						
			$select="SELECT * FROM shipping_details WHERE user_id='$userid' ORDER BY radio_id DESC LIMIT 1";
			$run=mysqli_query($conn,$select);
			if($run){
				$row=mysqli_fetch_assoc($run);
			?>
			<script> 
				window.location='payment.php?addID='+<?php echo $row['radio_id'];?> ;</script>
			<?php
			}
		}	
	?>
<!-- -------------------------------------------------------------------------------------------------------- -->

</body>
</html>