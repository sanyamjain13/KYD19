
<!-- SKIN CARE -->

<?php
include 'connection.php';
session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title>HEALTH CONDITIONS</title>

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


	<script>
		// toggling the chevron arrow

		$(document).ready(function(){
			$('.list-group-item a').click(function(){
				if($('.list-group-item i').hasClass('fa fa-chevron-right')){
					$('.list-group-item i').removeClass('fa fa-chevron-right').addClass('fa fa-chevron-down');
				}
				else
				{ $('.list-group-item i').removeClass('fa fa-chevron-down').addClass('fa fa-chevron-right'); }
			});

			// $('.add_to_cart').click(function(){
			// 	var i= parseInt($('#cart-count').text()) ;
			// 	if(isNaN(i)) { i=0; }
			// 	$('#cart-count').text(i+1);
			// });

		});

		/*clicking on cart icon, redirecting to cart.php*/
		function redirect()
		{
			window.location='cart.php';
		}

	</script>

</head>

<style>

	/* THIS LIST IS THE LIST IN THE SIDEBAR */
	.list-group-item a{
		color: black;
	}

	.list-group-item a:hover{
		color: gray;
		text-decoration: none;
	}

	/* CARD OF ITEMS OF THAT CATEGORY ON THE PAGE */

	.card{
		border: none;
		transition: box-shadow 0.5s, transform 0.5s;
	}

	.card:hover{
		box-shadow: 0 0 9px silver;
	}
</style>
<body>

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
		<span id="cart-count" class="mt-n4 ml-n3 pr-1 pl-1 text-center">
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

<!-- ---------------------------------------------------------------------- -->

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
	<div class="mx-auto small text-dark" style=" position:absolute; z-index: 99; left: 26%; width: 40%; overflow-y: scroll; box-shadow: 0.5px 0.5px 2px #5bc0de; display: none;"
	id="search_list">

		<!-- SEARCH VALUE COMES HERE -->

	</div>
<!-- ---------------------------------------------------------------------- -->

<!-- SIDEBAR OF BUY MEDICINE -->
<section id="sidebar_buy_med">

	<div class="list-group list-group-flush offset-1 pt-2">

		<div class="list-group-item" style="font-size: 19px; font-weight: bold; letter-spacing: 0.5px;">
			CATEGORIES</div>

		<!-- categories starts from here -->

		<!-- FAMILY CARE -->
		<div class="list-group-item sidebar_head dropdown">
			<i class="fa fa-chevron-right text-secondary small"></i>
			<a href="#family-care" data-toggle='collapse'>Family care</a>
				<div class="panel panel-default panel-collapse collapse pt-2 fade" id="family-care">
					<ul class="panel-body" style="list-style: none;">
						<li><a href="#">Senior care</a></li>
						<li class="pt-2"><a href="#women-care" data-toggle='collapse'>Women's care <i class="fas fa-sort-down"></i></a>
						</li>
							<!-- sub class inside ul of womens care -->
							<!-- WOMENS CARE -->
							<div class="panel panel-default panel-collapse fade collapse pt-2" id="women-care">
								<ul class="panel-body" style="list-style: none;">
									<li><a href="#">Feminine Hygiene </a></li>
									<li class="pt-2"><a href='#'>Mother care</a></li>
								</ul>
							</div>
					</ul>
				</div>
		</div>

		<!-- FITNESS AND WELLNESS -->
		<div class="list-group-item sidebar_head">
			<i class="fa fa-chevron-right text-secondary small"></i>
			<a href="#fitness" data-toggle='collapse'>Fitness & Wellness</a>
				<div class="panel panel-default panel-collapse collapse pt-2 fade" id="fitness">
					<ul class="panel-body" style="list-style: none;">
						<li><a href="#">Protein Supplements</a></li>
						<li class="pt-2"><a href="#">Mass Gainers</a></li>
					</ul>
				</div>
		</div>

		<!-- SKIN CARE -->
		<div class="list-group-item sidebar_head">
			<i class="fa fa-chevron-right text-secondary small"></i>
			<a href="#skin-care" data-toggle='collapse'>Skin care</a>
				<div class="panel panel-default panel-collapse collapse pt-2 fade" id="skin-care">
					<ul class="panel-body" style="list-style: none;">
						<li><a href="#">Acne Care</a></li>
						<li class="pt-2"><a href="#">Body & Bath</a></li>
						<li class="pt-2"><a href="#">Face wash & cleansers</a></li>
						<li class="pt-2"><a href="#">Skin care suppliments</a></li>
					</ul>
				</div>
		</div>


		<!-- HAIR CARE -->
		<div class="list-group-item sidebar_head"><i class="fa fa-chevron-right text-secondary small"></i>
			<a href="#hair-care" data-toggle='collapse'>Hair care</a>
				<div class="panel panel-default panel-collapse collapse pt-2 fade" id="hair-care">
					<ul class="panel-body" style="list-style: none;">
						<li><a href="#">Antidandruff</a></li>
						<li class="pt-2"><a href="#">Antihairloss</a></li>
					</ul>
				</div>
		</div>

		<!-- LIP CARE -->
		<div class="list-group-item sidebar_head"><i class="fa fa-chevron-right text-secondary small"></i>
			<a href="#lip-care" data-toggle='collapse'>Lip care</a>
				<div class="panel panel-default panel-collapse collapse pt-2 fade" id="lip-care">
					<ul class="panel-body" style="list-style: none;">
						<li><a href="#">Lip balms</a></li>
					</ul>
				</div>
		</div>

		<!-- SEXUAL WELLNESS -->
		<div class="list-group-item sidebar_head"><i class="fa fa-chevron-right text-secondary small"></i>
			<a href='#sexual-wellness' data-toggle='collapse'>Sexual wellness</a>
				<div class="panel panel-default panel-collapse collapse pt-2 fade" id="sexual-wellness">
					<ul class="panel-body" style="list-style: none;">
						<li><a href="#">Condoms</a></li>
					</ul>
				</div>
		</div>

		<!-- WOMEN'S CARE -->
		<div class="list-group-item sidebar_head"><i class="fa fa-chevron-right text-secondary small"></i>
			 <a href="#women-care-2" data-toggle='collapse'>Women's care</a>
				<div class="panel panel-default panel-collapse collapse pt-2 fade" id="women-care-2">
					<ul class="panel-body" style="list-style: none;">
						<li><a href="#">Feminine Hygiene</a></li>
						<li class="pt-2"><a href="#">Mother care</a></li>
					</ul>
				</div>
		</div>

		<!-- BABY CARE -->
		<div class="list-group-item sidebar_head"><i class="fa fa-chevron-right text-secondary small"></i>
			<a href="#baby-care" data-toggle='collapse'>Baby care</a>
				<div class="panel panel-default panel-collapse collapse pt-2 fade" id="baby-care">
					<ul class="panel-body" style="list-style: none;">
						<li><a href="#">Baby bath</a></li>
						<li class="pt-2"><a href="#">Diapers & wipes</a></li>
					</ul>
				</div>
		</div>

	<!-- LIST GROUP ENDS -->
	</div>
