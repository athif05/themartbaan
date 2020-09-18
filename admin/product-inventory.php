<?php
session_start(); 
require_once 'core/core.php';
require_once 'core/other-script.php';

@extract($_REQUEST);

if(!isset($_SESSION['login_id'])) {
?>
	<script>
		window.location = "login/index.php";
	</script>
<?php
}
if(isset($prod_id)) {
	$prod_id=base64_decode($prod_id);
	$productSql=mysqli_query($con, "SELECT * from `tbl_product` where cid='$prod_id'");
	$productLine=mysqli_fetch_array($productSql);
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
        <link rel="shortcut icon" href="assets/images/favicon.png">

        <!-- App title -->
        <title><?php echo ADMIN_TITLE;?> || Product Inventory</title>

        <!-- Switchery css -->
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		
		<!-- Jquery filer css -->
        <link href="assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
       <link href="assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" /> 
        <!-- Modernizr js --> 
        <script src="assets/js/modernizr.min.js"></script> 
		<script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','../../www.google-analytics.com/analytics.js','ga'); 
          ga('create', 'UA-79190402-1', 'auto');
          ga('send', 'pageview'); 
        </script>
		<script src="//cdn.ckeditor.com/4.5.10/standard/ckeditor.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    </head> 
    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            <?php include "include/sidebar.php";?>
            <!-- Left Sidebar End --> 
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container"> 
                        <div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <h4 class="page-title">Product Inventory</h4> 
									
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div> 
					<div class="row" style="display:"> 
						<div class="col-xs-12 col-md-10 col-md-offset-1">
						<form role="form" method="post" action="control/product-inventory.php" enctype="multipart/form-data">
							<input type="hidden" name="prod_id" value="<?php echo $prod_id;?>">
							<input type="hidden" name="edit" value="<?php if(isset($edit)){ echo $edit;} ?>">
							
							<div class="card-box">
								<h4 class="header-title m-t-0">
									<?php echo $productLine['title'];?>
								</h4>
																	
								<div class="p-20">
									<div style="float: left; width: 100%;">
										
										<div style="float: left; width: 40%;">
											<?php
											$mainAttrType=$productLine['mainAttrType'];
											$mainAttr_type=explode(',',$mainAttrType);
											$no_of_attr=count($mainAttr_type);
											$wdth=100/$no_of_attr;
											?>
											<?php
											for($j=0;$j<$no_of_attr;$j++) {
											?>
											<div class="form-group" style="float: left; width: <?php echo $wdth;?>%;">
												<label><?php echo $mainAttr_type[$j];?></label>
											</div>
											<?php } ?>
										</div>
										
										<div class="form-group" style="float: left; width: 20%; text-align: center;">
											<label>Current Price</label>
										</div>
										<div class="form-group" style="float: left; width: 20%; text-align: center;">
											<label>Discount Price</label>
										</div>
										<div class="form-group" style="float: right; width: 20%; text-align: center;">
											<label>Inventory</label>
										</div>
									</div>
										
									<?php
									$mainAttrType2=$productLine['nameOfAttr'];
									$mainAttr_type2=explode(',',$mainAttrType2);
									$no_of_attr2=count($mainAttr_type2);
									for($l=0;$l<$no_of_attr;$l++) {

										for($u=0;$u<$no_of_attr2;$u++){
									?>
									<div style="float: left; width: 100%;">
										
										<div style="float: left; width: 40%;">
											<?php
											for($j=0;$j<$no_of_attr;$j++) {
												$attrName=$mainAttr_type2[$u];

												$mainAttr_type_name=explode('_',$attrName);

												if($mainAttr_type_name[1]==$mainAttr_type[$j]) {
												

												$invSql=mysqli_query($con, "SELECT * from `tbl_product_inventory` where prod_id='".$prod_id."' and attributeNameId='".$mainAttr_type_name[0]."'");
												$invLine=mysqli_fetch_array($invSql);

												$attrValueSql=mysqli_query($con,"SELECT * from `tbl_attribute` where cid='".$mainAttr_type_name[0]."'");
												$attrValueLine=mysqli_fetch_array($attrValueSql);
											?>
											<input type="hidden" name="attributeNameId[]" value="<?php echo $attrValueLine['cid'];?>">
											<div class="form-group" style="float: left; width: <?php echo $wdth;?>%;">
												<label><?php echo $attrValueLine['attr_value'];?></label>
											</div>
											<?php } } ?>
										</div>

										
										<div class="form-group" style="float: left; width: 20%;">
											<!-- <label>Current Price</label> -->
											<input type="text" name="currentPrice[]" class="form-control" placeholder="Current Price" style="width: 95%;" maxlength="6" onkeypress="return _isAmountKey(event)" value="<?php if(isset($invLine['currentPrice'])){ echo $invLine['currentPrice'];}?>">
										</div>
										<div class="form-group" style="float: left; width: 20%;">
											<!-- <label>Discount Price</label> -->
											<input type="text" name="discountPrice[]" class="form-control" placeholder="Discount Price" style="width: 95%;" maxlength="6" onkeypress="return _isAmountKey(event)" value="<?php if(isset($invLine['discountPrice'])){ echo $invLine['discountPrice'];}?>">
										</div>
										<div class="form-group" style="float: right; width: 20%;">
											<!-- <label>Inventory</label> -->
											<input type="text" name="inventory[]" class="form-control" placeholder="Inventory" maxlength="4" onkeypress="return _isNumberKey(event)" value="<?php if(isset($invLine['inventory'])){ echo $invLine['inventory'];}?>">
										</div>
									</div>
									<?php } } ?>

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
    </body> 
</html>