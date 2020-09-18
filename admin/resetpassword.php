<?php 
include 'core/core.php';
include 'core/other-script.php';
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
        <title><?php echo ADMIN_TITLE;?> | Change Password</title>

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
    </head>

    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            <?php include 'include/header.php';?>
            <?php include "include/sidebar.php";?>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <h4 class="page-title">Update Password</h4> 
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->
					
					<div class="row">
					
					
						<div class="col-xs-12 col-md-8 col-md-offset-2">
						<form role="form" method="POST" enctype="multipart/form-data" action="control/reset.php" id="reset-pass">
							<div class="card-box">
								 
									 
										<h4 class="header-title m-t-0">Update Password</h4>
										<div class="p-20">
										 
											<div class="form-group">
												<label>Current Password</label>
												<input type="text" class="form-control" id="old-pass" required="" placeholder="Type old password" name="cpass" data-parsley-id="34">
												<label style="display:none; color:red" id="old-passt">Mandatory Field</label>
											</div>
											<div class="form-group">
												<label>New Password</label>
												<input type="password" class="form-control" id="password" required="" placeholder="Type Password" name="npass" data-parsley-id="34">
											</div>
											<div class="form-group">
												<label>Confirm Password</label>
												<input type="password" class="form-control" id="confirm_password" required="" placeholder="Type Password" name="confe" data-parsley-id="34"><span id='message'></span>
												
												<label style="display:none; color:red" id="non-pass"></label>
											</div> 
											<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
											 <script> 
											  $(document).ready(function(){
												  
												  
											    $("#reset-pass").submit(function(e){
													$("#old-passt").slideUp(500);
													$("#non-pass").slideUp(500);
													 var n=$.trim($("#old-pass").val());
													 //alert(n);
													  if(n==''){
														  $("#old-passt").slideDown(500);
														  e.preventDefault();
													  }
													  var p1=$.trim($("#password").val());
													  var p2=$.trim($("#confirm_password").val());
													  if(p1=='' ||  p2=='')
													  { 
														   $("#non-pass").slideDown(500);
														   $("#non-pass").text("Enter new password");
														  e.preventDefault(); 
														  
													  }
													  
													  
													  if (p1!=p2) {
														  
														  $("#non-pass").slideDown(500);
														   $("#non-pass").text("Password Mismatch");
														  e.preventDefault();
														
													} 
													});
													  
													  
											  });
											  
											
												  
												  </script>
												  
											
											
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
						
						<script src="assets/js/jquery.min.js" type="text/javascript"></script>
						<script type="text/javascript">
						
$('.jagdish input').change(function(e){
	
if($(this).prop("checked") == true){
	var status=1;
	var v = $(this).attr('datano');
	
	 $.ajax({
		type: "GET",
		data: "update="+v+"&status="+status,
		url: "update.php",
		//data: "update="+v+"&status="+status,
		success: function(data)
		{
			location.reload();		
		}
	});
	

}
else if($(this).prop("checked") == false){
	var status=0;
	var v = $(this).attr('datano');
	
 $.ajax({
		type: "GET",
		data: "update="+v+"&status="+status,
		url: "update.php",
		//data: "update="+v+"&status="+status,
		success: function(data)
		{
			location.reload();
		}
	}); 
}	
});
</script>
						
<script>
          $("#del").click(function(){
            var d = confirm("Are you sure you want to delete this row ?")
            var data = $("input:checked").serialize();
            if(d == 1){ // alert(data);
            $.ajax({
              type:"post",
              url:"delete.php",
              data:data+"&table=contact",
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
		<!-- Jquery filer js -->
        <script src="assets/plugins/jquery.filer/js/jquery.filer.min.js"></script>
		<!-- page specific js -->
        <script src="assets/pages/jquery.fileuploads.init.js"></script>
        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>

</html>