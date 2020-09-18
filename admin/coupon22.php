<?php
session_start(); 
include 'core/core.php';
include 'core/other-script.php';
@extract($_REQUEST);

if(!isset($_SESSION['login_id'])) {
?>
	<script>
		window.location = "login/index.php";
	</script>
<?php
}

if(isset($pid)) {
	$prodID=base64_decode($pid);
	$couponSql=mysqli_query($con, "SELECT * from `tbl_coupon` where cid='".$prodID."'");
	$couponLine=mysqli_fetch_array($couponSql);
}
?>
<!DOCTYPE html>
<html> 
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App title -->
        <title><?php echo ADMIN_TITLE;?> | Coupon</title>

        <!-- Switchery css -->
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		
		<!-- Jquery filer css -->
        <link href="assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
       <link href="assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" /> 
        <!-- Modernizr js --> 
        <script src="assets/js/modernizr.min.js"></script> 
		
	<script src="//cdn.ckeditor.com/4.5.10/standard/ckeditor.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    </head> 
    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            <?php include 'include/header.php';?>
            <?php include "include/sidebar.php";?>
            <!-- Left Sidebar End --> 
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container"> 
                        <div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <h4 class="page-title">Coupon</h4> 
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div> 
					<div class="row" style="display:"> 
						<div class="col-xs-12 col-md-8 col-md-offset-2">
						<form role="form" method="post" action="control/coupon.php" enctype="multipart/form-data" onsubmit="return _validateFrm()">
							<input type="hidden" name="editID" value="<?php if(isset($couponLine['cid'])) {echo $couponLine['cid'];}?>">
							<div class="card-box">
								<h4 class="header-title m-t-0">Add Coupon</h4>
								<div class="p-20">
									<div class="form-group">
										<label>Coupon Title</label>
										<input type="text" name="title" id="title" class="form-control" value="<?php if(isset($couponLine['title'])) { echo $couponLine['title'];}?>" placeholder="Type Title" maxlength="50">
									</div>

									<div class="form-group">
										<label>Coupon Code</label>
										<input type="text" name="couponCode" id="couponCode" class="form-control" value="<?php if(isset($couponLine['couponCode'])) { echo $couponLine['couponCode'];}?>" placeholder="Type Coupon Code" maxlength="15" style="text-transform: uppercase;">
									</div>

									<div style="float: left; width: 100%;">
										<div class="form-group" style="float: left; width: 49%;">
											<label>Start Date</label>
											<input type="text" name="startDate" id="startDate" class="form-control" value="<?php if(isset($couponLine['startDate'])) { echo $couponLine['startDate'];}?>" placeholder="Start Date" autocomplete="off">
                                            <i class="fa fa-calendar" style="margin-top:-27px; margin-left: 92%;"></i>
										</div>
										<div class="form-group" style="float: right; width: 49%;">
											<label>End Date</label>
											<input type="text" name="endDate" id="endDate" class="form-control" value="<?php if(isset($couponLine['endDate'])) { echo $couponLine['endDate'];}?>" placeholder="End Date" autocomplete="off">
                                            <i class="fa fa-calendar" style="margin-top:-27px; margin-left: 92%;"></i>
										</div>
									</div>

									<div style="float: left; width: 100%;">
										<div class="form-group" style="float: left; width: 49%;">
                                            <label>Discount Type</label>
                                            <select name="discountType" id="discountType" class="form-control" onchange="_validateDiscount()">
                                                <option value="1">Fixed</option>
                                                <option value="2">In %</option>
                                            </select>
                                        </div>
                                        <div class="form-group" style="float: right; width: 49%;">
											<label>Discount Amount</label>
											<input type="text" name="discountAmount" id="discountAmount" class="form-control" value="<?php if(isset($couponLine['discountAmount'])) { echo $couponLine['discountAmount'];}?>" placeholder="Discount Amount"  maxlength="7" onkeypress="return _isAmountKey(event)" onblur="_validateDiscount()">
										</div>
										
									</div>

									<div class="clearfix"></div>
									
									<button type="submit" name="submit" class="btn btn-primary waves-effect waves-light" id="final-submit">
										<span class="btn-label"><i class="fa fa-check"></i>
										</span>Submit
									</button>
								</div>
                                <!-- end row -->
                        	</div>
							</form>
                        </div>
					</div>
                    </div> <!-- container --> 
                </div> <!-- content --> 
            </div>  
            <footer class="footer text-right">
              2018 &copy; IT Globaliser Noida
            </footer> 
        </div> 
        <script>
            var resizefunc = [];
        </script> 
        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/tether.min.js"></script><!-- Tether for Bootstrap -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/plugins/switchery/switchery.min.js"></script>
		<!-- Jquery filer js -->
        <script src="assets/plugins/jquery.filer/js/jquery.filer.min.js"></script>
		<!-- page specific js -->
        <script src="assets/pages/jquery.fileuploads.init.js"></script>
        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
		<script src="assets/js/jquery.min.js" type="text/javascript"></script>
         
        <!-- js and css for datepicker, start here -->
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="/resources/demos/style.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script>
			$( function() {
				$("#startDate").datepicker();
				$("#endDate").datepicker();
			} );
		</script>
  <!-- js and css for datepicker, end here -->

		<script type="text/javascript">
			function _validateDiscount(){
				
				var disTy=$('#discountType').val();
					
				if(disTy==2) {
					var disAmnt=parseFloat($('#discountAmount').val());

					if(disAmnt>100){
						alert("Discount can't be greater than 100%.");
						$('#discountAmount').val('');
					}
				}
			}


			function _validateFrm() {
                
                var title=document.getElementById('title').value;
                var couponCode=document.getElementById('couponCode').value;
                var startDate=document.getElementById('startDate').value;
                var endDate=document.getElementById('endDate').value;
                var discountAmount=document.getElementById('discountAmount').value;
                
                title=title.trim();
                couponCode=couponCode.trim();
                startDate=startDate.trim();
                endDate=endDate.trim();
                discountAmount=discountAmount.trim();
                
                if(title == "" || title == null) {
                    document.getElementById("title").style.borderColor = "red";
                    document.getElementById("title").placeholder = "*Coupon Title is required..";
                    //document.getElementById("name").innerHTML="*Name is required";
                }  else {
                    document.getElementById("title").style.borderColor = "green";
                    document.getElementById("title").placeholder = "";
                }

                if(couponCode == "" || couponCode == null) {
                    document.getElementById("couponCode").style.borderColor = "red";
                    document.getElementById("couponCode").placeholder = "*Coupon Code is required..";
                }  else {
                    document.getElementById("couponCode").style.borderColor = "green";
                    document.getElementById("couponCode").placeholder = "";
                }
                
                if(startDate == "" || startDate == null) {
                    document.getElementById("startDate").style.borderColor = "red";
                    document.getElementById("startDate").placeholder = "*Start Date is required..";
                }  else {
                    document.getElementById("startDate").style.borderColor = "green";
                    document.getElementById("startDate").placeholder = "";
                }
                
                if(endDate == "" || endDate == null) {
                    document.getElementById("endDate").style.borderColor = "red";
                    document.getElementById("endDate").innerHTML = "*End Date is required..";
                } else {
                    document.getElementById("endDate").style.borderColor = "green";
                    document.getElementById("endDate").innerHTML = "";
                }

                if(discountAmount == "" || discountAmount == null) {
                    document.getElementById("discountAmount").style.borderColor = "red";
                    document.getElementById("discountAmount").innerHTML = "*Discount Amount is required..";
                } else {
                    document.getElementById("discountAmount").style.borderColor = "green";
                    document.getElementById("discountAmount").innerHTML = "";
                }
                
                if(title == "" || title == null || couponCode == "" || couponCode == null || startDate == "" || startDate == null || endDate == "" || endDate == null || discountAmount == "" || discountAmount == null) {
                    
                    return false;
                } 
            }
		</script>
    </body> 
</html>