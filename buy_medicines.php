<?php
session_start();
include 'connection.php';
//$_SESSION['cart']=array();

if(isset($_SESSION['cart']))
{ }
else
{  $_SESSION['cart']=array(); }

?>

<!DOCTYPE html>
<html>
<head>
	<title>BUY MEDICINES</title>

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
	
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/buy_medicines.css">

</head>

<script>
	$(document).ready(function(){

		$("#nextclick1").click(function(){
			$('#nextclick1').hide();
		});

		$('#prevclick1').click(function(){
			$('#nextclick1').show();
		});

		$("#nextclick2").click(function(){
			$('#nextclick2').hide();
		});

		$('#prevclick2').click(function(){
			$('#nextclick2').show();
		});
	});

	function redirect(){
		window.location='cart.php';
	}
</script>

<style>

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
		<div id="greetings" class="text-muted ml-2 pl-1">Hi,<?php echo $_SESSION['user'];?>!</div>
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
<!-- ---------------------------------------------------------------------- -->

<!-- CAROUSEL FOR THE HEALTH CONDITIONS -->
<div class="carousel slide" data-ride='false' id="health_condition" data-pause='hover' data-interval='false'>
	<div
	class="col-md-2 ml-4 mt-2 text-secondary text-gray-dark"style="font-size: 19px; text-shadow: 0 0 0.5px grey;">Health Condition</div>

	<div class="carousel-inner" style="height: 205px;">

		<!-- 1st item begins -->
		<div class="carousel-item active" id="item1.1">

			<div class="card-deck mt-2 mx-4 mb-3">

			  <div class="card">
			  	<img src="images/skincare.jpg" class="card-img-top">
			    <div class="card-img-overlay">
			      <div class="flex-column mt-4">
			      	<a href="skin_care.php" class="card-link stretched-link">
				      	<div class="carousel_head text-info">SKIN</div>
				      	<div class="carousel_sub_head ml-1 text-info">CARE</div>
			      	</a>
			      </div>
			    </div>
			  </div>

			  <div class="card">
			  	<img src="images/weghtloss.jpg" class="card-img-top h-100">
			    <div class="card-img-overlay">
			      <div class="flex-column mt-4">
			      	<a href="weight_management.php" class="card-link stretched-link">
				      	<div class="carousel_head text-info">WEIGHT</div>
				      	<div class="carousel_sub_head ml-1 text-info">MANAGEMENT</div>
				     </a>
			      </div>
			    </div>
			  </div>

			  <div class="card">
			  	<img src="images/pain.png" class="card-img-top ">
			    <div class="card-img-overlay">
			      <div class="flex-column mt-4">
							<a href="pain_relief.php" class="card-link stretched-link">
								<div class="carousel_head text-info">PAIN</div>
				      	<div class="carousel_sub_head ml-1 text-info">RELIEF</div>
							</a>

			      </div>
			    </div>
			  </div>

			  <div class="card">
			  	<img src="images/hearthealth.jpg" class="card-img-top h-100">
			    <div class="card-img-overlay">
			      <div class="flex-column mt-4">
								<a href="heart_health.php" class="card-link stretched-link">
			      	<div class="carousel_head text-info">HEART</div>
			      	<div class="carousel_sub_head ml-1 text-info">HEALTH</div>
						</a>
			      </div>
			    </div>
			  </div>

			</div>
			<!-- 1st card deck ends -->
		</div>

		<!-- 1st item ends , 2nd begins -->
		<div class="carousel-item" id="item1.2">

			<div class="card-deck mt-3 mb-4 mx-auto col-md-10">

			  <div class="card">
			  	<img src="images/coughcold.jpg" class="card-img-top">
			    <div class="card-img-overlay">
			      <div class="flex-column mt-4">
								<a href="cough_cold.php" class="card-link stretched-link">
			      	<div class="carousel_head text-info">COUGH</div>
			      	<div class="carousel_sub_head ml-1 text-info">&  COLD</div>
						</a>
			      </div>
			    </div>
			  </div>

			  <div class="card">
			  	<img src="images/diabities.jpg" class="card-img-top">
			    <div class="card-img-overlay">
			      <div class="flex-column mt-4">
								<a href="diabetes_care.php" class="card-link stretched-link">
			      	<div class="carousel_head text-info">DIABETES</div>
			      	<div class="carousel_sub_head ml-1 text-info">CARE</div>
						</a>
			      </div>
			    </div>
			  </div>

			  <div class="card">
			  	<img src="images/sexualwell.jpg" class="card-img-top h-100">
			    <div class="card-img-overlay">
			      <div class="flex-column mt-4">
								<a href="sexual_wellness.php" class="card-link stretched-link">
			      	<div class="carousel_head text-info">SEXUAL</div>
			      	<div class="carousel_sub_head ml-1 text-info">WELLNESS</div>
						</a>
			      </div>
			    </div>
			  </div>

			<!-- 2nd card deck ends -->
			</div>
			<!-- 2nd item ends -->
		</div>
		<!-- car-inner ends -->
	</div>

	<a class="carousel-control-prev" href="#health_condition" data-slide="prev"
	id="prevclick1" style="width: 40px;">
	    <span class="fas fa-chevron-left text-primary lead mr-auto"></span>
	</a>
	<a class="carousel-control-next" href="#health_condition" data-slide="next" id="nextclick1"
	style="width: 40px;">
	    <span class="fas fa-chevron-right text-primary lead ml-auto"></span>
	</a>
