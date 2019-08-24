<?php session_start();
include 'connection.php';
?>

<style>
.items
	{
		border:1px solid #eee;
		border-left:none;
		border-right:none;
		font-size: 13px;
	}
</style>

<?php

//ARRAY NAMED 'CART' WHICH IS A SESSION VARIABLE WHERE [KEY : PRODUCT ID] & [VALUE : QUANTITY]
$cart=$_SESSION['cart'];

/*---------------------------------------------------------------------------------------------*/

//ADDING PRODUCT ID AND QUANTITY IN SESSION VARIABLE ARRAY

//ADD_TO_CART_AJAX
if(isset($_REQUEST['pid']))
{	
	$pid=$_REQUEST['pid'];
	$qty=$_REQUEST['qty'];

	//$arr=array($pid=>$qty);
	//array_push($_SESSION['cart'], $arr);

	$_SESSION['cart'][$pid]=$qty;

	$max=count($_SESSION['cart']);
	print($max);
}

/*---------------------------------------------------------------------------------------------*/

//REMOVING THE PRODUCT FROM THE CART 

//REMOVE_ITEM()
if(isset($_REQUEST['remove_id']))
{
	$rid=$_REQUEST['remove_id'];
	$size=sizeof($_SESSION['cart']);
	
	unset($_SESSION['cart'][$rid]);

	$secondsWait = 0.01;
	echo '<meta http-equiv="refresh" content="'.$secondsWait.'">';
}

/*---------------------------------------------------------------------------------------------*/

//UPDATING THE QUANTITY OF PRODUCT IN THE CART

//QTYAJAX()
//also updating the price of product according to qty
if(isset($_REQUEST['btnid']) && isset($_REQUEST['proid']) && isset($_REQUEST['proqty']))
{	
	
	$qty=$_REQUEST['proqty'];
	$pid=$_REQUEST['proid'];
	$btn=$_REQUEST['btnid'];
	$price=$_REQUEST['price'];

	if($btn=='plus-'.$pid)
	{
		$qty++;
		echo "&#8377; ".$price*$qty;

	}
	else
	{ 
		$qty--; 
		echo "&#8377; ".$price*$qty;

	}

	$_SESSION['cart'][$pid] = $qty;
	

	if($qty <= 0)
	{
		unset($_SESSION['cart'][$pid]);

	}


	//$secondsWait = 0.01;
	//echo '<meta http-equiv="refresh" content="'.$secondsWait.'">';
}

/*---------------------------------------------------------------------------------------------*/
//HERE UPDATING THE TOTAL OF CART AFTER MANIPULATING QUANTITY

if (isset($_REQUEST['total'])  ) {

	$pid=$_REQUEST['productID'];
	$btn=$_REQUEST['qtybtn'];
	$price=$_REQUEST['cost'];

	if($btn=='plus-'.$pid)
	{
		$_SESSION['total']+=$price;
	}

	else{
		$_SESSION['total']-=$price;
	}

	echo "
		 &#8377; $_SESSION[total] ";
}

/*---------------------------------------------------------------------------------------------*/

//when clicking on pay securely on payment.php , saving the data in order history as a string of 
//pid and qty seperated with commas

//generateReceipt() function in payment.php
if(isset($_REQUEST['paybtn']) && isset($_REQUEST['paymode']) && isset($_REQUEST['addrid']))
{	

	$dateTime=date("Y-m-d h:i:s");
	$paymode=$_REQUEST['paymode'];
	$addid=$_REQUEST['addrid'];	
	$pids=array();
	$qtys=array();	
	$userid=$_SESSION['userID'];
	foreach($_SESSION['cart'] as $pid=>$qty) 
	{	

		array_push($pids, $pid);
		array_push($qtys, $qty);
	}

	$pidstr=implode(',', $pids);
	$qtystr=implode(',', $qtys);
	
	
	$insert="INSERT INTO orderhistory(user_id,PID,quantity,date_time,payment_mode,status,total,add_id) 
	VALUES('$userid','$pidstr','$qtystr','$dateTime','$paymode','1','$_SESSION[total]','$addid')"; 
	mysqli_query($conn,$insert);
	
}

/*---------------------------------------------------------------------------------------------*/

//SAERCHING OF MEDICINE FROM DATABASE
if (isset($_REQUEST['search_id']) && isset($_REQUEST['title'])) 
{
	
	$title=$_REQUEST['title'];
	$title=mysqli_real_escape_string($conn,$title);
	$title=strtolower($title);

	$search="SELECT * FROM medicineinfo  WHERE Name LIKE '".$title."%'";
	$run=mysqli_query($conn,$search);
	if(mysqli_num_rows($run))
	{	
		while($rows=mysqli_fetch_assoc($run))
		{	
			$name=ucwords($rows['Name']);
			$cat=strtoupper($rows['Category']);
			
			echo "
				<div class='list-group-item list-group-item-action px-0 py-1 items'>
					<div class='fas fa-search float-left small mt-1 pl-2 text-info'></div>
					<div class='col-md-7 float-left pl-2' style='font-weight:500;'>$name</div>
					<div class='col-md-7 font-italic font-weight-bold small  pl-4  text-info mt-auto' style='letter-spacing:2.5px;'> in $cat</div>
					<div class='clearfix'></div>
				
				</div>
			";
		}
	}

	else{
		echo "
			<div class='text-center py-1 text-danger bg-light font-weight-bold' style='font-size:20px; letter-spacing:1px;'>NO RESULTS FOUND !!<i class='far fa-frown mx-2'></i></div>
		";		

	}

}
/*-------------------------------------------------------------------------------------------*/

/*DELETING THE ADDRESS FROM THE DATABSE AND THE LIST ON DELIVERY OPTION PAGE*/

//deleteAddress() in delivery_option.php

if(isset($_REQUEST['addressID']))
{	
	$address=$_REQUEST['addressID'];
	$delete="DELETE FROM shipping_details WHERE radio_id='$address'";
	$run=mysqli_query($conn,$delete);
	if($run)
	{
	$secondsWait = 0.01;
	echo '<meta http-equiv="refresh" content="'.$secondsWait.'">';
	}

}

?>