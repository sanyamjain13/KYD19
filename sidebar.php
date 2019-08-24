<?php
  session_start();
  if(!isset($_SESSION['user']))
  {header('Location:index.php');}
  //echo $_SESSION['userID'];
  
  include 'connection.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>KYD PATIENT</title>

	<!-- Bootstrap.css version 4.3.1 CDN -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	<!--Fontawesome CDN-->
	<script src="https://kit.fontawesome.com/e79df9883a.js"></script>
  
  <!-- Animate css -->
  <link rel="stylesheet" type="text/css" href="css/animate.css" />
   <!-- Slick Slider -->
  <script type="text/javascript" src="js/slick.js"></script>
  <!-- Add fancyBox -->
  <script type="text/javascript" src="js/jquery.fancybox.pack.js"></script>
  <!-- Wow animation -->
  <script type="text/javascript" src="js/wow.js"></script>

	<!--jQuery CDN-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript" src="js/AccountSettings.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/sidebar.css">
	
  <script>
    new WOW().init();
  </script>

<style>

	.panel-body{
		background-color: black;
		color: white; 
	}

</style>
<script>

function opensidebar()
{
  var nav=document.getElementById('navbar2');
  var user=document.getElementById('scenery');
  var greet=document.getElementById('greeting');
  var main = document.getElementById('main');
  var settings=document.getElementById('settings');
  
  if ($('#mysidebar').hasClass("sidebar")) 
  {
    $('#mysidebar').removeClass("sidebar");
    nav.style.marginLeft='0px';
    user.style.display='';
    main.style.marginLeft='0px';
    settings.style.marginLeft = '0px';
  }

  else
  {
      $('#mysidebar').addClass("sidebar");
      nav.style.marginLeft='250px';
      user.style.display='none';
      main.style.marginLeft='250px';
      settings.style.marginLeft = '250px';
  }
}

function logout(){
  var xmlhttp=new XMLHttpRequest();
      
  xmlhttp.open('POST','enterNewUser.php?signOut=true',true);
  xmlhttp.send();

}

</script>

</head>
<body>	

	<div id="mysidebar" >
		<div class="nav nav-pills flex-column">
			
			<div class="row">
				
				<li class="col-md-3 offset-md-1"><img src="images/man.png" class="img-fluid"></li>
				
				<div>	
					<li class="col-md-12 text-capitalize">
						<div class="user_name ">
							<?php
								echo $_SESSION['user']."<br>";
							?>
						</div>
					</li>

					<li class="col-md-1 ">
						<div class="user_cat text-center ">Patient</div>
					</li>
				</div>
				
			</div>
			
			<div class="dropdown-divider w-100 mt-3" ></div>

			<li class="nav-item"><a class="nav-link" href="symptomChecker.php" id="drawersitems">Know Your Disease</a></li>
			
			<li class="nav-item"><a class="nav-link" href='#book_panel' id="drawersitems" data-toggle='collapse'>Book <i class="fas fa-plus-circle pl-2"></i></a>

				<div class="panel panel-default panel-collapse  collapse" id="book_panel" style="border:none;">
					<div class="panel-body pl-4">
						<div><i class="fas fa-chevron-right"></i></i> Doctor's Appointment</div>
						<div class="dropdown-divider w-75 m-1" style="color: white;"></div>
						<div><i class="fas fa-chevron-right"></i> Clinical Test</div>
					</div>
				</div>
			</li>


			<li class="nav-item"><a class="nav-link" href="buy_medicines.php" id="drawersitems">Buy Medicines</a></li>
			
			<li class="nav-item"><a class="nav-link" href='#history_panel' id="drawersitems" data-toggle='collapse'>History <i class="fas fa-plus-circle pl-2"></i></a>
				
				<div class="panel panel-default collapse" id="history_panel" style="border:none;">
					<div class="panel-body pl-4">
						<div><i class="fas fa-chevron-right"></i> Previous Appointments</div>
						<div class="dropdown-divider w-75 m-1" style="color: white;"></div>
						<div><i class="fas fa-chevron-right"></i> Previous Reports</div>
					</div>
				</div>

			</li>	
			
			<li class="nav-item">
				<a class="nav-link" href='#settings_panel' id="drawersitems" data-toggle='collapse'>
					Settings <i class="fas fa-plus-circle pl-2"></i>
				</a>
				
				<div class="panel panel-default collapse" id="settings_panel" style="border:none;">
					<div class="panel-body pl-4">
						<div style="cursor: pointer;" onclick="toggle_settings();"><i class="fas fa-chevron-right"></i> Accounts Settings</div>
						<div class="dropdown-divider w-75 m-1" style="color: white;"></div>
						<div><i class="fas fa-chevron-right"></i> Payments Settings</div>
					</div>
				</div>

			</li>	
			
			<li class="nav-item"><a class="nav-link" href="index.php" onclick="logout()" id="drawersitems">SIGN OUT  <i class="fas fa-sign-out-alt pl-2"></i></a></li>	

		</div>
		
	</div>

	<div>
		<?php include 'pHeader.php'?>
	</div>