<!-- carousel 1 ends -->
</div>

<!-- ------------------------------------------------------------------------------------------------ -->

<!-- <hr style="background-color: #f1f1f1; width: 96%;"> -->

<!-- ------------------------------------------------------------------------------------------------ -->

<!-- CAROUSEL FOR THE CATEGORIES -->
<div class="carousel slide" data-ride='false' id="categories" data-pause='hover' data-interval='false' >
	<div
	class="col-md-2 ml-4 mt-4 text-secondary text-gray-dark"style="font-size: 19px; text-shadow: 0 0 0.5px grey;">Categories</div>

	<div class="carousel-inner">

		<!-- 1st item begins -->
		<div class="carousel-item active" id="item2.1">

			<div class="card-deck mt-3 mb-5 mx-4 ">

			  <div class="card">
			  	<img src="images/babycare.jpg" class="card-img-top h-100">
			    <div class="card-img-overlay">
			      <div class="flex-column mt-4">
								<a href="baby_care.php" class="card-link stretched-link">
			      	<div class="carousel_head text-info">BABY</div>
			      	<div class="carousel_sub_head ml-1 text-info">CARE</div>
						</a>
			      </div>
			    </div>
			  </div>

			  <div class="card">
			  	<img src="images/fitness.jpg" class="card-img-top h-100">
			    <div class="card-img-overlay">
			      <div class="flex-column mt-4">
								<a href="fitness_wellness.php" class="card-link stretched-link">
			      	<div class="carousel_head text-info">FITNESS</div>
			      	<div class="carousel_sub_head ml-1 text-info">& WELLNESS</div>
							</a>
			      </div>
			    </div>
			  </div>

			  <div class="card">
			  	<img src="images/family.jpg" class="card-img-top h-100">
			    <div class="card-img-overlay">
			      <div class="flex-column mt-4">
								<a href="family_care.php" class="card-link stretched-link">
			      	<div class="carousel_head text-info">FAMILY</div>
			      	<div class="carousel_sub_head ml-1 text-info">CARE</div>
							</a>
			      </div>
			    </div>
			  </div>

			  <div class="card">
			  	<img src="images/alternate_med.jpg" class="card-img-top h-100">
			    <div class="card-img-overlay">
			      <div class="flex-column mt-4">
								<a href="alternate_medicines.php" class="card-link stretched-link">
			      	<div class="carousel_head text-info">ALTERNATE</div>
			      	<div class="carousel_sub_head ml-1 text-info">MEDICINES</div>
						</a>
			      </div>
			    </div>
			  </div>

			</div>
			<!-- 1st card deck ends -->
		</div>


		<!-- 1st item ends , 2nd begins -->
		<div class="carousel-item" id="item2.2">

			<div class="card-deck mt-3 mx-auto mb-5 col-md-12">

			  <div class="card">
			  	<img src="images/womencare.jpg" class="card-img-top h-100">
			    <div class="card-img-overlay">
			      <div class="flex-column mt-4">
								<a href="women_care.php" class="card-link stretched-link">
			      	<div class="carousel_head text-info">WOMEN'S</div>
			      	<div class="carousel_sub_head ml-1 text-info">CARE</div>
						</a>
			      </div>
			    </div>
			  </div>

			  <div class="card">
			  	<img src="images/personal_care.jpg" class="card-img-top h-100">
			    <div class="card-img-overlay">
			      <div class="flex-column mt-4">
								<a href="personal_care.php" class="card-link stretched-link">
			      	<div class="carousel_head text-info">PERSONAL</div>
			      	<div class="carousel_sub_head ml-1 text-info">CARE</div>
						</a>
			      </div>
			    </div>
			  </div>

			  <div class="card">
			  	<img src="images/health_cond.jpg" class="card-img-top h-100">
			    <div class="card-img-overlay">
			      <div class="flex-column mt-4">
								<a href="health_conditions.php" class="card-link stretched-link">
			      	<div class="carousel_head text-info">HEALTH</div>
			      	<div class="carousel_sub_head ml-1 text-info">CONDITIONS</div>
						</a>
			      </div>
			    </div>
			  </div>

			  <div class="card">
			  	<img src="images/devices.jpg" class="card-img-top h-100">
			    <div class="card-img-overlay">
			      <div class="flex-column mt-4">
								<a href="devices_instruments.php" class="card-link stretched-link">
			      	<div class="carousel_head text-info">DEVICES</div>
			      	<div class="carousel_sub_head ml-1 text-info">INSTRUMENTS</div>
						</a>
			      </div>
			    </div>
			  </div>

			<!-- 2nd card deck ends -->
			</div>
			<!-- 2nd item ends -->
		</div>
		<!-- car-inner ends -->
	</div>

	<a class="carousel-control-prev" style="width: 40px;" href="#categories" data-slide="prev" id="prevclick2">
	    <span class="fas fa-chevron-left text-primary lead mr-auto"></span>
	</a>
	<a class="carousel-control-next" href="#categories" style="width: 40px;" data-slide="next" id="nextclick2">
	    <span class="fas fa-chevron-right text-primary lead ml-auto"></span>
	</a>

</div>




</div>
</body>
</html>
