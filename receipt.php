<?php session_start();
include 'connection.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>RECEIPT</title>

	<!-- Bootstrap.css version 4.3.1 CDN -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	<!--Fontawesome CDN-->
	<script src="https://kit.fontawesome.com/e79df9883a.js"></script>
	<link rel="stylesheet" type="text/css" href="css/progress_bar.css">

	
	<!-- jquery cdn -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- <script src="../../jquery/js/jquery.js"></script> -->
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/receipt.css">

</head>


<body style="overflow-x: hidden;" >

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
			<div class="status_icons bg-light rounded-circle border-info glow" title="Select Your Delivery Address">
				<div class="fas fa-check text-info my-auto"></div>
			</div>
			<div class="widget-text">Delivery Address</div>
		</div>
		<hr class="custom-hr-solid">
			
		<!-- payment -->
		<div class="widget">
			<div class="status_icons bg-light rounded-circle border-info" title="Make Your Payment">
				<div class="fas fa-check text-info my-auto"></div>
			</div>
			<div class="widget-text">Payment Options</div>
		</div>
		<hr class="custom-hr-solid">
		
		<!-- receipt -->
		<div class="widget">
			<div class="status_icons bg-light rounded-circle border-info" title="Generate Your Receipt">
				<div class="fas fa-check text-info my-auto"></div>
			</div>
			<div class="widget-text">Receipt</div>
		</div>

	</div>



<!-- ---------------------------------------------------------------------------------------------------- -->

<!-- GREETINGS AND USER INFO -->

<div class="card bg-light col-md-10 offset-1 mt-3 pl-2">
	
	<nav class="navbar navbar-expand-sm navbar-default py-0 px-0 mt-0">
		<div class="nav navbar-nav ml-auto small" id="navbar1">
			
			<?php
				$userID=$_SESSION['userID'];
				$select="SELECT * FROM orderhistory WHERE user_id='$userID' ORDER BY orderID DESC LIMIT 1";
				$run=mysqli_query($conn,$select);
				if($run)
				{
					$row=mysqli_fetch_assoc($run);

					echo " 
						
						<li class='nav-item'><a href='email_invoice.php?oid=$row[orderID]' class='nav-link small'><i class='fas fa-file-alt'></i> &nbsp;Email Invoice</a></li>
						
					";			
					
				}
			?>
			
			<li class="nav-item"><a class="nav-link small"><i class="fas fa-envelope"></i> &nbsp;Contact Us</a></li>
			<li class="nav-item"><a class="nav-link small"><i class="fas fa-print"></i> &nbsp;Print</a></li>
		</div>
	</nav>

	<div class="card-body">

		<div class="row" id="box1">

			<div class="col-md-5 pb-2 " id="section1">
				<h4 class="text-info ">Thank you for your order!</h4>
				<p id="order_msg">
					Your order has been placed and is being processed. When the<br>item(s) are shipped, you will recieve an email with the details.<br>You can track this order through 
					<a href="my_orders.php" style="color: grey;" >My orders</a> page.
				</p>
				<div>
					<span class="font-weight-bold">&#8377; <?php echo $_SESSION['total'];?>/-</span>
					<span id="amount_mode_text">&nbsp;paid through&nbsp; <span class="text-capitalize font-italic font-weight-bold"><?php echo $_GET['paymentMode'];?></span></span>
				</div>
			</div>
			
			<!-- USER DETAILS -->

			<div class="col-md-6 ml-3" id="section2">
				<?php
					$select="SELECT * FROM shipping_details WHERE radio_id='$_GET[addressid]'";
					$run=mysqli_query($conn,$select);
					$datetime=date("Y-m-d h:i:s");
					$date=new DateTime($datetime);
					$ndate=$date->format('d F Y, l');
					$time=$date->format('h:i A');

					while($rows=mysqli_fetch_assoc($run))
					{
						echo " 
							<div><span id='name' class='text-capitalize'>$rows[name]</span>&nbsp; <span id='contact_no'>$rows[contact]</span></div>
							<div id='address' class='text-capitalize col-md-5 px-0 py-1'>
								$rows[houseno]  $rows[area] near $rows[landmark] , $rows[state]  
								$rows[town]-$rows[pincode]
							</div>
							<div id='order_del_date' class='col-md-10 py-1 mt-2'><i class='fas fa-calendar'></i> 
								$ndate - $time
							</div>
						";			
					}
				?>
				
			</div>
		
		</div>

	</div>

	<div class="card-footer text-center bg-light">
		<div id="box1_footer">
			You can now <a class="text-info"><i class="fas fa-undo-alt small text-info"></i> REORDER</a> ordered items from <button class="btn btn-info btn-sm ml-1 py-0 px-3" onclick="window.location='my_orders.php'">MY ORDERS</button>
		</div>
	</div>
