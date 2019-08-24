<?php
session_start();
// unset($_SESSION['user']);
include 'connection.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>LOGIN-SIGNUP</title>
	
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
	
	<!--Google Login-->
	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<!-- Pacifico for Logo   -->
	<link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>

	<!--Google Sigin callback function-->
	<script>
	  var googleUser = {};
	  var startApp = function() {

	    gapi.load('auth2', function(){
	      // Retrieve the singleton for the GoogleAuth library and set up the client.
	      auth2 = gapi.auth2.init({
	        client_id: '682428034450-hq1a2nqqlmdod62l0to29i5b22f2n5cd.apps.googleusercontent.com',
	        cookiepolicy: 'single_host_origin',
	        // Request scopes in addition to 'profile' and 'email'
	        //scope: 'additional_scope'
	      });
	      attachSignin(document.getElementById('customBtn'));
	    });
	  };

	  function attachSignin(element) {
	    console.log(element.id);
	    auth2.attachClickHandler(element, {},
	        function(googleUser) {
	          //document.getElementById('name').innerText = "Signed in: " +
	            //  googleUser.getBasicProfile().getName();
	                $('.modal').modal('hide');

	        }, function(error) {
	          alert(JSON.stringify(error, undefined, 2));
	        });
	  }
    </script>

	<!--FB login-->
	<script type="text/javascript">

		// This is called with the results from from FB.getLoginStatus().
		function statusChangeCallback(response) {
			console.log('statusChangeCallback');
			console.log(response);
			// The response object is returned with a status field that lets the
			// app know the current login status of the person.
			// Full docs on the response object can be found in the documentation
			// for FB.getLoginStatus().
			if (response.status === 'connected') {
			// Logged into your app and Facebook.
			testAPI();
			} else if (response.status === 'not_authorized') {
			// The person is logged into Facebook, but not your app.
			document.getElementById('status').innerHTML = 'Login with Facebook ';
			} else {
			// The person is not logged into Facebook, so we're not sure if
			// they are logged into this app or not.
			document.getElementById('status').innerHTML = 'Login with Facebook ';
			}
		}

		function checkLoginState() {
			FB.getLoginStatus(function(response) {
			statusChangeCallback(response);
			});
		}

		window.fbAsyncInit = function() {
		FB.init({
		appId : '338514813496178',
		cookie : true, 
		xfbml : true, 
		version : 'v2.2' 
		});

		FB.getLoginStatus(function(response) {
			statusChangeCallback(response);
			});
		};


		// Load the SDK asynchronously
		(function(d, s, id) 
		{
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));

		function testAPI() {
			console.log('Welcome! Fetching your information.... ');
			FB.api('/me?fields=name,email', function(response) {
			console.log('Successful login for: ' + response.name);
			});
		}
		
		function login(){

			//Check that all fields are filled
			var email=document.getElementsByName('emailID')[0];
			var pass =document.getElementsByName('password1')[0];
			
			if(email.value == "" || pass.value=="")
			{
				document.getElementById('loginErr').innerText ="Fill the inputs";
				return false;
			}
			
			var xmlhttp=new XMLHttpRequest();
			
			xmlhttp.onreadystatechange=function()
			{
				if(xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					document.getElementById('loginErr').innerHTML=xmlhttp.responseText;
					if(xmlhttp.responseText=='')
					{
						$('.modal').hide();
						location.reload();
						
					}
				}

			}

			xmlhttp.open('POST','enterNewUser.php?emailID='+email.value+"&passwordID="+pass.value,true);
			xmlhttp.send();

			return false;

		}

		function validateForm()
		{

			var f = document.forms["sign_up_form"];
			var i;
			
			//Check that all fields are filled
			for(i = 0; i < f.length - 1; i++)
			{
				if(f[i].value == "")
				{
					document.getElementById('err'+i).innerText ="Required*";
					f[i].focus();
					return false;
				}
			}

			var fname=document.getElementsByName('fname')[0].value;
			if(fname.length<3){
				document.getElementById('err0').innerText ="Length should be more than 3";
				return false;
			}
			else{
				document.getElementById('err0').innerText ="";
			}

			var lname=document.getElementsByName('lname')[0].value;
			if(lname.length<3){
				document.getElementById('err1').innerText ="Length should be more than 3";
				return false;
			}
			else{
				document.getElementById('err1').innerText ="";
			}

			var email=document.getElementsByName('email')[0].value;
			var patt = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  			var result = patt.test(email);
			if(!result)
			{
				document.getElementById('err2').innerText ="Enter a valid Email address";	
				return false;			
			}
			else{
				document.getElementsByName('email')[0].onblur();

			}
			
			var phoneNo=document.getElementsByName('phoneNo')[0].value;
			if ( /^\d{10}$/.test(phoneNo)){
				document.getElementsByName('phoneNo')[0].onblur();
			}
			else{
				document.getElementById('err3').innerText ="Enter a valid Mobile Number";	
				return false;
			}

			var password = document.getElementsByName('password')[0].value;
			var cpassword = document.getElementsByName('cpassword')[0].value;

			if(cpassword!=password)
			{
				document.getElementById('err4').innerText ="Passwords do not match";
				return false;
			}
			else{
				document.getElementById('err4').innerText ="";
			}

			var gender = $("input[name='gender']:checked").val();
			alert(gender);

			if(document.getElementById('err2').innerText=='' && document.getElementById('err3').innerText=='')
			{
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.open('POST','enterNewUser.php?email='+email+'&phoneNo='+phoneNo+'&fname='+fname+'&lname='
					+lname+"&gender="+gender+"&password="+password,true);
				xmlhttp.send();
				$('.modal').modal('hide');
				location.reload();
			}	
			return false;
			
		}

		function test(){
		  var xmlhttp=new XMLHttpRequest();
		  xmlhttp.onreadystatechange=function()
			{
				if(xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					document.getElementById('err2').innerHTML=xmlhttp.responseText;

				}
			}

			var email=document.getElementsByName('email')[0].value;

			xmlhttp.open('POST','enterNewUser.php?email='+email,true);
			xmlhttp.send();
		}


		function testMobile(){
		  var xmlhttp=new XMLHttpRequest();
		  xmlhttp.onreadystatechange=function()
			{
				if(xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					document.getElementById('err3').innerHTML=xmlhttp.responseText;

				}
			}

			var phoneNo=document.getElementsByName('phoneNo')[0].value;

			xmlhttp.open('POST','enterNewUser.php?phoneNo='+phoneNo,true);
			xmlhttp.send();
		}

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

			}

			
		});
	});
	</script>
