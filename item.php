<?php session_start();
include 'connection.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>ITEM</title>
</head>
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
	<link rel="stylesheet" type="text/css" href="css/buy_medicines.css">
	<link rel="stylesheet" type="text/css" href="css/category_medicine.css">
	<link rel="stylesheet" type="text/css" href="css/item.css">
	
	<script>
		/*clicking on cart icon, redirecting to cart.php*/
		function redirect()
		{
			window.location='cart.php';
		}
	</script>
<body>

<!-- ----------------------------------------------------------------------------------------------------- -->

<!-- navbar1 -->
<nav class="navbar navbar-expand-sm" id="navbar1">
	<div class="container">

		<!-- brand name -->
		<div class="navbar-brand flex-column">
			<div id="brand" class="text-center"> <i class="fas fa-capsules text-muted small"></i> kyd<span id="brand_com" class="text-muted">.com</span></div>
			<div id="brand_subhead" class="mt-n1 text-muted text-center">Humari Pharmacy</div>
		</div>
		
		<!-- cart -->
		<div class=" text-dark p-1 ml-auto" style="border:none; cursor: pointer;" onclick="redirect();">
			<img src="images/cart.png" class="img-fluid">
		</div>
		<span id="cart-count" class="mt-n4 ml-n3 pr-1 pl-1 text-center" onclick=>
			<?php 
			if(sizeof($_SESSION['cart'])==0)
			{
				echo '';
			}
			else{
				echo count($_SESSION['cart']); 
			}
			?>
				
			</span>

		<!-- greeting -->
		<div id="greetings" class="text-muted ml-2 pl-1">Hi, <?php echo $_SESSION['user'];?>!</div>
	</div>
</nav>

<!-- ----------------------------------------------------------------------------------------------------- -->


