<?php session_start();
include 'connection.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Order Info</title>

	<!-- Bootstrap.css version 4.3.1 CDN -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	<!--Fontawesome CDN-->
	<script src="https://kit.fontawesome.com/e79df9883a.js"></script>
	
	<!-- jquery cdn -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- <script src="../../jquery/js/jquery.js"></script> -->
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/receipt.css">

</head>


<body style="background-color: #f1f1f1;">

<!-- ---------------------------------------------------------------------------------------------------- -->

<!-- GREETINGS AND USER INFO -->

<div class="card bg-light col-md-10 offset-1 mt-3 pl-2">
	
	<nav class="navbar navbar-expand-sm navbar-default py-0 px-0 mt-0">
		<div class="nav navbar-nav ml-auto small" id="navbar1">
			
			<?php 

				$orderid=$_GET['id'];

				echo"
					<li class='nav-item'><a href='email_invoice.php?oid=$orderid' class='nav-link small'>
					<i class='fas fa-file-alt'></i> &nbsp;Email Invoice</a></li>
				";
			?>
			
			<li class="nav-item"><a class="nav-link small"><i class="fas fa-envelope"></i> &nbsp;Contact Us</a></li>
			<li class="nav-item"><a class="nav-link small"><i class="fas fa-print"></i> &nbsp;Print</a></li>
		</div>
	</nav>

	<div class="card-body">

		<div class="row" id="box1">

			<div class="col-md-5" id="section1">
				<h4 class="text-info ">Thank you for your order!</h4>
				
				<p id="order_msg">
					Your order is being processed. When the<br>item(s) are shipped, you will recieve an email with the details.<br>You can track this order through 
					<a href="my_orders.php" style="color: grey;" >My orders</a> page.
				</p>
				<div>
					<?php

						$orderid=$_GET['id'];
						$select="SELECT * FROM orderhistory WHERE orderID='$orderid'";
						$run=mysqli_query($conn,$select);
						$row=mysqli_fetch_assoc($run);

						echo "
							<span class='font-weight-bold'>&#8377; $row[total]/- </span>
							<span id='amount_mode_text' class='text-capitalize'>&nbsp;paid through&nbsp;
							<b class='font-italic'>$row[payment_mode]</b></span>
				</div>
			</div>
			
			<div class='col-md-6 ml-3' id='section2'> ";
		
					$select_add="SELECT * FROM shipping_details WHERE radio_id='$row[add_id]'";
					$run_add=mysqli_query($conn,$select_add);
					$row_add=mysqli_fetch_assoc($run_add);

					$time = new DateTime($row['date_time']);
					$ndate = $time->format('d F Y, l');
					
					echo " 
						<div><span id='name' class='text-capitalize'>$row_add[name]</span>&nbsp; <span id='contact_no'>$row_add[contact]</span></div>
						<div id='address' class='text-capitalize col-md-5 px-0 py-1'>
							$row_add[houseno]  $row_add[area] near $row_add[landmark] , $row_add[state]  
							$row_add[town]-$row_add[pincode]
						</div>
						<div id='order_del_date' class='col-md-8 py-1 mt-2'><i class='far fa-calendar-check'></i> &nbsp;$ndate
						</div>			
					
				
			</div>
			";
			?>
		
		</div>

	</div>

	<div class="card-footer text-center bg-light">
		<div id="box1_footer">
			You can now <a class="text-info"><i class="fas fa-undo-alt small text-info"></i> REORDER</a> ordered items from <button class="btn btn-info btn-sm ml-1 py-0 px-3" onclick="window.location='my_orders.php';">MY ORDERS</button>
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
<script>
	
	function goToItem(pid)
	{	
		window.location='item.php?pid='+pid;
	}

</script>

<div class="card bg-light col-md-10 offset-1 mt-3 px-0">
	<!-- HEADING -->
	
	<?php

		$orderid=$_GET['id'];
		$select="SELECT * FROM orderhistory WHERE orderID='$orderid'";
		$run=mysqli_query($conn,$select);
		

			echo "
			<div class='text-center py-3' id='order_summary'>
				YOUR ORDER SUMMARY";

			
			if(mysqli_num_rows($run))
			{
				$row=mysqli_fetch_assoc($run);
				$arr_pid=explode(',', $row['PID']);
				$arr_qty=explode(',', $row['quantity']);

				$total_items=sizeof($arr_pid);

				echo "
					<span style='font-size: 17px; color: darkgrey' class='px-1'>
						$total_items Item
					</span>

				</div>

				<div style='background: #eee; font-family: sans-serif;'>
					<div class='font-weight-bold px-2 py-2'>
						ORDER ID : O-$_GET[id]
					</div>
				</div>
				
				";

				for($i=0; $i<sizeof($arr_pid);$i++) 
				{
					$sel_product="SELECT * FROM medicineinfo WHERE PID = '$arr_pid[$i]'";
					$product_run=mysqli_query($conn,$sel_product);
					$product_row=mysqli_fetch_assoc($product_run);
					echo "
						<div class='list-group' onclick='goToItem($arr_pid[$i]);' style='cursor:pointer;'>
							<div class='list-group-item d-flex flex-row'>
								<div class='col-md-2 p-0' ><img src=$product_row[Imgsrc] class='col-md-8 p-0'></div>
								
								<div class='text-capitalize col-md-4 product_info'>
									<div>$product_row[Name]</div>
									<div style='font-size: 13px; color: grey;'>Qty : $arr_qty[$i]</div> 
								</div>

								<div class='ml-auto price'>
									<div>&#8377; $product_row[Price]</div>
								</div>
							</div>
						</div>
					";
				}

				echo " 
				<div class='card-footer bg-white'>
					<div class='float-left lead text-info'>Total Amount</div>
					<div class='float-right lead font-weight-bold text-info'>&#8377; $row[total]</div>
				</div>
				";
			}

		?>

	

</div>

<!-- ---------------------------------------------------------------------------------------------------- -->

</body>
</html>









