<?php
	session_start();
	include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>KYD</title>
	
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

	<!-- Animate css -->
	<link rel="stylesheet" type="text/css" href="css/animate.css" />
	 <!-- Slick Slider -->
	<script type="text/javascript" src="js/slick.js"></script>
	<!-- Add fancyBox -->
	<script type="text/javascript" src="js/jquery.fancybox.pack.js"></script>
	<!-- Wow animation -->
	<script type="text/javascript" src="js/wow.js"></script>

	<!--stylesheet-->
	<link rel="stylesheet" type="text/css" href="css/index.css">

	<!-- Open Sans for body font -->
	<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<!-- Cabin for Title -->
	<link href='https://fonts.googleapis.com/css?family=Cabin' rel='stylesheet' type='text/css'>
	<!-- Pacifico for Logo   -->
	<link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>

	<!--Google Login-->
	<script src="https://apis.google.com/js/platform.js" async defer></script>

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
	</script>
</head>
<body>
	
	<!-- Header -->

	<nav class="navbar pb-0 pr-0 pt-1" role="navigation">
		
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
						echo '<li class="nav-item"><a class="nav-link" href="" data-toggle="modal" data-target="#modal1" data-keyboard="false" data-backdrop="static"  onclick="startApp()" style="color:#116daa">Login | Signup</a></li>';
					}
				?>
				
			</div>

		</div>
    
    <!-- Links -->
    <ul class="navbar-nav main-nav w-100 m-0 nav-justified navbar-expand-sm">
	    <li class="nav-item">
	      <a class="nav-link" href="#aa-about-us"><i class="fa fa-book"></i><span>&nbsp;&nbsp;&nbsp;About Us</span></a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link" href="#features"><i class="fa fa-server"></i><span>&nbsp;&nbsp;&nbsp;Features</span></a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link" href="#howit-works"><i class="fa fa-hourglass"></i><span>&nbsp;&nbsp;&nbsp;How it Works</span></a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link" href="#team"><i class="fas fa-users"></i><span>&nbsp;&nbsp;&nbsp;Team</span></a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link" href="#"><i class="fas fa-envelope"></i><span>&nbsp;&nbsp;&nbsp;Contact</span></a>
	    </li>
	  </ul>
  </nav>
	
	<!-- LOGIN | SIGNUP -->
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

	<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
			<div class="carousel-item active">
				<h1 id="left-w-heading">
					WHAT IF A SMART PHONE COULD SAVE A LIFE?
					<p style="font-size: 20px; margin-top: 2rem; font-weight:200;">We think it can! <br>Try our symptom checker today.</p>
				</h1>
				<img src="images/vaaa.png" class="col-md-12 m-0 p-0 img-fluid" style="height:470px;">
			</div>

			<div class="carousel-item ">
				<h1 id="left-b-heading">
					TIRED OF WAITING IN LONG QUEUES?
					<p style="font-size: 20px; margin-top: 2.4rem; font-weight:200;">Now no more queueing! <br>Book doctor's or clinic's appointment online.</p>
				</h1>
				<img src="images/waiting.jpg" class="col-md-12 m-0 p-0 img-fluid" style="height:470px;">
			</div>

			<div class="carousel-item">
				<h1 id="left-w-heading">
					NOW GET ALL THINGS UNDER ONE HOOD!
					<p style="font-size: 20px; margin-top: 2rem; font-weight:200;"> We provide you all!<br>Medicines, Labs or Doctors.</p>
				</h1>
				<div class="row">
					<img src="images/side.png" class="col-md-4 m-0 p-0 img-fluid" style="height:470px;">
					<img src="images/p.png" class="col-md-8 m-0 p-0 img-fluid" style="height:470px;">
				</div>
			</div>

		</div>
	</div>

	<!-- About Us -->
	<section id="aa-about-us">
    <div class="container">
      <div class="aa-about-us-area">
        <div class="row">
          <div class="col-md-12">
            <div class="wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay="0.5s">
              <div class="aa-title">
                <h2 class="title" style="margin-top: 20px;">About <span style="color: #116daa;">Us</span></h2>

              </div>
          </div>
        </div>
        <div class="row about-us-content">
          <div class="aa-about-us-bottom col-xs-12 col-sm-6 col-md-6 ">
            <div class="content wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay="0.5s">
              <p style="padding-top: 50px;">We believe that Life is too precious to spend time on regretting on anything and especially when you regret for not getting hold of a disease at earlier stages. So we at KYD strive to provide all our customers with a hassle-free smart disease detector.<br>

                Our Mission is to automate the medical industry as much as possible and bring them on a single platform.<br><br>


                Founded by a group of budding Young Entrepreneurs <b>Anshula Sachdeva, Member, Sanyam Jain, Shruti Katyal and Sunidhi Sharma.</b><br>

                <em>Visioning to make your everyday life healthier and stress free.</em>
              </p>
            </div>
          </div>
          <div class="about-image wow fadeInRight  col-xs-12 col-sm-12 col-md-6" data-wow-duration="1s" data-wow-delay="1s" style="width: 200px; text-align: center">
            <img src="images/scan3.gif" class="mt-3" >
          </div>

        </div>
      </div>

    </div>
  
  </section>
  <!-- / About us -->

	<!-- Start Features -->
  <section id="features">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-area">
            <h2 class="title">Awesome <span>Features</span></h2>
            
          </div>
        </div>
        <div class="col-md-12">
          <div class="features-area">
            <div class="row">
              <!-- Start features left -->
              <div class="col-md-4">
                <div class="features-left">
                  <ul class="features-list features-list-left">
                    <li class="wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay="0.5s">
                      <i class="fa fa-desktop " ></i>
                      <div class="features-content">
                        <h4 >Computer Vision </h4>
                        <p>Designed to increase accuracy for diagonsing.</p>
                      </div>
                    </li>
                    <li class="wow fadeInLeft" data-wow-duration="0.75s" data-wow-delay="0.75s">
                      <i class="fa fa-edit"></i>
                      <div class="features-content">
                        <h4>Real Time Monitoring</h4>
                        <p>Sensing real time occupancy and sharing the available slots to book.</p>
                      </div>
                    </li>
                    <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
                      <i class="fa fa-object-ungroup"></i>
                      <div class="features-content">
                        <h4>Creative Design</h4>
                        <p>Simple and Interactive User Design.</p>
                      </div>
                    </li>
                    <li class="wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
                      <i class="fa fa-flask"></i>
                      <div class="features-content">
                        <h4>Easy to Use</h4>
                        <p>A simple steps based easy to use application.</p>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <!-- End features left -->
              <!-- Start features img -->
              <div class="col-md-4">
                <div class="feature-img wow fadeInUp">
                  <img src="images/feature.png" alt="iPhone mockup">
                </div>
              </div>
              <!-- End features img -->
              <!-- Start features right -->
              <div class="col-md-4">
                <div class="features-right">
                  <ul class="features-list features-list-right">
                    <li class="wow fadeInRight" data-wow-duration="0.5s" data-wow-delay="0.5s">
                      <i class="fa fa-cogs"></i>
                      <div class="features-content">
                        <h4>E-payment Gateways</h4>
                        <p>Handy and trending ways of paying fees.</p>
                      </div>
                    </li>
                    <li class="wow fadeInRight" data-wow-duration="0.75s" data-wow-delay="0.75s">
                      <i class="fas fa-shield-alt"></i>
                      <div class="features-content">
                        <h4>Privacy</h4>
                        <p>Easy way for someone to start a diagnosis in the privacy of their own home.</p>
                      </div>
                    </li>
                    <li class="wow fadeInRight" data-wow-duration="1s" data-wow-delay="1s">
                      <i class="fa fa-heart"></i>
                      <div class="features-content">
                        <h4>For Physicians</h4>
                        <p>Allows doctor to find cases of patients with similar history.</p>
                      </div>
                    </li>
                    <li class="wow fadeInRight" data-wow-duration="1s" data-wow-delay="1s" >
                      <i class="fas fa-info"></i>
                      <div class="features-content">
                        <h4>24/7 Support</h4>
                        <p>Suppport provided at every minute.</p>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <!-- End features right -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Features -->
