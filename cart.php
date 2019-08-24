<?php
session_start();
include 'connection.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>CART</title>
	
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
	<link rel="stylesheet" type="text/css" href="css/buy_medicines.css">
	<link rel="stylesheet" type="text/css" href="css/category_medicine.css">
	<link rel="stylesheet" type="text/css" href="css/cart.css">

	<script>
		
		function remove_item(pid)
		{

			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function()
			{
				if(xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					document.getElementById('get').innerHTML=xmlhttp.responseText;
				}
			}
		xmlhttp.open('GET','category_process.php?remove_id='+pid, true);
		xmlhttp.send();

		}

	</script>
	
</head>
<style>

</style>

<body class="bg-light">
<!-- ------------------------------------------------------------------------------------- -->

<!-- navbar1 -->
<nav class="navbar navbar-expand-sm" id="navbar1">
	<div class="container">

		<!-- brand name -->
		<div class="navbar-brand flex-column">
			<div id="brand" class="text-center"> <i class="fas fa-capsules text-muted small"></i> kyd<span id="brand_com" class="text-muted">.com</span></div>
			<div id="brand_subhead" class="mt-n1 text-muted text-center">Humari Pharmacy</div>
		</div>
		
			
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
<!-- ------------------------------------------------------------------------------------- -->

<!-- MAIN CONTENT list of items -->
<div class="container-fluid ">
	
	<!-- BACK TO BUY MEDICINES -->
	<div class="col-md-2 mt-1" id="previous_page_link"><a href="buy_medicines.php">
		<i class="fas fa-angle-double-left"></i> &nbsp;Back to previous page</a>
		<div id="get">
			<!-- AJAX DATA FROM REMOVE ITEM FUNCTION COMING -->
		</div>
	</div>

	<script>

		//TO INCREASE OR DECREASE THE VALUE OF INPUT BOXOF QUANTITY
		function qty(btnid,boxid)
		{
			
			var num=parseInt(document.getElementById(boxid).value);
			
			if(btnid=='plus-'+boxid)
			{ num++; }
			else { num--; }

			//IF QTY REACHES 0 THEN REMOVE THE ITEM FROM CART VARIABLE
			if(num<1) {
				num=1;
				remove_item(boxid);
			};

			document.getElementById(boxid).value=num;
		}


		//UPDATING THE QUANTITY INSIDE THE CART ARRAY USING AJAX
		function qtyajax(btnid,pid,price)
		{	

			var num=parseInt(document.getElementById(pid).value);
			xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function()
			{
				if(xmlhttp.readyState==4 && xmlhttp.status==200)
				{	
					//UPDATING THE PRICE OF THAT ITEM ACCORDING TO QTY AFTER CLICKING
					document.getElementById('price-'+pid).innerHTML=xmlhttp.responseText;

				}
			}
			xmlhttp.open('GET','category_process.php?proid='+pid+'&proqty='+num+'&btnid='+btnid+'&price='+price, true);
			xmlhttp.send();
		}

		//CALCULATING THE TOTAL AMOUNT OF MONEY WHEN IF USER INCREASES OR DECRESE THE QTY
		function total(btnid,pid,price)
		{
			xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function()
			{
				if(xmlhttp.readyState==4 && xmlhttp.status==200)
				{	
					document.getElementById('total_cost').innerHTML=xmlhttp.responseText;
				}
			}
			xmlhttp.open('GET','category_process.php?total=yes&productID='+pid+'&qtybtn='+btnid+'&cost='+price, true);
			xmlhttp.send();
		}


	</script>
	
	<!-- ITEMS IN THE CART --> 
	<div class="list-group  my-4 col-md-5 mx-auto" id='cart_list'>		
		<?php
		$arr=$_SESSION['cart'];
		$max=sizeof($arr);
		$_SESSION['total']=0;
		for($i=0; $i<$max ;$i++)
		{	
			//var_dump($arr);
			while(list($pid,$qty)=each($arr))
			{	
				$select="SELECT * FROM medicineinfo WHERE PID='$pid'";
				$run=mysqli_query($conn,$select);
				$row=mysqli_fetch_assoc($run);
				if($row)
				{	
					$price=$row['Price']*$qty;
					$_SESSION['total']+=$price;
					echo "
					<div class='list-group-item'>
		
						<div class='row'>
							<div class='title py-1 col-md-8 text-capitalize'>
								$row[Name]
							</div>

							<div class='title_price text-info ml-5' id='price-$row[PID]'>
								&#8377; $price
							</div>
						</div>
						


						<!-- REMOVE BUTTON AND QUANTITY BOX -->
						<div class='row mt-2'>
							<button class='col-md-2 btn btn-info ml-4 py-1 px-2 my-2 remove_btn' onclick='remove_item($row[PID]);'>Remove</button> 
							
							<div class='col-md-4 ml-auto mt-1 p-0'>

								<button class='col-md-3 btn btn-sm text-info plus border border-info py-0' id='minus-$row[PID]' onclick='qty(this.id,$row[PID]); 
									total(this.id,$row[PID],$row[Price]);' 
									onmousedown='qtyajax(this.id,$row[PID],$row[Price]); '><i class='fas fa-minus small'></i>
								</button>
											
								<input type='text' class='col-md-5 border-0 small text-center border' 
								value=$qty placeholder='Quantity' disabled='true' style='background:none;' name='qty' id='$row[PID]'>
								
								<button class='col-md-3 btn btn-sm text-info border border-info py-0' 
								id='plus-$row[PID]' onclick='qty(this.id,$row[PID]); 
								total(this.id,$row[PID],$row[Price]); ' 
								onmousedown='qtyajax(this.id,$row[PID],$row[Price]); '><i class='fas fa-plus small'></i></button>
							</div>
						</div>
					</div>
					";	
				}

					
			}
		}

		?>
		
		
		<!-- ITEMS IN THE CARD ENDS -->
		
		<!-- TOTAL AMOUNT AND ITEMS , CHECKUT BUTTON  -->
		<footer class="list-group-item" >

			<div class="col-md-5 my-2 text-secondary pl-1" style="font-size: 18px;" id="cart_items_total" >
				 <!-- COUNT OF ITEMS -->                                 <!-- TOTAL OF ITEMS -->
				<span><?php echo sizeof($_SESSION['cart']) ?> Item</span> | <span id="total_cost">
					<?php echo "&#8377; ".$_SESSION['total']; ?></span>

			</div>

			
			<button class="btn btn-info btn-block btn-sm" id='checkout' onclick="window.location='delivery_option.php';">CHECKOUT
			</button><br>
			<?php

				//is cart is empty , then no checkout button display will be there
				if(sizeof($_SESSION['cart'])==0)
				{
					echo "
						
						<script>
							document.getElementById('checkout').style.display='none';
							document.getElementById('cart_items_total').innerHTML='NO ITEMS IN CART &nbsp; :(';
						</script>

					";	
				}

				//if cart has items then checkout button will be there
				else{

					echo "
						
						<script>
							document.getElementById('checkout').style.display='';
						</script>

					";

				}
			?>
			

		</footer>

	</div>
	

</div>

</body>
</html>