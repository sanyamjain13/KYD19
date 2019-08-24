<?php?//session_start();
//$_SESSION['address']=$_GET['addID'];
include 'connection.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>PAYMENT</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

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
	
	<link rel="stylesheet" type="text/css" href="css/payment.css">
	<link rel="stylesheet" type="text/css" href="css/progress_bar.css">
	
	<!-- API for handling debit/credit card inputs and validations -->
	<script type="text/javascript" src="payform.js"></script>
	<script type="text/javascript" src="jquery.payform.js"></script>

	<script>
		function check_len(ele_id)
		 {

			var x = ele_id;
			var id=x.id;
			var icon=document.getElementsByClassName('far fa-credit-card');
			
/*			this fn helps to ->
			Includes a space between every 4 digits
			Restricts input to numbers
			Limits to 16 numbers
			Supports American Express formatting
*/			
			payform.cardNumberInput(x);			
			/*---------------------------------------*/
			
			//validating the card number

			if(payform.validateCardNumber(x.value) == false)
			{
				x.style.color='red';
				x.style.fontWeight = '500';
			}

			else
			{
				x.style.color = 'green';
				x.style.fontWeight = '500'

			}
			/*----------------------------------------------------------*/

			//this fn tells what is the card type (visa,amex,mastercard etc)
			//payform.parseCardType(value)

			if(payform.parseCardType(x.value)=='visa')
			{	
				if(id=='debit_card_num')
				{	
					icon[0].className='fab fa-cc-visa icons';
					//icon[0].removeClass('far fa-credit-card');
				}

				else{
					icon[1].className='fab fa-cc-visa icons';	
				}
			}

			else if(payform.parseCardType(x.value)=='amex')
			{	
				if(id=='debit_card_num')
				{	
					icon[0].className='fab fa-cc-amex icons';
					//icon[0].removeClass('far fa-credit-card');
				}

				else{
					icon[1].className='fab fa-cc-amex icons';	
				}
			}

			else if(payform.parseCardType(x.value)=='mastercard')
			{	
				if(id=='debit_card_num')
				{	
					icon[0].className='fab fa-cc-mastercard icons';
					//icon[0].removeClass('far fa-credit-card');
				}

				else{
					icon[1].className='fab fa-cc-mastercard icons';	
				}
			}

			else
			{
				if(id=='debit_card_num')
				{	
					icon[0].className='far fa-credit-card icons';
					//icon[0].removeClass('far fa-credit-card');
				}

				else{
					icon[1].className='far fa-credit-card icons';	
				}	
			}
			
		}	

		/*------------------------------------------------------*/


		function validateCVV(x){
			var ele=x;
			
			/*Restricts length to 4 numbers
			Restricts input to numbers*/	
			payform.cvcInput(ele);
		/*
			Validates number
			Validates length to 4
		*/			
			if(payform.validateCardCVC(ele.value)==true)
			{
				x.style.color='green';
				x.style.fontWeight = '500';
			}

			else
			{
				x.style.color='red';
				x.style.fontWeight = '500';	
			}
		}


		function expiry(ele)
		{
			var x=ele;
			//payform.expiryInput(x);			
			//payform.parseCardExpiry(string) returns month and year in a object
			//payform.validateCardExpiry(month, year)
			if(x.value.length<5)
			{
				var index=x.value.lastIndexOf('/');
				var test=x.value.substr(index+1);
				if(test.length===2)
				{
					x.value=x.value + '/';
				}
			}

			else
			{
				return false;
			}

		}

		//getting the parameters from the link ot the URl
		function getUrlVars() {
		   
		    var vars = {};
		    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
		        vars[key] = value;
		    });
		    return vars;
		}
		

		//function to add the items in the order history
		//passing the payment mode and addressID to the receipt page
		function generateReceipt(btnid,mode)
		{	
			//var btnid= which payment mode's btn is clicked
			//var mode= which payment mode (debit card,credit card,bhim or net banking)
			
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function()
			{
				if(xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					window.location='receipt.php?paymentMode='+mode+'&addressid='+getUrlVars()["addID"];

				}
			}

			xmlhttp.open('GET','category_process.php?paybtn='+btnid+'&paymode='+mode+'&addrid='+getUrlVars()["addID"],true);
			xmlhttp.send();
		}

	</script>
