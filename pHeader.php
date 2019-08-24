<!DOCTYPE html>
<html>
<head>
	<title>new header</title>
	
	<!-- Bootstrap.css version 4.3.1 CDN -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	<!--Fontawesome CDN-->
	<script src="https://kit.fontawesome.com/e79df9883a.js"></script>

	<!--jQuery CDN-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<script>

	$(document).ready(function(){

		//$('#search_group').hide();

		$('#search_icon').click(function(){

			var search_group_width=$('#search_bar').width();
			//alert(search_group_width);
			if (search_group_width<216) {

				$('#search_bar').css({'borderBottom':'1px solid #aaa'},50).animate({'paddingLeft': '9px'}).animate({'width': '30px'},50).animate({'width': '60px'},50).animate({'width': '90px'},50).animate({'width': '120px'},50).animate({'width': '150px'},50).animate({'width': '180px'},50).animate({'width': '210px'},50).animate({'width': '240px'},50);
				
				$('#search_icon').css({'borderBottom':'1px solid #aaa'});
			}

			else{

				$('#search_bar').css({'borderBottom':'none','paddingLeft':'-9px'},50).animate({'width': '240px'},50).animate({'width': '210px'},50).animate({'width': '180px'},50).animate({'width': '150px'},50).animate({'width': '120px'},50).animate({'width': '90px'},50).animate({'width': '60px'},50).animate({'width': '30px'},50).animate({'width':'0'},50);


				

				$('#search_icon').css({
					
					'borderBottom' : 'none'
				});

				// $('#search_bar').css({
				// 	'paddingLeft': '0',
				// 	'borderBottom' : 'none'
				// });

			}

			
		});
	});
</script>
</head>
<style>
	#navbar1{
		margin: 0;
		padding-top: 0.25%;
		padding-bottom: 0%;
		border:none;
		border-radius:0;
		background-color: black; 
	}
	.navbar-brand{
		padding: 0;
	}
	#brand{
		font-size: 20px;
		font-weight: 400;
		color: white; 
		font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
		/*transition: ease-in-out 1s;*/
	} 

	#brand:hover{
		/*transform: rotate(360deg);*/
		cursor: pointer;
		text-shadow: 2px 0 4px #5bc0de;
	}

	.navbar li a{
		color: #777;
		font-size: 15px;

	}

	.navbar li a:hover{
		color: #5bc0de;
	}
	
	#search_bar{
		border:none;
		background-color: black;
		color: white;
		border: 0;
		box-sizing: border-box;
		width: 0;
		font-size: 15px;
	}

	#search_icon{
		color: #777; 
		background-color: black; 
		border:none; 
		font-size: 16px;
	}

	.form-control:focus{
		border:none;
		box-shadow: none;
	}

	.navbar-form{
		border: none;
		outline: none;
	}
	
	#scenery{
		background-image: url('images/mountain.jpg');
		height: 80px;
		background-repeat: no-repeat;
		background-size: cover;
		color: white;
		font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
		padding-top: 20px;
		padding-left: 10px;

	}

	#navbar2{
		box-shadow: 0 0 4px grey;
	}

</style>
<body>
	<div class="navbar navbar-expand-sm pt-0 pb-0 m-0" id="navbar1">
		<div class="pr-sm-3" id="togglebutton" onclick="opensidebar();" style="cursor: pointer; color: white;">
			&#9776;
		</div>

		<a class="navbar-brand offset-4 pl-5" id="brand"> <span class="offset-1">KNOW YOUR DISEASE</span></a>

		<!-- welcome user and wallet -->
		<div class="nav navbar-nav ml-auto nav_items ">
			
 			<!-- SEARCH BAR -->
			<li class="nav-item pr-2">
				<form class="navbar-form" role='search' style="padding-left: 0;">
					<div class="input-group" id="search_group">
						<input type="text" name="search" id="search_bar" placeholder="SEARCH ITEM" class="form-control text-left">
						<div class=" input-group-addon mt-2" id="search_icon" style="padding-left: 0;" >
							 <span class="fa fa-search"></span>
						</div>
					</div>
				</form>
			</li>

			<li class="nav-item"><a class="nav-link" href="#"><img src="images/wallet.png" class="img-responsive" style="width: 20px;"></a></li>
		
		</div>

	</div>

	<div class="w-100" id="scenery" >
		<h3 id="greeting">Hello, 
			<?php
					if(isset($_SESSION['user']))
						echo " ".$_SESSION['user']."<br>";
					else
						echo "";
			?>
		</h3>
	</div>

	<div class="navbar navbar-expand-sm pt-0 pb-0 m-0 justify-content-center" id="navbar2" >
		<div class="nav navbar-nav">
			<li class="nav-item px-2"><a href="#" class="nav-link">HOME</a></li>
			<li class="nav-item px-2"><a href="#" class="nav-link">OUR SERVICES</a></li>
			<li class="nav-item px-2"><a href="#" class="nav-link">ABOUT US</a></li>
			<li class="nav-item px-2"><a href="#" class="nav-link">CONTACT US</a></li>
			<li class="nav-item px-2"><a href="#" class="nav-link">NEED HELP ?</a></li>
		</div>	
	</div>
</body>
</html>