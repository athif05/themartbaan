<?php
session_start();
require_once 'core/core.php';
require_once 'core/other-script.php';

if(!isset($_SESSION['login_id'])) { ?>
<script>
    window.location = "login/index.php";
</script>
<?php } ?>
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
        <title><?php echo ADMIN_TITLE;?> || Dashboard</title>
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
                        <!-- end row -->
                        <div class="row">
					
                             <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
                             <div class="card-box tilebox-one" style=" background:  linear-gradient(rgba(200,200,200,0.45),rgba(200,200,200,0.45)), color: white; border-bottom: 4px solid #e46a76; font-size:18px">
                             	<a href="product-list.php" target="_blank"  style="color:#000;">
                                    <span style="color:#e46a76">Products</span>
                                </a>
                                
                                <span style="float: right;">
									<span title="Total">
									<?php
									$noOfProd=_countNoOfProd('tbl_product');
									echo $noOfProd;
									?>
									</span> / 
									<span style="color: green;" title="Active">
										<?php
										$proActSql=mysqli_query($con, "SELECT * from `tbl_product` where status=1");
										$proActNum=mysqli_num_rows($proActSql);

										echo $proActNum;
										?>
									</span> / 
									<span style="color: red;" title="Out of Stock">
										<?php
										$proInactSql=mysqli_query($con, "SELECT * from `tbl_product` where status=0");
										$proInactNum=mysqli_num_rows($proInactSql);

										echo $proInactNum;
										?>
									</span>
								</span>		
                                </div>
                            </div>
						
								
							<div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
                             <div class="card-box tilebox-one" style=" background:  linear-gradient(rgba(200,200,200,0.45),rgba(200,200,200,0.45)), color: white; border-bottom: 4px solid #03a9f3; font-size:18px">

                             		<a href="manage-user.php" target="_blank"  style="color:#03a9f3;">
	                                    <span style="color:#03a9f3">Clients</span>
	                                </a>
	                                <span style="float: right;">
										<span title="Total">
										<?php
										$noOfUsr=_countNoOfProd('clients');
										echo $noOfUsr;
										?>
										</span> / 
										<span style="color: green;" title="Active">
										<?php
										$usrActSql=mysqli_query($con, "SELECT * from `clients` where status=1");
										$usrActNum=mysqli_num_rows($usrActSql);

										echo $usrActNum;
										?>
										</span> / 
										<span style="color: #03a9f3;" title="New last 30 Days">
										<?php
										$tdydate = strtotime ( '-30 day' , strtotime ( $save_date ) ) ;
										$last30Date = date ( 'Y-m-j' , $tdydate );

										$weektdydate = strtotime ( '-7 day' , strtotime ( $save_date ) ) ;
										$lastWeekDate = date ( 'Y-m-j' , $weektdydate );

										$usrInactSql=mysqli_query($con, "SELECT * from `clients` where post_date>='$last30Date'");
										$usrInactNum=mysqli_num_rows($usrInactSql);

										echo $usrInactNum;
										?>
										</span>
									</span>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
                             <div class="card-box tilebox-one" style=" background:  linear-gradient(rgba(200,200,200,0.45),rgba(200,200,200,0.45)), color: white; border-bottom: 4px solid #ab8ce4; font-size:18px;">

                             		<a href="orders.php" target="_blank"  style="color:#ab8ce4;">
	                                    <span style="color:#ab8ce4">Order</span>
	                                </a>
	                                <span style="float: right;">
										<span title="Total">
										<?php
										$noOfOrder=_countNoOfProd('tbl_order_detail');
										echo $noOfOrder;
										?>
										</span>
										 / 
										<span style="color: green;" title="In Last Week">
											<?php
											$orderWeekSql=mysqli_query($con, "SELECT * from `tbl_order_detail` where post_date>='$lastWeekDate' and orderStatus=1");
											$orderWeekNum=mysqli_num_rows($orderWeekSql);

											echo $orderWeekNum;
											?>
										</span> / 
										<span style="color: red;" title="In Last 30 days">
											<?php
											$orderLast30DaysSql=mysqli_query($con, "SELECT * from `tbl_order_detail` where post_date>='$last30Date' and orderStatus=1");
											$orderLast30DaysNum=mysqli_num_rows($orderLast30DaysSql);

											echo $orderLast30DaysNum;
											?>
										</span>
									</span>
                                </div>
                            </div>

                 
                        </div>
                        <!-- end row -->
					
						<div class="row">		
							<div class="col-xs-12 col-md-12" style="font-size:12px">
								<div class="card-box table-responsive">
									<h4 class="m-t-0 " style="background-color:red; color:#fff;padding:5px;font-size:12px">
										<b>&nbsp; Today Orders</b>
									</h4>
									<div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap4 no-footer"><div class="row"><div class="col-md-12"><table id="datatable" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable_info">
										<thead>
											<tr role="row">
												<th rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 5%;">#</th>
												<!-- <th id="del" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 40px;">
												<i class="fa fa-trash fa-2x"></i>
												</th> -->
												<th class="" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 10%;">TransactionID</th>
												<th class="" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 10%;">OrderID</th>
												<th class="" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 15%;">Amount</th>
												<th class="" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 20%;">User</th>
												<th class="" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 10%;">Pay. Status</th>
												<th class="" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 10%;">Method</th>
												<th class="" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 10%;">Date/Time</th>
												<th class="" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 10%;">Action</th>
												
											</tr>
										</thead>
										<tbody>
										<?php
										$i=1;
										$start=0;
										if(isset($_GET['start'])) $start=$_GET['start'];
										$pagesize=20;
										if(isset($_GET['pagesize'])) $pagesize=$_GET['pagesize'];
										$order_by='id'; //time_set
										if(isset($_GET['order_by'])) $order_by=$_GET['order_by'];
										$order_by2='desc';
										if(isset($_GET['order_by2'])) $order_by2=$_GET['order_by2'];

										$orderSql = mysqli_query($con,"SELECT * from `tbl_order_detail` where post_date='$save_date' and orderStatus=1 order by $order_by $order_by2 limit $start,$pagesize");
										$reccnt=mysqli_num_rows(mysqli_query($con,"SELECT * from `tbl_order_detail` where post_date='$save_date' and orderStatus=1"));
											if($reccnt>0) {
												$amount=0;
											while($orderLine=mysqli_fetch_array($orderSql)) {

												$amount=$orderLine['finalAmount'];

												$clientNameSql=mysqli_query($con, "SELECT * from `clients` where cid='".$orderLine['clientID']."'");
												$clientNameLine=mysqli_fetch_array($clientNameSql);
										  ?>
											<tr role="row" class="odd" style="font-weight:<?php if($x['reading']==0){ echo 'bold';}?>">
												<td class="sorting_1" style="width: 5%;"><?php echo $i+$start; $i++; ?>.</td>
												
												<td style="width: 10%;">
													<?php echo $orderLine['transactionID'];?> 
												</td>
												<td style="width: 10%;">
													<?php echo $orderLine['id'];?>
												</td>
												<td style="width: 15%;">
													<?php echo number_format($amount,2,".",",");?>
												</td>
												<td style="width: 20%;">
													<?php echo $clientNameLine['fname'].' '.$clientNameLine['lname'];?>
												</td>
												<td style="width: 10%;">
													<?php if($orderLine['orderStatus']==0){?>
													Pending
												<?php } else {?>
													Paid
												<?php } ?>
												</td>
												<td style="width: 10%;">   
													Online				
												</td>
												<td style="width: 10%; font-size: 12px;">
													<?php echo date('d-M-Y h:iA',strtotime($orderLine['last_updated']));?>
												</td>
												<td style="width: 10%;">
													<a href="javascript:void(0)" title="Expand" onclick="_expand_order_dtls(<?php echo $orderLine['id'];?>)">
						                              <i class="fa fa-expand"></i> Expand
						                            </a>
						                            <?php if($orderLine['paymentStatus']==1){?>
						                            <a href="order-invoice.php?oid=<?php echo base64_encode($orderLine['id']);?>" title="Invoice" style="color:green;" target="_blank">
						                              <i class="fa fa-file-pdf-o"></i> Invoice
						                            </a>
						                        	<?php } ?>
												</td>
											</tr>
											<tr style="display: none;" id="order_dtls_<?php echo $orderLine['id']?>">
					                          <td colspan="9">
					                            <table cellpadding="0" cellspacing="0" width="100%;">
					                              <thead>
					                                <tr style=" background-color: #ccc; border-bottom:4px solid #ccc;">
					                                  <th class="product_thumb">No.</th>
					                                  <th class="product_thumb">Image</th>
					                                  <th class="product_name">Product</th>
					                                  <th class="product-price">Price</th>
					                                  <th class="product_quantity">Quantity</th>
					                                  <th class="product_total">Total</th>
					                                </tr>
					                              </thead>
					                              <tbody>
					                                <?php
					                                $hh=1;
					                                $cartSql=mysqli_query($con, "SELECT * from `tbl_cart` where orderID='".$orderLine['id']."'");
					                                
					                                  $cartSubtotal=0;
					                                  while($cartLine=mysqli_fetch_array($cartSql)) {

					                                    $prodCart_Sql=mysqli_query($con, "SELECT * from `tbl_product` where cid='".$cartLine['productID']."'");
					                                    $prodCart_Line=mysqli_fetch_array($prodCart_Sql);
					                                ?>
					                                <tr style=" background-color: #ddd;">
					                                  <td class="product_remove">
					                                    <?php echo $hh; $hh++;?>
					                                  </td>
					                                  <td class="product_thumb">
					                                      <img class="header_cart" src="control/images/<?php echo $prodCart_Line['primaryImage'];?>" alt="<?php echo $prodCart_Line['title'];?>" style="height: 50px;">
					                                  </td>
					                                  <td class="product_name">
					                                     <?php echo $prodCart_Line['title'];?>
					                                  </td>
					                                  <td class="product-price">
					                                    <i class="fa fa-inr"></i> <?php echo number_format($cartLine['rate'],2);?>
					                                  </td>
					                                  <td class="product_quantity">
					                                    <?php echo $cartLine['qnt'];?>
					                                  </td>
					                                  <td class="product_total">
					                                    <i class="fa fa-inr"></i>  <?php echo number_format($cartLine['amount'],2);?>
					                                  </td>
					                                  
					                                </tr>                               
					                                <?php } ?>
					                            </tbody>
					                            </table>
					                          </td>
					                        </tr>
										<?php } ?>
										<tr>
											<td colspan="9" style="height: 20px;">
												<?php include("core/paging.inc.php");?>
											</td>
										</tr>
										<?php } else {?>
										<tr>
											<td colspan="9" style="height: 20px;">
												No order...
											</td>
										</tr>
										<?php } ?>
										</tbody>
									</table>
									</div>
									</div>
									</div>
								</div>
	                        </div>
						</div>
                    </div>
                </div>
            </div>
            <div class="side-bar right-bar">

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
		
		<script src="assets/js/jquery.min.js" type="text/javascript"></script>
		<script>
			function _expand_order_dtls(tdl) {        
		        $('#order_dtls_'+tdl).toggle();
		    }
	    </script>

    </body>

    </html>