</head>

<style>
	.navbar li a{
		color: #777;
		font-size: 16px;

	}

	.navbar li a:hover{
		color: #777;
	}
	

	.form-control:focus{
		border:none;
		box-shadow: none;
	}

	.navbar-form{
		border: none;
		outline: none;
	}
	
	#togglebutton:hover{
		text-decoration: none;
		/*color: white;*/
	}

	#login_text{
		font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
		font-size: 14px;
		margin-top: 10px;
		text-align: center;
		font
	}

	hr{
		height: 1px;
		color: blue;
		background-color: blue;
		border: none;
	}


	.modal-lg{
		width: 58%;
	}
	
	#login_tab,#signup_tab{
		
		font-size: 18px;
		margin-top: -10px;
		margin-bottom: 0px; 
		margin-right: 10px; 
		padding-bottom: 5px;
		border-radius: 0;
	}

	.modal-header{
		border:none;
	}
	.form-group{
		margin: 28px 5%;

	}

	.form-control{
		border:none;
		border-bottom: 1px solid silver;
		box-shadow: none;
	}
	
	.form-control::placeholder{
		color: #6f6f6f;
		font-size: 15px;
	}

	#password_form{
		margin-bottom: 18px;
	}

	#text_form{
		font-size: 13px;
		font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
		font-weight: 500;
		padding-right: 5px;
	}

	#btn_login{
		width: 80%;
		margin:0 10%;
		font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
		font-weight: 520;
		margin-bottom: 15px;
	}
	
	#tc{
		font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
		font-size: 11px;
		color:#6f6f6f;
		margin-left: 5%;
		margin-right: 5%;
	}
	
	.g-signin2{


	}

	.navbar-brand{
	font-family: 'Pacifico';
	color: #eee;
	padding-left: 7px;
	font-size: 18px;
	font-weight: 200 !important;
	}
	.navbar-brand:hover{
		color:#777;
	}