</section>
<!-- ----------------------------------------------------------------------------------------- -->

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

	//IF VALUE < 1 THEN SHOW ADD BUTTON AND REMOVE CTR BOX
	if(num < 1){

		num=1;

		//ADD BUTTON
		 var addbtn = document.getElementById('addbtn-'+boxid);
		 addbtn.style.display = '';

		 //HIDE CONTROL BOX
		 var ctrlBox = document.getElementById('ctrl-'+boxid);
		 ctrlBox.style.display = 'none';

		 //Update cart-count
		 var i= parseInt($('#cart-count').text()) ;
		 if(isNaN(i)) { i=0; }
		 $('#cart-count').text(i-1);
		 if(i == 1){$('#cart-count').text('');}

	}

	inputBox.value = num;

}

//AJAX FUNCTION WHERE UPDATING QUANTITY IN THE ARRAY 'CART'
function qtyajax(btnid,pid)
{
	var num=parseInt(document.getElementById(pid).value);
	xmlhttp=new XMLHttpRequest()
	xmlhttp.open('GET','category_process.php?pid='+pid+'&qty='+num+'&btnid='+btnid, true);
	xmlhttp.send();

}


//TOGGLE THE QUANTITY CONTROL BOX
function showCtrl(PID){

	var ctrlBox = document.getElementById('ctrl-'+PID);
	var inputBox = document.getElementById(PID);
	var addbtn = document.getElementById('addbtn-'+PID);
	//inputBox.value = 1;
	ctrlBox.style.display = '';
	addbtn.style.display = 'none';

}

//THIS IS AJAX FUNCTION IN WHICH AFTER CLICKING ADD BUTTON THE PRODUCT ID AND QTY IS UPDATED IN 'CART' ARRAY
function add_to_cart_ajax(pid){

	var num=parseInt(document.getElementById(pid).value);

	xmlhttp=new XMLHttpRequest();

	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById('cart-count').innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open('GET','category_process.php?pid='+pid+'&qty='+num, true);
	xmlhttp.send();

}

</script>

<div class="main_content">

	<!-- PAGINATION (on which page we are coming from and which page is active) -->
	<div class="d-flex flex-row mx-4 my-2 page_links">
		<a href="buy_medicines.php"><div>Buy Medicines</div></a>
		<i class="fas fa-angle-double-right mx-2 my-auto"></i>
		<a href="health_conditions.php"><div>Health Condition</div></a>

	</div>

	<!-- CONTENT STARTS HERE -->
	<div class="container-fluid">

		<div class="d-flex flex-row flex-wrap justify-content-between"  >
			<?php

				$select="SELECT * FROM medicineinfo WHERE Category='healthcondition'";
				$run=mysqli_query($conn,$select);
				while($rows=mysqli_fetch_assoc($run))

				{
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
						<div class='card col-md-3 mt-3 p-1'>
							<img src=$rows[Imgsrc] class='card-img-top'>
							<div class='card-body  p-0 my-2'
							onclick=window.location='item.php?pid=$rows[PID]'>
								<div class='card-title text-capitalize pl-1'>$rows[Name]</div>
								<div class='card-price pl-1'>&#8377; $rows[Price]</div>
							</div>

							<div class='flex-row mx-1 my-1 pl-2 small' id='ctrl-$rows[PID]'>

								<button class='col-md-3 btn btn-sm text-info plus' id='minus-$rows[PID]' onclick='qty(this.id,$rows[PID]);' onmousedown='qtyajax(this.id,$rows[PID]);'><i class='fas fa-minus small'></i></button>

								<input type='text' class='col-md-5 border-0 small text-center' disabled='true'  value=$qty  name='qty' id='$rows[PID]' style='background:none;'>

								<button class='col-md-3 btn btn-sm text-info' id='plus-$rows[PID]' onclick='qty(this.id,$rows[PID]);' onmousedown='qtyajax(this.id,$rows[PID]);'><i class='fas fa-plus small'></i></button>
							</div>
							<button class='btn btn-info border border-info btn-sm btn-block mb-2 add_to_cart' id='addbtn-$rows[PID]' onclick='showCtrl($rows[PID])'
								onmousedown='add_to_cart_ajax($rows[PID])' name='add'>ADD</button>
						</div>
					";

					//AFTER COMING BACK TO THIS PAGE :

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

	</div>
</div>
</body>
</html>