<script>

	//FOR SEARCHING THE MEDICINE FROM DATABASE 
	function search_ajax(search_id,search_value)
	{	

		var xmlhttp=new XMLHttpRequest();

		if(search_value==="")
		{
			//if the value in input box is empty , then dont show the list
			document.getElementById('search_list').style.display = 'none';
			
			// document.getElementById('health_condition').style.display = '';
			// document.getElementById('categories').style.display = '';
			
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
					
					// document.getElementById('health_condition').style.display = 'none';
					// document.getElementById('categories').style.display = 'none';

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
	<div class="d-flex flex-row w-50 mx-auto">
		<!-- search bar  -->
		<div class="input-group">
			<input type="text" name="meds" placeholder="Search for medicines, health products and more " class='form-control' style="border-radius: 0; border:none;" id="search_med" 
			onkeyup="search_ajax(this.id,this.value)">
			
			<div class="input-group-addon">
				<button class="btn btn-secondary" style="border-radius: 0;"><i class="fa fa-search small pr-1"></i> Search </button>
			</div>
		</div>
	</div>

</nav>
	
	<!-- AJAX DATA FOR THE SEARCH -->
	<div class="mx-auto small text-dark" style=" position:absolute; z-index: 99; left: 26%; width: 40%; overflow-y: scroll; box-shadow: 0.5px 0.5px 2px #5bc0de; display: none; height: " 
	id="search_list">

		<!-- SEARCH VALUE COMES HERE -->

	</div>

<!-- ----------------------------------------------------------------------------------------------------- -->

<script>

//UPDATING THE QTY OF PRODUCT INSIDE THE INPUT BOX USING JS
function qty(btnid,boxid){

	//Box Input id 	
	inputBox = document.getElementById(boxid);
	var num= parseInt(inputBox.value);	
	
	//if clicking + then increase
	if(btnid == 'plus-'+boxid){
		num++;
	}

	else{
		num--;
	}

	//No of items in cart
	var x=parseInt(document.getElementById('cart-count').innerText);
	
	//IF VALUE < 1 THEN SHOW ADD BUTTON AND REMOVE CTR BOX AND UNSET THE ITEM
	if(num < 1){

		num=1;

		//ADD BUTTON
		 var addbtn = document.getElementById('addbtn-'+boxid);
		 addbtn.style.display = '';
		 
		 //HIDE CONTROL BOX
		 var ctrlBox = document.getElementById('ctrl-'+boxid);
		 ctrlBox.style.display = 'none';

		 //Update cart-count

		 if(x>1)
		 { $('#cart-count').text(x-1);	}

		 else
		 { $('#cart-count').text(''); }

	}

	inputBox.value = num;

}

//AJAX FUNCTION WHERE UPDATING QUANTITY IN THE ARRAY 'CART'
function qtyajax(btnid,pid)
{
	var num=parseInt(document.getElementById(pid).value);
	xmlhttp=new XMLHttpRequest();
	xmlhttp.open('GET','category_process.php?proid='+pid+'&proqty='+num+'&btnid='+btnid, true);
	xmlhttp.send();

}
 

//TOGGLE THE QUANTITY CONTROL BOX
function showCtrl(PID){

	var ctrlBox = document.getElementById('ctrl-'+PID);
	var inputBox = document.getElementById(PID);
	var addbtn = document.getElementById('addbtn-'+PID);
	ctrlBox.style.display = '';
	addbtn.style.display = 'none';

}

//THIS IS AJAX FUNCTION IN WHICH AFTER CLICKING ADD BUTTON THE PRODUCT ID AND QTY IS UPDATED IN 'CART' ARRAY
function add_to_cart_ajax(pid){

	var num=parseInt(document.getElementById(pid).value);

	xmlhttp=new XMLHttpRequest();
	
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById('cart-count').innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open('GET','category_process.php?pid='+pid+'&qty='+num, true);
	xmlhttp.send();

}

</script>

<!-- ----------------------------------------------------------------------------------------------------- -->

<div class="d-flex flex-row mt-2 mx-3 pagers">
	<?php
		if (isset($_GET['pid'])) 
		{
			$select="SELECT * FROM medicineinfo WHERE PID='$_GET[pid]'";
			$run=mysqli_query($conn,$select);	
			$row=mysqli_fetch_assoc($run);
			echo "
				<a href='buy_medicines.php'><div>Home</div></a>
				<i class='fas fa-angle-double-right mx-2 my-auto'></i>
				<a><div class='text-uppercase text-secondary'>$row[Category]</div></a>
				<i class='fas fa-angle-double-right mx-2 my-auto'></i>
				<a><div disabled='true'class='text-capitalize text-secondary'>$row[Name]</div></a>
			";
		}
	?>
	
</div>

<!-- ----------------------------------------------------------------------------------------------------- -->


<!-- product image section -->
<div class="d-flex flex-row ml-1">
	
	<div class="col-md-4 mt-3" id="product_section">

		<?php

		$id=$_GET['pid'];
		$select="SELECT * FROM medicineinfo WHERE PID='$id'";
		$run=mysqli_query($conn,$select);
		if(mysqli_num_rows($run))
		{
			$rows=mysqli_fetch_assoc($run);
			
			//IF CORRESPONDING TO ID THE VARIABLE IN ARRAY IS NOT SET THEN INITIALL QTY=1
			if(!isset($_SESSION['cart'][$rows['PID']]))
			{	
				$qty = 1;					
			}

			//IF IT IS ALREADY SET, THEN TAKE THAT QTY AND DISPLAY IN THE INPUT BOX
			else{
				$qty = $_SESSION['cart'][$rows['PID']];
			}

			echo "	

			<div class='card'>
		
				<img src=$rows[Imgsrc] class='card-img-top mx-auto' style='height:80%; width:80%'>

				<div class='card-body bg-light px-2'>
					
					<div class='price py-2 px-2'>&#8377; $rows[Price]</div>
					
					<div class='flex-column col-md-5 float-left pl-1'>
						<p class='small mb-0 px-1 text-secondary font-weight-bold' style='font-size:13px;'>Pack Size</p>

						<div class='mt-1 small px-1 text-capitalize font-weight-bold border border-secondary'>100 ml</div>
					</div>


					<div class='flex-column col-md-5 float-right pr-1'>
						<p class='small mb-0 px-1 text-secondary font-weight-bold' style='font-size:13px;'>Unit Count</p>
						
						<div class='mt-1 small px-1 text-capitalize font-weight-bold border border-secondary'>100 ml solution</div>
					</div>					
					
					
					<div class='clearfix'></div>

					<div id='ctrl-$rows[PID]' class='mt-4'>
						<button class='col-md-3 btn btn-sm text-info plus' id='minus-$rows[PID]' onclick='qty(this.id,$rows[PID]);' onmousedown='qtyajax(this.id,$rows[PID]);'><i class='fas fa-minus small'></i>
						</button>
						
						<input type='text' class='col-md-5 border-0 small text-center' disabled='true' 
						 value=$qty name='qty' id='$rows[PID]' style='background:none;'>
						
						<button class='col-md-3 btn btn-sm text-info' id='plus-$rows[PID]' onclick='qty(this.id,$rows[PID]);' onmousedown='qtyajax(this.id,$rows[PID]);'><i class='fas fa-plus small'></i>
						</button>
					</div>
					
					<div class='clearfix'></div>

					<button class='btn btn-info border border-info btn-sm btn-block add_to_cart mt-4' 
					id='addbtn-$rows[PID]' onclick='showCtrl($rows[PID])' 
					onmousedown='add_to_cart_ajax($rows[PID])' name='add'>ADD TO CART
					</button>

				</div>

			</div>

			";

			//IF THR VARIABLE (product id) IS NOT SET THEN JUST SHOW ADD BUTTON
			if(!isset($_SESSION['cart'][$rows['PID']]))
			{	
				echo
				"<script> 
					var a=document.getElementById('ctrl-'+$rows[PID]);
					a.style.display = 'none'; 

					var b=document.getElementById('addbtn-'+$rows[PID]);
					b.style.display='';
					
				</script>  ";
			}

			//if variable is already set then show the qty box with the qty inside
			else {
				echo
				"<script> 
					var a=document.getElementById('ctrl-'+$rows[PID]);
					a.style.display = ''; 
					var b=document.getElementById('addbtn-'+$rows[PID]);
					b.style.display='none';
					
				</script>  ";
			}
		}

		?>


	</div>
	<!-- ------------------------------------------------------------------------------------------ -->
	
	<!-- product description -->
	<div class="col-md-8 mt-3" id="description_section" >
		<div class='list-group list-group-flush col-md-11'>
			<?php
				$id=$_GET['pid'];
				$select="SELECT * FROM medicineinfo WHERE PID='$id'";
				$run=mysqli_query($conn,$select);
				if(mysqli_num_rows($run))
				{
					$row=mysqli_fetch_assoc($run);
					echo "
					<div class='list-group-item text-capitalize ' 
					style='font-family:serif;'>
						<h4>$row[Name]</h4>
						<div class='text-secondary small py-2'>Manufactured By <span class='text-dark'>Usv Ltd.</span> </div>
					</div>
					";
				}
			?>
			<div class='list-group-item small'>
				<div class="desc-head">Highlights</div>
				<ul class="small pl-5 pt-2">
					<li> 
						It is used for improving the skin tone and texture. It reduces occurrence of blackheads.
					</li>

					<li>
						It maintains moisture in the skin and keeps it well hydrated to make your skin soft and clean.
					</li>
				</ul>
			</div>
			<div class='list-group-item small'>
				<div class="desc-head">Description</div>
				<p class="small py-2">
					Dermadew Lite Soap is used to improve the skin tone and texture. It contains vegetable oils with skin lightening agents, moisturizers, emollients, etc. Use this soap with other skin lightening medications for better outcome.
				</p>
			</div>
			<div class='list-group-item small'>
				<div class="desc-head">How to use</div>
				<p class="small py-2">
					It can be used twice daily. Apply a small amount of soap to the wet skin. Rub gently to produce enough lather and rinse it off with water.
				</p>
				
				<div class="desc-head">Benefits</div>
				<ul class="pl-5 small pt-2">
					<li>Healthy skin growth</li>
					<li>Keeps skin hydrated</li>
					<li>Maintains skin moisture</li>
					<li>Improves skin tone</li>
					<li>Prevents occurrence of dark spots</li>
				</ul>
			</div>
		</div>
	</div>

</div>

<!-- ----------------------------------------------------------------------------------------------------- -->

</body>
</html>