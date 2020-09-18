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
        <title><?php echo ADMIN_TITLE;?> | Staff</title>

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
	
	
	<script type="text/javascript">				
		function readURL(input) {		
			if (input.files && input.files[0]) {	
				var reader = new FileReader();	
				reader.onload = function (e) {	
					$('#test').show();	
					$('#test').attr('src', e.target.result);	
				}	
				reader.readAsDataURL(input.files[0]);						
			}						
		}
	</script>

	<script type="text/javascript">
	
		$(document).ready(function() {
			
			$("#a").change(function() {
				$("#image-error").text("");
				var filePath=$('#a').val();
				var size=$("#a")[0].files[0].size;
				var t=0;var s=0;var n=0;
				var fileUpload = $("#a")[0];
				var type=this.files[0].type;
				var imgwidth = $(this).width();
				var imgheight = $(this).height();
				var maxwidth = 300;
				var maxheight = 300;
				var ValidImageTypes = ["image/jpeg", "image/png"];
				if ($.inArray(type, ValidImageTypes) < 0) {
					$("#image-error").text("* Image should be in JPG/PNG format");
					t=1;
				}
				if(size>512000 && t==0) {
					$("#image-error").text("* Image size should be less than 500 KB");
					s=1;
				}
				if(s==0 && t==0) {
					$("#final-submit").css("background-color", "green");
					$("#final-submit").removeAttr('disabled'); 
				    $("#test").attr("src",filePath);
				} else{
					$("#img-hide").css("display","none");
				}
			});
		});
	
	</script>

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
                                    <h4 class="page-title">Staff</h4>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div> 
					<div class="row" style="display:"> 
						<div class="col-xs-12 col-md-10 col-md-offset-1">
						<form role="form" method="post" action="control/staff.php" enctype="multipart/form-data" onsubmit="return _validateFrm()">
							<div class="card-box">
								<h4 class="header-title m-t-0">Add Staff</h4>
								<div style="background-color:#ff5d48; color:#fff; padding:5px; border-radius:0px">Instructions  <i class="fa fa-arrow-down"></i></div>
									<div style="background-color:#ededed; color:#000; padding:5px; border-radius:0px; font-size:12px;border:1px solid #ff5d48">
									*Image should be in JPEG/PNG format <br> *Size should be less than 500 KB

									</div>
								<div class="p-20">
									<div class="form-group clearfix" style="border: 1px solid #ccc; border-radius:4px; padding: 5px;">
										<div style="float:left; width:50%;">
											<label>Select Image</label>
											<label for="a" class="ace-file-input">
											<span class="ace-file-container" data-title="Choose">
												<span class="ace-file-name" data-title="No File ...">
												<i class=" ace-icon fa fa-upload" style="font-size: 100px; cursor: pointer;"></i>
												</span><i class="fa fa-arrow-left" aria-hidden="true"> Click here to upload</i>
											</span>
										</div>
										<div style="float:right; width:50%; text-align: center;">
											<input onchange="readURL(this);" type="file" id="a" style="display:none;" name="image"/>
											<div id="img-hide">
												<img alt="Image Display Here" id="test"  style="display:none;height:90px;width:90px;"/>
											</div>
											<div id="image-error" style="color:red;background-color:#ededed"></div>
										</div>
									</div>

									<div style="float: left; width: 100%;">
										<div class="form-group" style="float: left; width: 49%;">
											<label>Name</label>
											<input type="text" name="name" id="name" class="form-control"  placeholder="Type Name" data-parsley-id="34" maxlength="50" onkeypress="return _isAlphabetKey(event)">
											<span class="errorMsg" id="nameError"></span>
										</div>
										<div class="form-group" style="float: right; width: 49%;">
											<label>E-mail</label>
											<input type="text" name="email" id="email" class="form-control"  placeholder="Type E-mail" data-parsley-id="34" maxlength="50">
											<span class="errorMsg" id="emailError"></span>
										</div>
									</div>

									<div style="float: left; width: 100%;">
										<div class="form-group" style="float: left; width: 49%;">
											<label>Phone</label>
											<input type="text" name="phone" id="phone" class="form-control"  placeholder="Type Phone No." data-parsley-id="34" maxlength="10" onkeypress="return _isNumberKey(event)">
											<span class="errorMsg" id="phoneError"></span>
										</div>
										<div class="form-group" style="float: right; width: 49%;">
											<label>Address</label>
											<textarea name="address" id="address" class="form-control"></textarea>
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

			function _validateFrm() {
				//alert('hii');
				var name=document.getElementById('name').value;
				var maill=document.getElementById('email').value;
				var phone=document.getElementById('phone').value;

				name=name.trim();
				maill=maill.trim();
				phone=phone.trim();

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

			  $("#del").click(function(){
				var d = confirm("Are you sure you want to delete this row ?")
				var data = $("input:checked").serialize();
				if(d == 1){ // alert(data);
				$.ajax({
				  type:"post",
				  url:"delete.php",
				  data:data+"&table=staff",
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