<!-- ----------------------------------------------------------------------------------------- -->
	<!-- MAIN CONTENT -->

  <div id="main">
		<section class="cards-section">

      <div class="row">
        <div class="options col-lg-3 col-md-4">
          <div class="card">
            <div class="card-header" style="background-color:#aee7e8">
              <div class="row">
                <div class="col-lg-5">
                  <img src="https://image.flaticon.com/icons/svg/1851/1851372.svg" class="icon-img img-fluid">
                </div>
                <div class="col-lg-7 p-0">
                    <h1 class="col-lg-12  text-right">2</h1>
                    <h5 class="col-lg-12 px-0 ml-auto text-right m-0">Appointments</h5>
                </div>
              </div>

            </div>

            <div class="card-footer bg-dark text-light">
              VIEW MORE
            </div>
          </div>
        </div>

        <div class="options col-lg-3 col-md-4">
          <div class="card">
            <div class="card-header" style="background-color:#aee7e8">
              <div class="row">
                <div class="col-lg-5">
                  <img src="https://image.flaticon.com/icons/svg/1396/1396243.svg" class="icon-img img-fluid">
                </div>
                <div class="col-lg-7 ">
                    <h1 class="col-lg-12 text-right">2</h1>
                    <h5 class="col-lg-12 ml-auto text-right m-0">Lab Tests</h5>
                </div>
              </div>

            </div>

            <div class="card-footer bg-dark text-light">
              VIEW MORE
            </div>
          </div>
        </div>

        <div class="options col-lg-3 col-md-4">
          <div class="card">
            <div class="card-header" style="background-color:#aee7e8">
              <div class="row">
                <div class="col-lg-5">
                  <img src="https://image.flaticon.com/icons/svg/1763/1763642.svg" class="icon-img img-fluid">
                </div>
                <div class="col-lg-7 ">
                  <div>
                    <h1 class="col-lg-12 text-right">2</h1>
                    <h5 class="col-lg-12 ml-auto text-right m-0">Reports</h5>
                  </div>
                </div>
              </div>

            </div>

            <div class="card-footer bg-dark text-light">
              VIEW MORE
            </div>
          </div>
        </div>


        <div class="options col-lg-3 col-md-4">
          <div class="card">
            <div class="card-header" style="background-color:#aee7e8">
              <div class="row">
                <div class="col-lg-5">
                  <img src="https://image.flaticon.com/icons/svg/1546/1546140.svg" class="icon-img img-fluid">
                </div>
                <div class="col-lg-7 ">
                  <div>
                    <h1 class="col-lg-12 text-right">2</h1>
                    <h5 class="col-lg-12 ml-auto text-right m-0">Medicines</h5>
                  </div>
                </div>
              </div>

            </div>

            <div class="card-footer bg-dark text-light">
              VIEW MORE
            </div>
          </div>
        </div>




      </div>
  </section>

  <section class="recent-section">
    <div class="row">
      <div class="col-lg-4">
         <div class="card-upcoming">
          <div class="card-header-upcoming ">
            <h1>Appointments</h1>
          </div>
          <div class="row mx-0 card-body-upcoming">
             <div class=" mr-auto col-lg-6">
                 <h6>Clinic: abc</h6>
                 <h6>Doctor: xyz</h6>
             </div>
             <div class="col-lg-6 ml-auto text-right m-0">
                 <h6 class="">Date: 03-02-2019</h6>
                 <h6 class="">Time: 10 am</h6>
             </div>
         </div>
          <hr>
         <div class="row mx-0 card-body-upcoming">
            <div class=" mr-auto col-lg-6">
                <h6>Clinic: abc</h6>
                <h6>Doctor: xyz</h6>
            </div>
            <div class="col-lg-6 ml-auto text-right m-0">
                <h6 class="">Date: 03-02-2019</h6>
                <h6 class="">Time: 10 am</h6>
            </div>
        </div>
       <div class="view-more ml-auto text-right  pr-1">
           <a href="">View More</a>
       </div>
      </div>




  </div>

  <div class="col-lg-4">
         <div class="card-upcoming">
          <div class="card-header-upcoming">
            <h1>Tests</h1>
          </div>
          <div class="row mx-0 card-body-upcoming">
         <div class=" mr-auto col-lg-6">
             <h6>Test: abc</h6>

         </div>
         <div class=" ml-auto text-right m-0 col-lg-6">
             <h6 class="">Date: 03-02-2019</h6>
             <h6 class="">Time: 10 am</h6>
         </div>
     </div>
     <hr>
     <div class="row mx-0 card-body-upcoming">
    <div class=" mr-auto col-lg-6">
        <h6>Test: abc</h6>

    </div>
    <div class=" ml-auto text-right m-0 col-lg-6">
        <h6 class="">Date: 03-02-2019</h6>
        <h6 class="">Time: 10 am</h6>
    </div>