</head>
<body>
	
	<!-- PROCESS STATUS BAR -->


	
	<div class="col-md-12 row justify-content-center py-2 mx-0" style="background: #116daa;">
		
		<!-- buy med -->
		<div class="widget">
			<div class="status_icons rounded-circle border-info bg-light glow" title="Medicines Selected"
			onclick="window.location='buy_medicines.php'">
				<div class="fas fa-check text-info my-auto"></div>
			</div>
			<div class="widget-text">Medicines Selected</div>
		</div>
		<hr class="custom-hr-solid">

		<!-- cart -->
		<div class="widget">
			<div class="status_icons rounded-circle border-info bg-light glow" title="Items Added to the Cart"
			onclick="window.location='cart.php'">
				<div class="fas fa-check text-info my-auto"></div>
			</div>
			<div class="widget-text">Cart</div>
		</div>
		<hr class="custom-hr-solid">
		
		<!-- delivery address -->
		<div class="widget">
			<div class="status_icons bg-light rounded-circle border-info glow" title="Select Your Delivery Address">
				<div class="fas fa-check text-info my-auto"></div>
			</div>
			<div class="widget-text">Delivery Address</div>
		</div>
		<hr class="custom-hr-solid">
			
		<!-- payment -->
		<div class="widget">
			<div class="status_icons rounded-circle border-info" title="Make Your Payment">
				<div class="far fa-credit-card text-info my-auto"></div>
			</div>
			<div class="widget-text">Payment Options</div>
		</div>
		<hr class="custom-hr-dashed">
		
		<!-- receipt -->
		<div class="widget">
			<div class="status_icons rounded-circle border-info" title="Generate Your Receipt">
				<div class="fas fa-file-invoice text-info my-auto"></div>
			</div>
			<div class="widget-text">Receipt</div>
		</div>

	</div>



	<div class="container mt-5" id="payment_heading">
		Payment Options <i class="fas fa-rupee-sign px-2"></i>
	</div>
	
	<div class="d-flex flex-row justify-content-center container px-0" id="payment_container">

		<form id="accordian" class="py-2 px-3 nav nav-tabs flex-column">
			
			
		
		<!-- --------------------------------------------------------------------------------------------- -->
			
			<!-- link for debit card -->

			<div class="nav-item active" data-toggle='tab' data-target='#debit_card_body' style="background: none; cursor: pointer;">
				<div class="card-header row">
					<div class="col-md-9">Debit Card</div> 
					<div class="col-md-2"><img src="images/dcard.png" class="img-fluid"></div> 
				</div>
			</div> 
		
		<!-- --------------------------------------------------------------------------------------------- -->
			
			<!-- link for credit card -->

			<div class="nav-item" data-toggle='tab' data-target='#credit_card_body' style="background: none; cursor: pointer;">
				<div class="card-header row" >
					<div class="col-md-9">Credit Card</div>
					<div class="col-md-2"><img src="images/ccard.png" class="img-fluid"></div>
				</div>
			</div> 
		
		<!-- --------------------------------------------------------------------------------------------- -->
			
			<!-- link for bhim upi -->

			<div class="nav-item" data-toggle='tab' data-target='#bhim_upi_body' style="background: none; cursor: pointer;">
				<div class="card-header row" >
					<div class="col-md-9">BHIM UPI</div>
					<div class="col-md-2"><img src="images/bhim.png" class="img-fluid"></div>
				</div>
			</div>
		<!-- --------------------------------------------------------------------------------------------- -->
			
			<!-- link for net banking -->

			<div class="nav-item" data-toggle='tab' data-target='#net_banking_body' style="background: none; cursor: pointer;">
				<div class="card-header row" >
					<div class="col-md-9">Net Banking</div>
					<div class="col-md-2"><img src="images/netbank.png" class="img-fluid"></div>
				</div>
			</div>
		<!-- --------------------------------------------------------------------------------------------- -->
		
			<div class="nav-item" style="background: none; cursor: pointer;" id="cod" 
				onclick="generateReceipt(this.id,'Cash On Delivery')">
				<div class="card-header row" >
					<div class="col-md-9">Cash on Delivery</div>
					<div class="col-md-2"><img src="images/cod.png" class="img-fluid"></div>
				</div>
			</div>
		
		<!-- --------------------------------------------------------------------------------------------- -->

		</form>
		
		<!-- FORM LINKS END -->

		<!-- --------------------------------------------------------------------------------------------- -->

		<!-- TAB CONTENT STARTS HERE -->
		
		<div class="tab-content col-md-8 bg-light" style="box-shadow: 1px 1px 6px grey;">
			
			<!-- DEBIT CARD CONTENT -->
			<div class="card-body mx-auto w-75 bg-light tab-pane active mt-2" id="debit_card_body">
						
				<div class="form-group ">
					<label class=" d-block labels px-1">Name On Your Debit Card</label>
					<div style="position: relative;">
						<input type="text" name="debit_card_name" id="debit_card_name" class="input_box" 
						placeholder="Enter Card Holder's Name">
						<span class="fas fa-user-tie icons"></span>
					</div>
				</div>

				<div class="form-group" >
					<label class=" d-block labels px-1">Enter Card Number</label>
					<div style="position: relative;">
						<input type="tel" name="debit_card_num" id="debit_card_num" class="input_box" 
						placeholder="Enter Card Number" onkeydown="check_len(this);" maxlength="18" >
						<span class="far fa-credit-card icons" id="db"></span>
					</div>
				</div>

				<div class="col-md-5 px-0 float-left">
					<label class=" d-block labels px-1">Expiry/Validity Date</label>
					<div style="position: relative;">
						<input type="text" name="d_expiry_date" id="d_expiry_date" class="input_box" 
						placeholder="MM / YY" maxlength="5"  onkeydown="expiry(this);">
						<span class="fas fa-calendar icons"></span>
					</div>
				</div>

				<div class="col-md-5 px-0 float-right">
					<label class=" d-block labels px-1">CVV</label>
					<div style="position: relative;">
						<input type="text" name="d_cvv" id="d_cvv" class="input_box"
						placeholder="Enter CVV" onkeydown="validateCVV(this);">
						<span class="fas fa-lock icons"></span>
					</div>
				</div>
				<div class="clearfix"></div>

				<button class="btn btn-info btn-block btn-sm mt-4" id="dc" onclick="generateReceipt(this.id,'debit-card')">
					Pay Securely &nbsp;  <i class="fas fa-key small"></i></button>

			</div>
			
		<!-- --------------------------------------------------------------------------------------------- -->
			
			<!-- CREDIT CARD CONTENT -->
			<div class="card-body w-75 mx-auto bg-light tab-pane fade mt-2" id="credit_card_body">
				
				<div class="form-group">
					<label class=" d-block labels px-1">Name On Your Credit Card</label>
					<div style="position: relative;">
						<input type="text" name="credit_card_name" id="credit_card_name" class="input_box" 
						placeholder="Enter Card Holder's Name">
						<span class="fas fa-user-tie icons"></span>
					</div>
				</div>

				<div class="form-group">
					<label class=" d-block labels px-1">Enter Card Number</label>
					<div style="position: relative;">
						<input type="tel" name="credit_card_num" id="credit_card_num" class="input_box" 
						placeholder="Enter Card Number" onkeydown="check_len(this);" maxlength="16">
						<span class="far fa-credit-card icons"></span>
					</div>
				</div>

				<div class="col-md-5 px-0 float-left">
					<label class=" d-block labels px-1">Expiry/Validity Date</label>
					<div style="position: relative;">
						<input type="text" name="c_expiry_date" id="c_expiry_date" class="input_box" 
						placeholder="MM / YY" maxlength="5"  onkeydown="expiry(this);">
						<span class="fas fa-calendar icons"></span>
					</div>
				</div>

				<div class="col-md-5 px-0 float-right">
					<label class=" d-block labels px-1">CVV</label>
					<div style="position: relative;">
						<input type="text" name="c_cvv" id="c_cvv" class="input_box"
						placeholder="Enter CVV" onkeydown="validateCVV(this);">
						<span class="fas fa-lock icons"></span>
					</div>
				</div>
				<div class="clearfix"></div>
				
				<button class="btn btn-info btn-block btn-sm mt-4" id="cc" onclick="generateReceipt(this.id,'credit-card');">
					Pay Securely &nbsp;  <i class="fas fa-key small"></i></button>

			</div>
		<!-- --------------------------------------------------------------------------------------------- -->
				
			<!-- BHIM UPI CONTENT -->

			<div class="card-body w-75 mx-auto bg-light tab-pane fade mt-5" id="bhim_upi_body" >
				
				<div class="form-group">
					<label class=" d-block labels px-1">Enter UPI</label>
					<input type="text" name="bhim_upi" id="bhim_upi" class="input_box" 
					placeholder="yourUPIhandle@bankname">
				</div>

				<button class="btn btn-info btn-block btn-sm mt-3" onclick="generateReceipt(this.id,'bhim-upi');">
					Pay Securely &nbsp;  <i class="fas fa-key small"></i></button>


			</div>

		<!-- --------------------------------------------------------------------------------------------- -->
				
			<!-- NET BANKING CONTENT -->

			<div class=" tab-pane fade mt-1 w-75 mx-auto  " id="net_banking_body">
				
				<div class="small">
					<div class="list-group-item text-capitalize list-group-item-action">
					<img src="images/sbi.png" class="bank_icons">state bank of india
					</div>
					
					<div class="list-group-item text-capitalize list-group-item-action">
					<img src="images/axis.png" class="bank_icons mr-2">axis bank</div>
					
					<div class="list-group-item text-capitalize list-group-item-action">
					<img src="images/pnb.png" class="bank_icons mr-2">punjab national bank</div>
					
					<div class="list-group-item text-capitalize list-group-item-action">
					<img src="images/kotak.png" class="bank_icons mr-2">kotak bank</div>
					
					<div class="list-group-item text-capitalize list-group-item-action">
					<img src="images/andhra.jpg" class="bank_icons mr-2">andhra bank</div>

					<div class="list-group-item">Select from all other banks 
						<i class="fas fa-chevron-down ml-3"></i></div>
				</div>	

			</div>
		
		<!-- TAB CONTENT ENDS -->
		</div>
		
		<!-- --------------------------------------------------------------------------------------------- -->
	
	</div>

</body>
</html>