</style>
<body>

  <nav class="navbar pb-0 pr-0" role="navigation" style="background: black">
		
		<div class="w-100 row">
	    <!-- Brand -->
			<a class="navbar-brand" href="#"><b>Know Your Disease</b></a>

			<!-- Login / Signup -->
			<!-- <a class="float-right" href="" style="color:#116daa" data-target="#modal1" data-keyboard="false" data-backdrop="static"  onclick="startApp()">Login | Signup</a> -->

			<!-- welcome user and wallet -->
			<div class="nav navbar-nav ml-auto nav_items">
				
				<!-- <li class="nav-item" id="welcome_user" ><a class="nav-link" href="javascript:void(0)" onclick="opensidebar();">  <i class="fas fa-praying-hands"></i>  Sanyam Jain </a></li> -->
				<?php
					if(isset($_SESSION['user']))
					{
						echo '<li class="nav-item"><a class="nav-link" style="color:#116daa" href="sidebar.php">  <i class="fas fa-praying-hands"></i> Hi, '.$_SESSION['user'].' </a></li>';
					}
					else{
						echo '<li class="nav-item"><a class="nav-link" href="" data-toggle="modal" data-target="#modal1" data-keyboard="false" data-backdrop="static"  onclick="startApp()" style="color:#eee">Login | Signup</a></li>';
					}
				?>
				
			</div>

		</div>
	</nav>

  <div class="modal fade" id="modal1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">  
      <div class="modal-header">
        <div class="close" data-dismiss='modal'>&times;</div>
      </div>
      <div class="modal-body">    
        <div class="row">

          <div class="col-md-6" style="margin-top: -20px">
            <img src="images/features.png" class="img-fluid">
          </div>
          <div class="col-md-6" style="border-left: 1px solid grey; ">

            <ul class="nav nav-pills" style="margin-left: 5%">
              <li class="nav-item"><a class="nav-link active" data-toggle="tab" id="login_tab" href="#sign_in_menu">Sign In</a></li>
              <li class="nav-item"><a class="nav-link"data-toggle="tab" id="signup_tab" href="#sign_up_menu">Sign Up</a></li>
            </ul>

            <div class="tab-content">
              <div id="sign_in_menu" class="tab-pane fade in show active ">
                  <form method = "POST" onsubmit="return login()">
                    <div class="form-group">
					  <span class="text-danger small" id="loginErr"></span>
                      <input type="text" name="emailID" class="form-control" placeholder="Registered Mobile Number or Email ID" onblur="checkEmail()">
                    </div>

                    <div class="form-group" id="password_form">
                      <input type="password" name="password1" class="form-control"  placeholder="Password">
                    </div>
                    

                    <div class="offset-md-4" style="margin-bottom: 30px;">
                      <a id="text_form" style="border-right:2px solid silver">Forgot Password</a>
                      <a id="text_form"> Other Login Issues?</a>
                    </div>

                    <!-- Change the btn color to info if the active links' bgcolor could be changed-->

                    <button class="btn btn-lg btn-primary" type="submit" id="btn_login">
                      <i class="fas fa-lock" style="margin-right:7px; "></i>  Login Securely
                    </button>
                </form>
                <div id="tc">
                  By logging in, you agree to our <a>Terms & Conditions</a> & <a>Privacy Policy</a>.
                </div>

              </div>


              <div id="sign_up_menu" class="tab-pane fade">
                  <form id = "sign_up_form" action = "" method = "POST" onsubmit = "return validateForm()">
					<div class = "form-group">
					  <span class="text-danger small" id="err0"></span>
					  <input type = "text" name="fname" class="form-control" placeholder="First Name">
					</div>

					<div class = "form-group">
					  <span class="text-danger small" id="err1"></span>
					  <input type = "text" name="lname" class="form-control" placeholder="Last Name">
					</div>
					
					<div class="form-group">
					  <span class="text-danger small" id="err2"></span>
                      <input type="email" name="email" id="email" onblur="test()" class="form-control" placeholder="Email ID" >
                    </div>

					<div class="form-group">
					  <span class="text-danger small" id="err3"></span>
                      <input type="text" name="phoneNo" class="form-control" onblur="testMobile()" placeholder="Mobile Number" >
                    </div>
                   		
					<div class="form-group">
					  <span class="text-danger small" id="err4"></span>
                      <input type="password" name="password" class="form-control "  placeholder="Create Password" >
                    </div>

                    <div class="form-group" >
					  <span class="text-danger small" id="err5"></span>
                      <input type="password" name="cpassword" class="form-control "  placeholder="Confirm Password" >
                    </div>
				
					<div class = "form-group col-md-12">
                    	Gender :
					  <input class="offset-1" type = "radio" name="gender" value = "M" checked="true">Male
					  <input class="offset-1" type = "radio" name="gender" value = "F" >Female
					</div>
    
                  <!-- Change the btn color to info if the active links' bgcolor could be changed-->

                  <button class="btn btn-lg btn-primary" type="submit" id="btn_login">
                    Proceed
                  </button>
              
                </form>

                <div id="tc">
                  By creating this account, you agree to our <a>Terms & Conditions</a> & <a>Privacy Policy</a>.
                </div>

              </div>
            </div>
            
            <div class="row col-md-12">
              <hr style="margin-left: 5%;" class="col-md-2">

              <div id="login_text" class="col-md-5">
                Or Login with
              </div>

              <hr class="col-md-2">
            </div>
            
            <div class="row offset-md-3" id="social">
              <div class="col-md-3 ">
                <img src="images/google.png" class="img-fluid" id="customBtn">
              </div>
               <script>startApp();</script>

              <div class="col-md-3" onclick="FB.login()">
                <img src="images/facebook.png" class="img-fluid"></div>
            </div>
            
            <div style="height: 25px;"></div>
          </div>
        </div> 
      </div>
      <div style="height: 7px; display: block; background: lightblue ;"></div>
      <div style="height: 7px; display: block;" class="bg-primary"></div>
    </div>
  </div>
  </div>

</body>
</html>