</div>
     <div class="view-more ml-auto text-right pr-1">
         <a href="">View More</a>
     </div>
      </div>




  </div>

  <div class="col-lg-4">
    <div class="card-upcoming">
        
      <div class="card-header-upcoming">
        <h1>Orders</h1>
      </div>

      <div class='card-body-upcoming'>
         <?php
            echo "
            <div class='list-group-item d-flex flex-row mt-0 small border-0 pt-2 pb-3'>
              <div class='col-md-7 text-capitalize font-weight-bold pl-0'>Product Name</div>
              <div class='col-md-1 font-weight-bold pl-0'>Qty</div>
              <div class='col-md-4 font-weight-bold text-right'>&#8377; Price</div>
            </div>
            ";
            $userid=$_SESSION['userID'];
            $select="SELECT * FROM orderhistory WHERE user_id='$userid' LIMIT 2";
            $run=mysqli_query($conn,$select);
            while($rows=mysqli_fetch_assoc($run))
            { 
              echo "<div class='list-group list-group-flush orders-list'>";
             
              $arr_pid=explode(',', $rows['PID']);
              $arr_qty=explode(',', $rows['quantity']);

              for($i=0; $i<sizeof($arr_pid);$i++) 
              {
                $sel="SELECT * FROM medicineinfo WHERE PID = '$arr_pid[$i]'";
                $r=mysqli_query($conn,$sel);
                $row=mysqli_fetch_assoc($r);

                echo " 
                  <div class='list-group-item d-flex flex-row mt-0 small border-0 pt-2 pb-1 list-group-item-action'>
                    <div class='col-md-7 text-capitalize pl-0'><i class='fas fa-chevron-right small pl-0 text-secondary my-auto'></i> &nbsp;$row[Name]</div>
                    <div class='col-md-1 pl-0 text-center'>$arr_qty[$i]</div>
                    <div class='col-md-4 text-right '>&#8377; $row[Price]</div>
                  </div>
                ";    

              }

            echo "</div>
            <hr class='my-2'>
            ";


            }
          ?>

      <div class="view-more ml-auto text-right pr-2 pb-1">
        <a href="my_orders.php">View More</a>
      </div>
    
    </div>
  
  </div>

</div>

</section>

</div>

<!-- MAIN CONTENT ENDS -->


<!-- -------------------------------------------------------------------------------------- -->
<!-- ACCOUNT SETTINGS
-->  