<div class="clearfix"></div>
<!-- Start how it works -->
  <section id="howit-works">
    <div class="howit-works-area">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="title-area wow fadeInLeft">
              <h2 class="title">How it <span>Works</span></h2>
              <p>A simple go through video demonstrating the easy working of the KYD.</p>
            </div>
          </div>

          <div class="col-md-12" class="howitvideo">
            <div>
              <!-- ***** Video Area Start ***** -->
              <div class="video-section">

                <!-- Video Area Start -->
                <div class="video-area">
                  <div id="atlanticlight">
                    <video controls>
                      <source src="assets/images/finalpitchvideo.mp4">
                    </video>
                    <button>
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" id="playpause"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <title>Play</title>
                        <polygon points="12,0 25,11.5 25,39 12,50" id="leftbar" />
                        <polygon points="25,11.5 39.7,24.5 41.5,26 39.7,27.4 25,39" id="rightbar" />
                        <animate to="7,3 19,3 19,47 7,47" id="lefttopause" xlink:href="#leftbar" attributeName="points"
                          dur=".3s" begin="indefinite" fill="freeze" />
                        <animate to="12,0 25,11.5 25,39 12,50" id="lefttoplay" xlink:href="#leftbar"
                          attributeName="points" dur=".3s" begin="indefinite" fill="freeze" />
                        <animate to="31,3 43,3 43,26 43,47 31,47" id="righttopause" xlink:href="#rightbar"
                          attributeName="points" dur=".3s" begin="indefinite" fill="freeze" />
                        <animate to="25,11.5 39.7,24.5 41.5,26 39.7,27.4 25,39" id="righttoplay" xlink:href="#rightbar"
                          attributeName="points" dur=".3s" begin="indefinite" fill="freeze" />
                      </svg>
                    </button>
                  </div>
                </div>
                <!-- ***** Video Area End ***** -->
							</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End how it works -->

