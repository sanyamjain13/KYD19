<?php
session_start();
require_once 'assets/dompdf/autoload.inc.php';
require_once 'connection.php';

use Dompdf\Dompdf;

$html = '
<head>
	<style>
		#order_summary{
		    font-size: 26px;
		    color: rgb(80,80,80);
		    font-weight: bold;
		}
		
		.text-center{
		    text-align: center!important;
		}

		.pb-3, .py-3{
		    padding-bottom: 1rem!important;
		}
		
		.pt-3, .py-3 {
    		padding-top: 1rem!important;
		}

		.pb-2, .py-2 {
		    padding-bottom: .5rem!important;
		}

		.pr-2, .px-2 {
		    padding-right: .5rem!important;
		}

		.pt-2, .py-2 {
		    padding-top: .5rem!important;
		}

		.font-weight-bold {
		    font-weight: 700!important;
		}

		.list-group {
		    padding-left: 0;
		    margin-bottom: 0;
		}

		.list-group-item {
		    position: relative;
		    display: block;
		    padding: .75rem 1.25rem;
		    margin-bottom: -1px;
		    border: 1px solid rgba(0,0,0,.125);
		}

		.product_info {
		    font-size: 17px;
		    color: black;
		    font-weight: 500;
		    letter-spacing: 1px;
		    margin-top:-70px;
		    margin-left: 11%;
		}

		.text-capitalize {
		    text-transform: capitalize!important;
		}

		.price,.sno {
		    color: black;
		    font-weight: bold;
		    font-size: 20px;
		    text-align:right;
		    margin-top: -30px;
		   	margin-bottom:40px;

		}

		.sno{
			font-size: 18px;
			margin-top:2px;
			text-align:left;
		}

		.text-info {
		    color: #17a2b8!important;
		}

		.lead {
		    font-size: 1.25rem;
		    font-weight: 300;
		}

		.card-footer {
		    padding: .75rem 1.25rem;
		    border-top: 1px solid rgba(0,0,0,.125);
		    border: 1px solid rgba(0,0,0,.125);
    		border-radius: .25rem;
		}
	</style>
</head>
<body>
	<div class="card bg-light col-md-10 offset-1 mt-3 px-0 w-100">
	
	<!-- HEADING -->
	<div class="text-center py-3" id="order_summary">
		ORDER RECEIPT 
		';

			$orderid=$_GET['id'];
			$select="SELECT * FROM orderhistory WHERE orderID='$orderid'";
			$run=mysqli_query($conn,$select);
			

			if(mysqli_num_rows($run))
			{
				$row=mysqli_fetch_assoc($run);
				$time = new DateTime($row['date_time']);
				$ndate = $time->format('d F Y');

				$arr_pid=explode(',', $row['PID']);
				$arr_qty=explode(',', $row['quantity']);

				$total_items=sizeof($arr_pid);

				$html .="
					<span style='font-size: 17px; color: darkgrey' class='px-1'>
						$total_items Items
					</span>

				</div>

				<div style='background: #eee; font-family: sans-serif;'>
					<div class='font-weight-bold px-2 py-2' style='padding:10px;'>
						ORDER ID : O-$_GET[id]
						<div style='text-align:right; margin-top:-20px'> Dated : ".$ndate."</div>
					</div>
				</div>
				
				";

				for($i=0; $i<sizeof($arr_pid);$i++) 
				{
					$sel_product="SELECT * FROM medicineinfo WHERE PID = '$arr_pid[$i]'";
					$product_run=mysqli_query($conn,$sel_product);
					$product_row=mysqli_fetch_assoc($product_run);
					$html .= "
						<div class='list-group'>
							<div class='list-group-item'>
								<div><img src=$product_row[Imgsrc] style='width:10.67%'></div>
								<div class='text-capitalize product_info' style='max-width: 33.333333%;'>
									<div>$product_row[Name]</div>
									<div style='font-size: 13px; color: grey;'>Qty : $arr_qty[$i]</div> 
								</div>

								<div class='ml-auto price'>
									<div>Rs $product_row[Price]</div>
								</div>
							</div>
						</div>
					";
				}

				$html .=" 
				<div class='card-footer'>
					<div class='lead text-info'>Total Amount</div>
					<div class='lead font-weight-bold text-info' style='margin-top:-30px;text-align:right;'>Rs $row[total]</div>
				</div>
				<img src='images/stamp.png' style='width:15%; margin-top:-150px; margin-left:60%; z-index:-100; margin-bottom:0;transform:rotate(-30deg)''  >
				";
			}
	

$html.='
</div>

</body>';

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("Webslesson", array("Attachment"=>0));
?>