<div  id="settings" style="display: none;" >

  <div class="container-fluid">

    <div class="my-2 float-left px-1" id="settings-heading"> Account Settings 
      <i class="fas fa-user-cog small "></i> 
    </div>

    <div class="float-right" id="close-settings" onclick="close_settings();">&times</div>
    <div class="clearfix"></div>

    <!-- -------------------------------------------------->
    <!-- DETAILS SECTION -->
    
    <div class='list-group list-group-flush mt-1' id='details'>
      
      <div class='list-group-item account-list-heads py-2 border-top-0'>Details 
        <div class='float-right text-secondary' style='cursor: pointer;' id="editpen" onclick='update_fields();'>
          <i class="fas fa-pen-alt"></i>
        </div> 
        
        <div class='float-right' id="UpdateYesNo" style="display: none;">
          <i class="fas fa-check px-3 text-success" style="cursor: pointer;" onclick="changeUname(event);" id="UpdateYes"></i>

          <i class="fas fa-times text-danger" id="UpdateNo" style="cursor: pointer;" onclick="closeFields()"></i>
        </div> 

      </div>

        <?php

          $select="SELECT * FROM users WHERE UserId='$_SESSION[userID]'";
          $run=mysqli_query($conn,$select);
          while ($rows=mysqli_fetch_assoc($run)) 
          {   
              echo " 
                <div class='list-group-item flex-row d-flex py-2 acct-info list-group-item-action'>
                  <div class='col-md-6 acct-info-title'>Name</div>
                  <div class='col-md-6 text-capitalize text-secondary ml-1' id='name'>$rows[Fname] $rows[Lname]</div>

                  <div class='col-md-5' id='input-user-name' style='display: none;' 
                  onkeyup='changeUname(event)' >

                    <input type='text' name='contactName' class='acct-input-type col-md-5' 
                    value=$rows[Fname] id='fname' placeholder='First Name' autofocus>

                    <input type='text' name='contactName' class='acct-input-type col-md-5' 
                    value=$rows[Lname] id='lname'  placeholder='Last Name' autofocus>
                  </div>

                  <i class='fas fa-user-edit my-auto update-icon small' style='display: none;'></i>
                </div>

                 <div class='list-group-item flex-row d-flex py-2 acct-info list-group-item-action'>
                  <div class='col-md-6 acct-info-title'>Contact</div>
                  <div class='col-md-6 text-capitalize text-secondary' id='contact'>+91-$rows[Mobile]</div>
                  
                  <div class='col-md-5' id='input-contact-number' style='display: none;'>
                    <input type='text' class='acct-input-type' maxlength='10'
                    value=$rows[Mobile] onkeyup='changeNumber(event);' autofocus placeholder='Contact Number' id='contactNo'>
                  </div>

                  <i class='fas fa-user-edit my-auto update-icon small' style='display: none;'></i>

                </div>

                <div class='list-group-item flex-row d-flex py-2 acct-info list-group-item-action'>
                  <div class='col-md-6 acct-info-title'>Registered Email</div>
                  <div class='col-md-6 text-secondary'>$rows[Email]</div>
                </div>

              ";    
          }
        ?>

    </div>
    <?php


    ?>
    <!-- ----------------------------------------------------->
        <!-- PASSWORD SECTION -->

        <div class='list-group list-group-flush mt-4' id='password'>
      
          <div class='list-group-item account-list-heads py-2 border-top-0'>Password 
            <div class='float-right text-secondary' data-toggle='modal' data-target='#passChange' data-keyboard='false' data-backdrop='static'>
            <i class='fas fa-pen-alt' style='cursor: pointer;'></i></div> 
          </div>

          <div class='list-group-item flex-row d-flex py-2 acct-info list-group-item-action'>
            <div class='col-md-6 acct-info-title'>Password</div>
            <div class='col-md-6 text-capitalize text-secondary'>
              <input type='password' name='password' value='password' class="input-type-password" 
              disabled='true'>
            </div>
          </div>
          
          <!-- MODAL FOR UPDATING PASSWORD -->
          <div class='modal fade' id='passChange'>
            <div class='modal-dialog'>

              <div class='modal-content'>
              
                <div class='modal-body px-3 bg-light'>

                  <form method='post'>
                    <div class='form-group my-2'>

                      <input type='password' name='oldPass' class='form-control float-left' 
                      placeholder='Current Password' onkeyup="checkPassword(this.value);" required>
                      <span id='passStatus' class='float-right my-auto success-tick'>
                        <!-- AJAX DATA -->
                      </span>
                      <div class="clearfix"></div>
                    </div>

                    <div class='form-group my-2'>
                      <input type='password' name='newPass' class='form-control float-left' 
                      placeholder='New Password' id='newPass' required>
                      
                      <span  class='float-right my-auto success-tick' id="NewPassTick">
                      </span>
                      <div class="clearfix"></div>
                    </div>
                    
                    <div class='form-group my-2'>
                      <input type='password' name='confirmPass' id='confirmPass' 
                      class='form-control float-left' 
                      placeholder='Confirm Password' onkeyup='MatchNewCurrentPass(this.value);' required>
                      
                      <span  class='float-right my-auto success-tick' id="ConfirmPassTick">
                      </span>
                      <div class="clearfix"></div>
                    </div>

                    <input type='submit' name='changePassword' class='btn btn-success btn-block btn-sm'>
                    <button class='btn btn-sm btn-danger btn-block' data-dismiss='modal'>Close</button>

                  </form>

                </div>
              </div>
            </div>
          </div>
          <!-- MODAL ENDS -->
        </div>
        
        <?php

          if (isset($_POST['changePassword'])) {
            $currentPass=$_POST['oldPass'];
            $newPass=$_POST['newPass'];

            $update="UPDATE users SET Password='$newPass' WHERE UserId='$_SESSION[userID]' AND Password='$currentPass'";
            $run=mysqli_query($conn,$update);

            }
          

        ?>
    

    <!-- ----------------------------------------------------------->
        <!-- Account Security  -->

        <div class='list-group list-group-flush mt-4 mb-4' id='password'>
    
          <div class='list-group-item account-list-heads py-2 border-top-0'>Account Security 
            <div class='float-right text-secondary'><i class='fas fa-pen-alt' style='cursor: pointer;'></i></div> 
          </div>

          <div class='list-group-item flex-row d-flex py-2 acct-info list-group-item-action'>
            <div class='col-md-6 acct-info-title'>Two-factor authentication </div>
            <div class='col-md-6 text-capitalize text-secondary'>Off</div>
          </div>

        </div>
    <!-- ----------------------------------------------------------->

  </div>
  <!-- continer ends -->

</div>
<!-- settings ends -->

<!-- -------------------------------------------------------------------------------------- -->

</body>
</html>