<!-- Team -->
  <section id="team" class="pb-5">
    <div class="container">
      <h5 class="title-area team-title h1">OUR TEAM</h5>
      <div class="clearfix"></div>
      <div class="row team-row">
        <!-- Team member -->
        <div class="col-xs-12 col-sm-6 col-md-3">
          <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
            <div class="mainflip">
              <div class="frontside">
                <div class="card">
                  <div class="card-body text-center">
                    <p><img class=" img-fluid" src="images/member.jpg" alt="card image">
                    </p>
                    <h4 class="card-title">Member</h4>
                    <p class="card-text">Co-Founder</p>
                  </div>
                </div>
              </div>
              <div class="backside">
                <div class="card">
                  <div class="card-body text-center mt-4">
                    <h4 class="card-title">Member</h4>
                    <p class="card-text">She is a hardworking and dedicated person. She is a web developer of our team.</p>
                    <ul class="list-inline">
                      <li class="list-inline-item">
                        <a class="social-icon text-xs-center" target="_blank" href="#">
                          <i class="fab fa-facebook-f"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a class="social-icon text-xs-center" target="_blank" href="#">
                          <i class="fab fa-instagram"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a class="social-icon text-xs-center" target="_blank" href="#">
                          <i class="fab fa-github"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a class="social-icon text-xs-center" target="_blank" href="#">
                          <i class="fab fa-linkedin"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- ./Team member -->

        <!-- Team member -->
        <div class="col-xs-12 col-sm-6 col-md-3">
          <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
            <div class="mainflip">
              <div class="frontside">
                <div class="card">
                  <div class="card-body text-center">
                    <p><img class=" img-fluid" src="images/member.jpg" alt="card image">
                    </p>
                    <h4 class="card-title">Member</h4>
                    <p class="card-text">Co-Founder</p>
                  </div>
                </div>
              </div>
              <div class="backside">
                <div class="card">
                  <div class="card-body text-center mt-4">
                    <h4 class="card-title">Member</h4>
                    <p class="card-text">She is a hardworking and dedicated person. She is a web developer of our team.</p>
                    <ul class="list-inline">
                      <li class="list-inline-item">
                        <a class="social-icon text-xs-center" target="_blank" href="#">
                          <i class="fab fa-facebook-f"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a class="social-icon text-xs-center" target="_blank" href="#">
                          <i class="fab fa-instagram"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a class="social-icon text-xs-center" target="_blank" href="#">
                          <i class="fab fa-github"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a class="social-icon text-xs-center" target="_blank" href="#">
                          <i class="fab fa-linkedin"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- ./Team member -->

        <!-- Team member -->
        <div class="col-xs-12 col-sm-6 col-md-3">
          <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
            <div class="mainflip">
              <div class="frontside">
                <div class="card">
                  <div class="card-body text-center">
                    <p><img class=" img-fluid" src="images/member.jpg" alt="card image">
                    </p>
                    <h4 class="card-title">Member</h4>
                    <p class="card-text">Co-Founder</p>
                  </div>
                </div>
              </div>
              <div class="backside">
                <div class="card">
                  <div class="card-body text-center mt-4">
                    <h4 class="card-title">Member</h4>
                    <p class="card-text">She is a hardworking and dedicated person. She is a web developer of our team.</p>
                    <ul class="list-inline">
                      <li class="list-inline-item">
                        <a class="social-icon text-xs-center" target="_blank" href="#">
                          <i class="fab fa-facebook-f"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a class="social-icon text-xs-center" target="_blank" href="#">
                          <i class="fab fa-instagram"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a class="social-icon text-xs-center" target="_blank" href="#">
                          <i class="fab fa-github"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a class="social-icon text-xs-center" target="_blank" href="#">
                          <i class="fab fa-linkedin"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- ./Team member -->

        <!-- Team member -->
        <div class="col-xs-12 col-sm-6 col-md-3">
          <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
            <div class="mainflip">
              <div class="frontside">
                <div class="card">
                  <div class="card-body text-center">
                    <p><img class=" img-fluid" src="images/member.jpg" alt="card image">
                    </p>
                    <h4 class="card-title">Member</h4>
                    <p class="card-text">Co-Founder</p>
                  </div>
                </div>
              </div>
              <div class="backside">
                <div class="card">
                  <div class="card-body text-center mt-4">
                    <h4 class="card-title">Member</h4>
                    <p class="card-text">She is a hardworking and dedicated person. She is a web developer of our team.</p>
                    <ul class="list-inline">
                      <li class="list-inline-item">
                        <a class="social-icon text-xs-center" target="_blank" href="#">
                          <i class="fab fa-facebook-f"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a class="social-icon text-xs-center" target="_blank" href="#">
                          <i class="fab fa-instagram"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a class="social-icon text-xs-center" target="_blank" href="#">
                          <i class="fab fa-github"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a class="social-icon text-xs-center" target="_blank" href="#">
                          <i class="fab fa-linkedin"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- ./Team member -->
 

      </div>
    </div>

  </section>
  <!-- Team -->



</script>
  <!-- Custom js -->
<script type="text/javascript" src="js/custom.js"></script>

</body>
</html>