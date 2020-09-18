<?php
session_start();
require_once 'core/core.php';
require_once 'core/other-script.php';
@extract($_REQUEST);

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
                  					
						<div class="row">		
							<div class="col-xs-12 col-md-12" style="font-size:12px">
								
								<div class="card-box table-responsive">
									<div style="float: left; width: 100%;">
										<form name="srchFrm" method="post">
											<div style="float: left; width: 14%;">
												<input type="text" name="srchByTrans" id="srchByTrans" value="<?php if(isset($srchByTrans)){ echo $srchByTrans;}?>" class="form-control" placeholder="Transaction ID" style="width: 98%;">
											</div>
											<div style="float: left; width: 13%;">
												<input type="text" name="srchByOrderID" id="srchByOrderID" value="<?php if(isset($srchByOrderID)){ echo $srchByOrderID;}?>" class="form-control" placeholder="Order ID" style="width: 98%;">
											</div>
											<div style="float: left; width: 14%;">
												<input type="text" name="srchByOrderDate" id="srchByOrderDate" value="<?php if(isset($srchByOrderDate)){ echo $srchByOrderDate;}?>" class="form-control" placeholder="Order Date" style="width: 98%;">
												<i class="fa fa-calendar" style="margin-top:-30px; margin-left: 82%; font-size: 18px;"></i>
											</div>
											<div style="float: left; width: 14%;">
												<input type="text" name="srchByClientName" id="srchByClientName" value="<?php if(isset($srchByClientName)){ echo $srchByClientName;}?>" class="form-control" placeholder="Client Name" style="width: 98%;">
											</div>
											<div style="float: left; width: 14%;">
												<select class="form-control" name="srchByOrder_status" id="srchByOrder_status" style="width:98%; border:1px solid #ccc; height: 34px;">
													<option value="">-- Order Status --</option>
													<?php
													for($yt=1;$yt<count($orderStatusArray);$yt++){
													?>
													<option value="<?php echo $yt;?>" <?php if(isset($srchByOrder_status) && ($yt==$srchByOrder_status)){ echo "selected";}?>>
														<?php echo $orderStatusArray[$yt];?>
													</option>
													<?php } ?>
												</select>
											</div>
											<div style="float: left; width: 16%;">
												
												<select class="form-control" name="srchByPayment_status" id="srchByPayment_status" style="width:98%; border:1px solid #ccc; height: 34px;">
													<option value="">-- Payment Status --</option>
													<option value="1" <?php if(isset($srchByPayment_status) && ($srchByPayment_status==1)){ echo "selected";}?>>
														Paid
													</option>
													<option value="2" <?php if(isset($srchByPayment_status) && ($srchByPayment_status==2)){ echo "selected";}?>>
														Pending
													</option>
												</select>
											</div>
											<div style="float: left; width: 8%; text-align: right;">
												<input type="submit" name="submit" value="Search"class="btn btn-primary ">
											</div>

											<div style="float: right; width: 7%; text-align: right;">
												<button type="button" name="cancel" class="btn btn-danger waves-effect waves-light" onclick="location.href='orders.php'">Clear
												</button>
											</div>
											
										</form>
									</div>
									<div style="clear: both; height: 10px;"></div>
									<?php
									$wh='';
									if(!empty($srchByTrans)) {
										$wh.=" and transactionID='$srchByTrans'";
									}
									if(!empty($srchByOrderID)) {
										$wh.=" and id='$srchByOrderID'";
									}
									if(!empty($srchByOrderDate)) {
										$srchByOrderDate=date('Y-m-d',strtotime($srchByOrderDate));
										$wh.=" and post_date='$srchByOrderDate'";
									}
									if(!empty($srchByClientName)) {
                                        $wh.=" and client_name like ('%$srchByClientName%')";
                                    }
									if(!empty($srchByOrder_status)) {
										$wh.=" and orderStatus='$srchByOrder_status'";
									}
									if(!empty($srchByPayment_status)) {
										$wh.=" and paymentStatus='$srchByPayment_status'";
									}

									$allOrderSql = mysqli_query($con,"SELECT * from `tbl_order_detail` where client_name!=''$wh");
									$allOrderNum=mysqli_num_rows($allOrderSql);
									?>
									<h4 class="m-t-0" style="background-color:red; color:#fff;padding:5px;font-size:12px">
										<b>All Orders</b>
										<b style="float: right;">
											<?php echo $allOrderNum;?>
										</b>
									</h4>
									
									<div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap4 no-footer">

										<div class="row">
											<div class="col-md-12">
												<table id="datatable" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable_info">
										<thead>
											<tr role="row">
												<th rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 2%;">#</th>
												<!-- <th id="del" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 40px;">
												<i class="fa fa-trash fa-2x"></i>
												</th> -->
												<th class="" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 10%;">TransactionID</th>
												<th class="" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 8%;">OrderID</th>
												<th class="" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 10%;">Amount</th>
												<th class="" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 20%;">User</th>
												<th class="" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 10%;">Pay. Status</th>
												<th class="" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 10%;">Method</th>
												<th class="" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 10%;">Date Time</th>
												<th class="" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 10%;">Order Status</th>
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

										$orderSql = mysqli_query($con,"SELECT * from `tbl_order_detail` where client_name!=''$wh order by $order_by $order_by2 limit $start,$pagesize");
										$reccnt=mysqli_num_rows(mysqli_query($con,"SELECT * from `tbl_order_detail` where client_name!=''$wh"));
											if($reccnt>0) {
												$amount=0;
											while($orderLine=mysqli_fetch_array($orderSql)) {

												$amount=$orderLine['finalAmount'];

												$clientNameSql=mysqli_query($con, "SELECT * from `clients` where cid='".$orderLine['clientID']."'");
												$clientNameLine=mysqli_fetch_array($clientNameSql);
										  ?>
											<tr role="row" class="odd">
												<td class="sorting_1" style="width: 2%;"><?php echo $i+$start; $i++; ?>.</td>
												
												<td style="width: 10%;">
													<?php echo $orderLine['transactionID'];?> 
												</td>
												<td style="width: 8%;">
													<?php echo $orderLine['id'];?>
												</td>
												<td style="width: 10%;">
													<?php echo number_format($amount,2,".",",");?>
												</td>
												<td style="width: 20%;">
													<?php echo $clientNameLine['fname'].' '.$clientNameLine['lname'];?>
												</td>
												<td style="width: 10%;">
													<?php if($orderLine['paymentStatus']==2){?>
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
												<td style="width: 10%; font-size: 12px;">
													<select name="order_status" id="order_status" class="updateStatusClass" dataid="<?php echo $orderLine['id'];?>" style="border:1px solid #ccc; height: 28px;">
														<?php
														for($y=1;$y<count($orderStatusArray);$y++){
														?>
														<option value="<?php echo $y;?>"<?php if($y==$orderLine['orderStatus']){ echo "selected";}?>>
															<?php echo $orderStatusArray[$y];?>
														</option>
														<?php } ?>
													</select>
												</td>
												<td style="width: 10%;">
													<a href="javascript:void(0)" title="Expand" onclick="_expand_order_dtls(<?php echo $orderLine['id'];?>)">
						                              <i class="fa fa-expand"></i> Expand
						                            </a>
						                            <?php if($orderLine['paymentStatus']==1){?>
						                            <br>
						                            <a href="order-invoice.php?oid=<?php echo base64_encode($orderLine['id']);?>" title="Invoice" style="color:green;" target="_blankdrcwq">
						                              <i class="fa fa-file-pdf-o"></i> Invoice
						                            </a>
						                        	<?php } ?>
												</td>
											</tr>
											<tr style="display: none;" id="order_dtls_<?php echo $orderLine['id']?>">
					                          <td colspan="10">
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
											<td colspan="10" style="height: 20px;">
												<?php include("core/paging.inc.php");?>
											</td>
										</tr>
										<?php } else {?>
										<tr>
											<td colspan="10" style="height: 20px;">
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
                <div class="nicescroll">
                    <ul class="nav nav-tabs text-xs-center">
                        <li class="nav-item">
                            <a href="#home-2" class="nav-link active" data-toggle="tab" aria-expanded="false">Activity</a>
                        </li>
                        <li class="nav-item">
                            <a href="#messages-2" class="nav-link" data-toggle="tab" aria-expanded="true"> 
Settings 
</a>
                        </li>
                    </ul>
                </div>
				
	<script src="assets/js/jquery.min.js" type="text/javascript"></script>

	<script type="text/javascript">

		/*This script is used for update order status, start here*/
		$('.updateStatusClass').on('change', function(){
			
			var dst_id = confirm("Are you sure, you want to change status?");

			if(dst_id==1) {
				var status_id=$(this).val();
				var order_id = $(this).attr('dataid');
				
				$.ajax({
					method: 'POST',
					url: 'update_order_status.php',
					data: 'order_id='+order_id+'&status_id='+status_id,
					success : function(data) {
						//alert('Updated');
					}
				});
			}
		});
		/*This script is used for update order status, start here*/
</script> 			

	<script>
          $("#del").click(function(){
            var d = confirm("Are you sure you want to delete this enquiry ?")
            var data = $("input:checked").serialize();
            if(d == 1){ // alert(data);
            $.ajax({
              type:"post",
              url:"delete.php",
              data:data+"&table=enquiry",
              success:function(data1){
                //window.location.href =window.location.href;
				location.reload();
              }
            });}
          });
          $(":checkbox").click(function(){
          if($("input:checked").length > 0){
            $("#del").css("color","red");
            $("#del").css("cursor","pointer");
          }else{
            $("#del").css("color","#333939");
            $("#del").css("cursor","auto");
          }
        });
      </script>
			
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

        <!-- js and css for datepicker, start here -->
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="/resources/demos/style.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script>
			$( function() {
				$("#srchByOrderDate").datepicker();				
			} );
		</script>

		<script>
			function _expand_order_dtls(tdl) {        
		        $('#order_dtls_'+tdl).toggle();
		    }
		</script>
		
    </body>

    </html>