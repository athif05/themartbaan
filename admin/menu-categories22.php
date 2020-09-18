<?php 
include 'core/core.php';
session_start();
if(!isset($_SESSION['login_id']))
	{
		?>
		<script>
		window.location = "login/index.php";
		</script>
		<?php
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
        <title><?php echo ADMIN_TITLE;?> | Menu Categories</title> 

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="assets/plugins/morris/morris.css">
		
		<!--ALERT-->
		 <link href="assets/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css" />

		
        <!-- Switchery css -->
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <script src="assets/js/modernizr.min.js"></script>

		<style type="text/css">
		
	.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #f4511e;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 15px;
  padding: 5px;
  width: 150px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
  
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}	
.button:hover{
	 background-color:#64b0f2;
	 color:#000;
}

.error{ color: red; }	
	
		</style>
		
		
		
		
		
<script src="//cdn.ckeditor.com/4.5.10/standard/ckeditor.js"></script>
    </head> 
    <body class="fixed-left"> 
        <!-- Begin page -->
        <div id="wrapper">
<div id="myToast" class="toast-popup"></div>
            <!-- Top Bar Start -->
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
                                    <h4 class="page-title">Menu Categories</h4> 
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->

			
                       <div class="row" >					
						<div class="col-sm-10 col-sm-offset-1">
						<form name="carFrm" method="post" action="control/menu-categories.php" onsubmit="return _validate_frm()">
                                <div class="card-box">
                                    
									<div class="col-xs-12 col-sm-12">
										<div class="p-20"> 
											<div class="form-group">
												<label class="control-label">Categories</label>
												<br>
												<?php

												$catsSql=mysqli_query($con, "SELECT * from `menu_categories`");
												$catsLine=mysqli_fetch_array($catsSql);
												if($catsLine['categoriesId']){
													$categories_id=explode(',',$catsLine['categoriesId']);
												}
												
												$catSql=mysqli_query($con,"SELECT * from `tbl_category` where parentCategory=0 and subParentCategory=0");
												while($catLine=mysqli_fetch_array($catSql)) {
												?>
												<input type="checkbox" id="menu_id" name="menus[]" value="<?php echo $catLine['cid'];?>" class="serviceClass" <?php if(in_array($catLine['cid'], $categories_id)){ echo "checked";}?>> <?php echo $catLine['name'];?> &nbsp;  &nbsp;
												<?php } ?>
												<span class="error" id="serviceClassError"></span>
											</div>
											  
											<input type="submit" name="submit" value="Submit"  class="button" id="final-submit" style="cursor: pointer;">
											   
										</div>
									</div> 
                        		</div>
                            </div>
					</div>
					</form>
					
					
					
						<script src="assets/js/jquery.min.js" type="text/javascript"></script>
						
                    </div> <!-- container --> 
                </div> <!-- content --> 
            </div> 
            <footer class="footer text-right">
                2018 &copy; IT Globaliser Noida
            </footer> 
        </div>
        <!-- END wrapper -->
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

        <!--Morris Chart-->
		<script src="assets/plugins/morris/morris.min.js"></script>
		<script src="assets/plugins/raphael/raphael-min.js"></script>

        <!-- Counter Up  -->
        <script src="assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
        <script src="assets/plugins/counterup/jquery.counterup.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <!-- Page specific js -->
        <script src="assets/pages/jquery.dashboard.js"></script>
		 <script src="assets/plugins/toastr/toastr.min.js"></script>
		<script>

			function _validate_frm() {
				
				var vl=$('.serviceClass:checked').length;
                
                if(vl == '' || vl == null || vl==0) {
                    document.getElementById("serviceClassError").innerHTML="*Select atleast one service.";
                } else {
                    document.getElementById("serviceClassError").innerHTML="";
                }

                if(vl == '' || vl == null || vl==0) {
                    return false;
                }

			}

			  $("#del").click(function(){
				var d = confirm("Are you sure you want to delete this row ?")
				var data = $("input:checked").serialize();
				if(d == 1){ // alert(data);
				$.ajax({
				  type:"post",
				  url:"delete.php",
				  data:data+"&table=home_about",
				  success:function(data1){
					window.location.href =window.location.href;
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
    </body> 
</html>