</div>
<!-- CARD 1 ENDS -->

<!-- ---------------------------------------------------------------------------------------------------- -->

<!-- ORDER PROGRESS -->

<div class="row text-center justify-content-center mt-3 px-5" id="order_progress">
	
	<div id="order_placed" class="col-md-2">
		<div><i class="fas fa-box-open text-secondary" style="font-size: 60px;"></i>
			<i class="fas fa-check-circle lead rounded-circle"></i>
		</div>
		<div class="ml-n3 head">Order Placed</div>
	</div>
	
	<div class="fas fa-chevron-right col-md-1" style="font-size: 50px; color: rgb(200,200,200); "></div>
	
	<div id="processing" class="col-md-2">
		<div>
			<i class="fas fa-recycle text-secondary" style="font-size: 60px;"></i>
			<i class="fas fa-check-circle lead text-primary" style="display: none;"></i>
		</div>
		<div class="head">Processing</div>
	</div>

	<div class="fas fa-chevron-right col-md-1" style="font-size: 50px; color: rgb(200,200,200); "></div>
	
	<div id="transit" class="col-md-2">
		<div>
			<i class="fas fa-truck-pickup text-secondary" style="font-size: 60px;"></i>
			<i class="fas fa-check-circle lead text-success" style="display: none;"></i>
		</div>
		<div class="head">In-Transit</div>
	</div>
	
	<div class="fas fa-chevron-right col-md-1" style="font-size: 50px; color: rgb(200,200,200); "></div>
	
	<div id="delivery" class="col-md-2">
		<div>
			<i class="fas fa-people-carry text-secondary" style="font-size: 60px;"></i>
			<i class="fas fa-check-circle lead text-success" style="display: none;"></i>		
		</div>
		<div class="head">Delivery</div>
	</div>	
</div>

<!-- ---------------------------------------------------------------------------------------------------- -->
<!-- ORDER SUMMARY -->

<div class="card bg-light col-md-10 offset-1 mt-3 px-0">
	<!-- HEADING -->
	<div class="text-center py-3" id="order_summary">
		YOUR ORDER SUMMARY 
		<span style="font-size: 17px; color: darkgrey" class="px-1">
			<?php echo sizeof($_SESSION['cart']);?> Item
		</span>
	</div>

	<div style="background: #eee;">
		<div class="font-weight-bold px-2 py-1">
			<?php
				$userID=$_SESSION['userID'];
				$select="SELECT * FROM orderhistory WHERE user_id='$userID' ORDER BY orderID DESC LIMIT 1";
				$run=mysqli_query($conn,$select);
				if($run)
				{
					$row=mysqli_fetch_assoc($run);
					echo "ORDER ID : O-$row[orderID]";
				}
			?>
			
		</div>
	</div>

	<div class="list-group">

		<?php

			foreach ($_SESSION['cart'] as $pid=>$qty) 
			{
				$select="SELECT * FROM medicineinfo WHERE PID='$pid'";
				$run=mysqli_query($conn,$select);
				
				if($run)
				{
					$rows=mysqli_fetch_assoc($run);
					echo "
						<div class='list-group-item d-flex flex-row' onclick='item.php?pid=$pid'>
							<div class='col-md-2 p-0' ><img src=$rows[Imgsrc] class='col-md-8 p-0'></div>
							
							<div class='text-capitalize col-md-4 product_info'>
								<div>$rows[Name]</div>
								<div style='font-size: 13px; color: grey;'>Qty : $qty</div> 
							</div>

							<div class='ml-auto price'>
								<div>&#8377; $rows[Price]</div>
							</div>
						</div>
					";
				}

				unset($_SESSION['cart'][$pid]);
					
			}

		?>

	</div>

	<div class="card-footer bg-white">
		<div class="float-left lead text-info">Total Amount</div>
		<div class="float-right lead font-weight-bold text-info">&#8377; <?php echo $_SESSION['total']; ?></div>
	</div>

</div>

<!-- ---------------------------------------------------------------------------------------------------- -->

</body>
</html>









