<?php session_start();
include 'connection.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>ORDER HISTORY</title>
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
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
	<script src="../../jquery/js/jquery.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/my_orders.css">
	<link rel="stylesheet" type="text/css" href="css/buy_medicines.css">
</head>
<script>
	function redirect(){
		window.location='cart.php';
	}
</script>
<body>

<div>
	
<!-- navbar1 -->
<nav class="navbar navbar-expand-sm" id="navbar1">
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

<!-- ------------------------------------------------------------------------------------------ -->
<script>

//FOR SEARCHING THE MEDICINE FROM DATABASE 
function search_ajax(search_id,search_value)
{	

	var xmlhttp=new XMLHttpRequest();

	if(search_value==="")
	{
		//if the value in input box is empty , then dont show the list
		document.getElementById('search_list').style.display = 'none';
		
	
		document.getElementById('health_condition').style.opacity = '';
		document.getElementById('categories').style.opacity = '';

	}
	
	else
	{	
		document.getElementById('search_list').style.display = '';
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById('search_list').innerHTML=xmlhttp.responseText;

				document.getElementById('health_condition').style.opacity = '0.2';
				document.getElementById('categories').style.opacity = '0.2';


			}
		}

		xmlhttp.open('GET','category_process.php?search_id='+search_id+'&title='+search_value,true);
		xmlhttp.send();
		}
}
</script>

<!-- navbar2 -->

<nav class="navbar navbar-expand-sm bg-info" id="navbar2">
	<div class="w-100 ">
		<!-- search bar  -->
		<div class="input-group justify-content-center">
			<input type="text" name="meds" placeholder="Search for medicines, health products and more " class='form-control-sm' style="border-radius: 0; border:none;" id="search_med" 
			onkeyup="search_ajax(this.id,this.value)">
			
			<div class="input-group-addon">
				<button class="btn btn-secondary btn-sm" style="border-radius: 0;"><i class="fa fa-search small pr-1"></i> Search </button>
			</div>
		</div>
	</div>

</nav>
	
<!-- AJAX DATA FOR THE SEARCH -->
<div class="mx-auto small text-dark" style=" position:absolute; z-index: 99; left: 26%; width: 40%; overflow-y: scroll; box-shadow: 0.5px 0.5px 2px #5bc0de; display: none; height: " 
id="search_list">

	<!-- SEARCH VALUE COMES HERE -->

</div>
<div class='d-flex flex-row flex-wrap justify-content-center bg-light container-fluid'>	

	<?php
		$userid=$_SESSION['userID'];
		$select="SELECT * FROM orderhistory WHERE user_id='$userid'";
		$run=mysqli_query($conn,$select);
		while($rows=mysqli_fetch_assoc($run))
		{	
			$arr_pid=explode(',', $rows['PID']);
			$arr_qty=explode(',', $rows['quantity']);
			$arr_datetime=explode(' ', $rows['date_time']);

			$time = new DateTime($rows['date_time']);
			$ndate = $time->format('d F Y, D');
			$ntime = $time->format('H:i  A');
			
			$status='Order Placed';
			if ($rows['status']==2) 
			{ $status= 'Processing';}
			if ($rows['status']==3) 
			{ $status= 'In Transit';}
			if($rows['status']==4)
			{ $status= 'Delivered';}


			echo "
			<div class='list-group mt-3 px-0 col-md-9 offset-1' id='order'>

				<div class='flex-row px-1 d-flex py-2 bg-light flex-wrap' id='order_detail'>
					<div class='col-md-6 text-secondary small'>
						ORDER NO : <span class='text-dark font-weight-bold'>O - $rows[orderID]</span>
					</div>
					<div class='col-md-6 text-right small text-secondary'>
						<i class='fas fa-check-circle text-success'></i> $status
					</div>

					<div class='col-md-8 small text-secondary pt-3'>
						$ndate  - $ntime
					</div>

					<div class='col-md-4 text-right font-weight-bold pt-3'>&#8377; $rows[total]/-</div>
				</div>
				
				
				 ";
				
				for($i=0; $i<sizeof($arr_pid);$i++) 
				{
					$sel="SELECT * FROM medicineinfo WHERE PID = '$arr_pid[$i]'";
					$r=mysqli_query($conn,$sel);
					$row=mysqli_fetch_assoc($r);
					echo " 
						<div class='flex-row px-1 d-flex list-group-item mx-0 items'>
							<div class='col-md-10 text-capitalize'>$row[Name]</div>
							<div class='col-md-2 text-center'>$arr_qty[$i]</div>
						</div>
					";	
				}
				

				echo "
				<div class='flex-row px-1 d-flex list-group-item bg-light order_links '>
					<div class='col-md-6 text-info  text-center'><a href='order_info.php?id=$rows[orderID]&addid=$rows[add_id]' class='text-info'>
						<i class='fas fa-plus-circle small'></i> View More</a> 
					</div>
					<div class='col-md-6 text-info text-center'>
						<a href='?link=$rows[orderID]' class='text-info');>
						<i class='fas fa-redo-alt small'></i> 
							Reorder
						</a>
					</div>
				</div>
				
			</div>
			";

			if(isset($_GET['link']))
			{
				if($_GET['link']==$rows['orderID'])
				{	
					$_SESSION['cart']=array();
					for ($i=0; $i<sizeof($arr_pid); $i++)
					{
						$pid=$arr_pid[$i];
						$qty=$arr_qty[$i];

						$_SESSION['cart'][$pid]=$qty;

					}
				}
			?>
			<script>
				window.location='cart.php';
			</script>
			<?php
			}

		}
	?>
</div>

</body>
</html>