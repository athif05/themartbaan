<?php
session_start();
require_once "core/core.php";
require_once "core/other-script.php";
@extract($_REQUEST);

if(!isset($_SESSION['login_id'])) { ?>
	<script>
		window.location = "login/index.php";
	</script>
<?php }

if(isset($oid)) {
	$oid=base64_decode($oid);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
		<meta name="author" content="Coderthemes">
		<link href="assets/plugins/custombox/css/custombox.min.css" rel="stylesheet">
		<!-- Calender css -->
		<link href="assets/plugins/fullcalendar/dist/fullcalendar.css" rel="stylesheet" />
		<!-- App Favicon -->
		<link rel="shortcut icon" href="assets/images/favicon.png">
		<!-- App title -->
		<title><?php echo ADMIN_TITLE;?> || Invoice</title>
		<!--Morris Chart CSS -->
		<link rel="stylesheet" href="assets/plugins/morris/morris.css">
		<!-- Switchery css -->
		<link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
		<!-- App CSS -->
		<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		<style>
			h2 {
				font-size: 27px;
			}
			.hover1:hover{
				color:red;
			}

			@media print {
                #printbtn {
                    display :  none;
                }
                #bckbtn {
                    display :  none;
                }
            }

		</style>
		<script src="assets/js/modernizr.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	</head>
	<body class="fixed-left"> <!-- onload="startTime()" -->
		<!-- Begin page -->
		<div id="wrapper">
			<?php include 'include/header.php';?>
			<!-- Top Bar Start -->
			<?php include "include/sidebar.php";?>
			<div class="content-page">
				<div class="content">
					<div class="container">
						<div class="row">		
							<div class="col-xs-12 col-md-12" style="font-size:12px">
								<div class="card-box table-responsive">
									<div class="white-box printableArea">
										<h3>
											<b>INVOICE</b> 
											<span class="pull-right">
												<b>Order No</b>:&nbsp;
												<?php echo $oid; ?>
											</span>
										</h3>
										<?php 
										$invoicedate=mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `tbl_order_detail` where id = ".$oid."")); 
										?>
										<hr>
										<div class="row">
											<div class="col-md-12" style="float: left;width: 100%;">
												<div class="pull-left" style="float: left; width: 50%;">
													<address>
														<h3> &nbsp;
															<b class="text-danger">
																<?php 
																echo INVOICE_TITLE;
																?>
															</b>
														</h3>
														<?php
														$contactSql = mysqli_query($con,"SELECT * FROM contact ");
														$contactLine = mysqli_fetch_array($contactSql);
														?>
														<p class="text-muted m-l-5">
														<?php echo $contactLine['add1']; ?>
														<br/>
														<?php echo $contactLine['add2']; ?>
														<?php echo $contactLine['add3']; ?>
														<!-- <br/> Noida,
														<br/> Uttar Pradesh XXXXXX -->
														</p>
													</address>
												</div>
												<div class="pull-right text-right" style="float: right; width: 50%; text-align: right; font-size: 14px;">
													<address>
														<h3>To,</h3>
														<h4 class="font-bold">
															<?php echo $invoicedate['client_name'];?>
														</h4>
														<p class="text-muted m-l-30">
															<?php echo $invoicedate['client_address']; ?>, 	
															<br/> 
															Contact No. : 
															<?php echo $invoicedate['client_phone']; ?>,
														<br/> 
														<?php echo $invoicedate['client_city']; ?>
														<br/> <?php echo $invoicedate['client_state']; ?>
														<br/> <?php echo $invoicedate['client_country']; ?>
														</p>
														<p class="m-t-30">
															<b>Invoice Date :</b> 
															<i class="fa fa-calendar"></i>&nbsp;
															<?php echo date('d-M-y',strtotime($invoicedate['post_date'])); ?>
														</p>
													</address>
												</div>
											</div>
											<div class="col-md-12" style="float: left;width: 100%;">
												<div class="table-responsive m-t-40" style="clear: both;">
													<table class="table table-hover">
														<thead>
															<tr>
																<th class="text-center">
																	#
																</th>
																<th>Description</th>
																<th class="text-right">
																	Quantity
																</th>
																<th class="text-right">
																	Unit Cost
																</th>
																<th class="text-right">
																	Total
																</th>
															</tr>
														</thead>
														<tbody>
														<?php 
														$i=1; 
														$subtotal=0; 
														$orders=mysqli_query($con, "SELECT * FROM  `tbl_cart` where `orderID` = ".$oid."");
														while($orderSummery=mysqli_fetch_array($orders)) {

														$subdata=mysqli_fetch_array(mysqli_query($con, "SELECT * FROM  `tbl_product`  where `cid` = ".$orderSummery['productID'].""));

														?>
														<tr>
															<td class="text-center">
																<?php echo $i++;?>
															</td>
															<td>
																<?php 
																	echo $subdata["title"];
																?>
															</td>
															<td class="text-right"> 
																<?php echo $orderSummery["qnt"];?> 
															</td>
															<td class="text-right"> 
																<?php echo number_format($orderSummery["rate"]);?> 
															</td>
															<td class="text-right"> 
																<?php echo number_format($orderSummery["amount"]);?>
															</td>
														</tr>
														<?php } ?>
														</tbody>
													</table>
												</div>
											</div>
											<div class="col-md-12" style="float: left;width: 100%;">
												<div class="pull-right m-t-30 text-right" style="color: #000; float: right;width: 25%;">
													<p>
														Sub Total amount: 
														<i class="fa fa-inr"></i>
														&nbsp;
														<?php echo number_format($invoicedate['amount']); ?>
													</p>
													<p>
														GST(<?php echo $product_gst;?>%) :
														<i class="fa fa-inr"></i>
														&nbsp;
														<?php echo number_format($invoicedate['gstTax']); ?>
													</p>
													<p>
														Delivery charge :
														<i class="fa fa-inr"></i>
														&nbsp;
														<?php echo number_format($invoicedate['shipping_charge']); ?>
													</p>
													<hr>
													<h3>
														<b>Total :</b>
														<i class="fa fa-inr"></i>
														&nbsp;
														<?php echo number_format($invoicedate['finalAmount']); ?>
													</h3>
												</div>
												<div class="clearfix"></div>
												<hr>
												<div class="text-right">
													<a id="bckbtn" href="<?php echo $_SERVER['HTTP_REFERER'];?>"  class="btn btn-info btn-outline" type="button">Back
													</a>
												<!--<button class="btn btn-danger" type="submit"> Proceed to payment </button>-->
													<button id="printbtn" onclick="window.print();" class="btn btn-primary btn-outline" type="button"> 
														<span>
															<i class="fa fa-print"></i> Print
														</span> 
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<footer class="footer text-right">
				<?php echo $copy_right;?>
			</footer>
		</div>
		<script>
			var resizefunc = [];
		</script>
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/tether.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/detect.js"></script>
		<script src="assets/js/fastclick.js"></script>
		<script src="assets/js/jquery.blockUI.js"></script>
		<script src="assets/js/waves.js"></script>
		<script src="assets/js/jquery.nicescroll.js"></script>
		<script src="assets/js/jquery.scrollTo.min.js"></script>
		<script src="assets/js/jquery.slimscroll.js"></script>
		<script src="assets/plugins/switchery/switchery.min.js"></script>
		<!--Morris Chart-->
		<script src="assets/plugins/morris/morris.min.js"></script>
		<script src="assets/plugins/raphael/raphael-min.js"></script>
		<!-- Counter Up  -->
		<script src="assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
		<script src="assets/plugins/counterup/jquery.counterup.min.js"></script>
		<script src="assets/js/jquery.core.js"></script>
		<script src="assets/js/jquery.app.js"></script>
		<script src="assets/pages/jquery.dashboard.js"></script>
		<script src="assets/plugins/custombox/js/custombox.min.js"></script>
		<script src="assets/plugins/custombox/js/legacy.min.js"></script>
		<script src="assets/plugins/moment/moment.js"></script>
		<script src='assets/plugins/fullcalendar/dist/fullcalendar.min.js'></script>
		<!--<script src="assets/pages/jquery.fullcalendar.js"></script>-->
	</body>
</html>