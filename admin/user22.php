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

$staff_idd=0;
$role_id=0;
if(isset($uid)) {
	$sql=mysqli_query($con,"SELECT * from `user` where cid='$uid'");
	$line=mysqli_fetch_array($sql);
	
	$staff_idd=$line['staffId'];
	$role_id=$line['roleId'];
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
        <title><?php echo ADMIN_TITLE;?> | User</title>

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
            <?php include "include/sidebar.php";?>
            <!-- Left Sidebar End --> 
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container"> 
                        <div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <h4 class="page-title">User</h4>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div> 
					<div class="row" style="display:"> 
						<div class="col-xs-12 col-md-10 col-md-offset-1">
						<form role="form" method="post" action="control/user.php" enctype="multipart/form-data">
							<input type="hidden" name="editID" value="<?php echo isset($uid);?>">
							<div class="card-box">
								<h4 class="header-title m-t-0">Add User</h4>
								
								<div class="p-20">
								
									<div style="float: left; width: 100%;">
										<div class="form-group" style="float: left; width: 49%;">
											<label>Staff Name</label>
											<select class="form-control" required name="staffId" id="staffId">
												<option value="">
													-- Staff Name --
												</option>
												<?php
												$staffSql=mysqli_query($con, "SELECT cid,name from `staff` where status=1");
												while($staffLine=mysqli_fetch_array($staffSql)) {
												?>
												<option value="<?php echo $staffLine['cid'];?>" <?php if($staffLine['cid']==$staff_idd){ echo "selected";}?>>
													<?php echo ucwords($staffLine['name']);?>
												</option>
												<?php } ?>
											</select>
										</div>
										<div class="form-group" style="float: right; width: 49%;">
											<label>Role</label>
											<select class="form-control" required name="roleId">
												<option value="">
													-- Select Role --
												</option>
												<?php
												$roleSql=mysqli_query($con, "SELECT cid,name from `role` where status=1");
												while($roleLine=mysqli_fetch_array($roleSql)) {
												?>
												<option value="<?php echo $roleLine['cid'];?>" <?php if($roleLine['cid']==$role_id){ echo "selected";}?>>
													<?php echo ucwords($roleLine['name']);?>
												</option>
												<?php } ?>
											</select>
										</div>
									</div>

									<div style="float: left; width: 100%;">
										<div class="form-group" style="float: left; width: 49%;">
											<label>User Name</label>
											<input type="text" name="userName" id="userName" class="form-control" placeholder="User Name" value="<?php if(isset($line['userName'])) {echo $line['userName'];}?>" readonly>
											<span class="errorMsg" id="phoneError"></span>
										</div>
										<div class="form-group" style="float: right; width: 49%;">
											<label>Password</label>
											<input type="password" name="password" id="password" class="form-control" placeholder="Type Password" maxlength="20" value="<?php if(isset($line['password'])) { echo $line['password'];} ?>">
										</div>
									</div>


									<button type="submit" name="submit" class="btn btn-primary waves-effect waves-light">
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

		<script>

			/*category ajax, start here*/
			$('#staffId').on('change', function() {
				
				var staff_ID = $("#staffId").val();

				$.ajax({
					type:"post",
					url:"staff-ajax.php",
					data:"staff_ID="+staff_ID,
					success:function(data1) {
						var nm=data1.split('`');
						$('#userName').val(nm[1]);
					}
				});
			});
			/*category ajax, end here*/

			function _validateFrm() {
				//alert('hii');
				var name=document.getElementById('name').value;
				var maill=document.getElementById('email').value;
				var phone=document.getElementById('phone').value;

				name=name.trim();
				maill=maill.trim();
				phone=phone.trim();

				alert(name);
				alert(maill);
				alert(phone);

				if(name == "" || name == null) {
		            document.getElementById("nameError").innerHTML="*Name is required";
		        }  else {
		            document.getElementById("nameError").innerHTML="";
		        }

		        if(maill) {
		            var ml=_mail_validate(maill);

		            if(ml==2){
		                document.getElementById("emailError").innerHTML="*Invalid E-mail address";
		            } else {
		                document.getElementById("emailError").innerHTML="";
		            }
		        } else {
		            document.getElementById("emailError").innerHTML="* E-mail is required";
		        }
		        
		        if(phone == "" || phone == null) {
		            document.getElementById("phoneError").innerHTML="*Phone is required";
		        }  else {
		            document.getElementById("phoneError").innerHTML="";
		        }

		        if(name == "" || name == null || maill == "" || maill == null || ml==2 || phone == "" || phone == null) {
		            return false;
		        }
			}
		  </script>
    </body> 
</html>