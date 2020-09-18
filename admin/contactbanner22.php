<?php session_start();
if(!isset($_SESSION['login_id']))
	{
		?>
		<script>
		window.location = "login/index.php";
		</script>
		<?php
	}
include 'core/core.php';
include 'core/other-script.php';
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
        <title><?php echo ADMIN_TITLE;?> | Contact Banner</title>

        <!-- Switchery css -->
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		
		<!-- Jquery filer css -->
        <link href="assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
        <link href="assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" /> 
        <!-- Modernizr js -->
        <script src="assets/js/modernizr.min.js"></script> 
		
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
	
$(document).ready(function(){
	
	      $("#a").change(function() {
			  
		  $("#image-error").text("");
		  var filePath=$('#a').val();

		  var size=$("#a")[0].files[0].size;
		  
		  var t=0;var s=0;
		  var fileUpload = $("#a")[0];
		  var type=this.files[0].type;
		  var imgwidth = $(this).width();
		  var imgheight = $(this).height();
		
		  var maxwidth = 300;
		  var maxheight = 300;
		 var ValidImageTypes = ["image/gif", "image/jpeg", "image/png"];
         if ($.inArray(type, ValidImageTypes) < 0) {
			$("#image-error").text("* Banner should be in JPG/PNG/GIF format");
			t=1; 
		 }
		if(size>8000000 && t==0){ 
			$("#image-error").text("* Banner size should be less than 1 MB");
			s=1;
		}
		
		if(s==0 && t==0){
			$("#final-submit").css("background-color", "green");
		    $("#final-submit").removeAttr('disabled'); 
			 
			$("#test").attr("src",filePath);
		}
		else{
			$("#img-hide").css("display","none");
		}
         
    });
	
	$("#update-btn").click(function(){
			$("#edit-down").slideDown("9000");
	});
    });
</script>
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
                                    <h4 class="page-title">Banner</h4>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->
					
					<div class="row">
	
	<div class="col-xs-12 col-md-7">
<div class="card-box table-responsive">
<h4 class="m-t-0 header-title"><b>Contact Banner</b></h4>
<div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap4 no-footer">
<div class="row"><div class="col-md-12"><table id="datatable" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable_info">
<thead>
<tr role="row">
<th rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 30px;">S.No</th>

<th class="" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 340px;">Image</th>
<th class="" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 290px;">Action</th>
</tr>
</thead>
<tbody>
<?php
$i=1;                     
$res = mysqli_query($con,"SELECT * FROM contactbanner where cid='1'");
$x = mysqli_fetch_assoc($res);
?>
<tr role="row" class="odd">
<td class="">1</td>

<td><img src="control/<?php echo $x["image"]; ?>" style="height:100px; width:100px;" /></td>
<td class="jagdish">  

<!--<input  type="checkbox" name="switch-field-1" data-plugin="switchery" data-color="#1bb99a" data-secondary-color="#ff5d48" data-switchery="true" <?php if($x["status"]==1){echo 'checked'; } ?> id="checkstatus" ajay="123" datano="<?php echo $x["cid"];?>">
-->
<div id="update-btn" style="position:relative; top:40px"><a href="#" style="background-color:red; padding:10px 20px; color:#fff">Update</a></div>
</td>
</tr>
</tbody>
</table></div></div></div>
</div>
</div>
						
						
											<div class="col-xs-12 col-md-4" style="display:none" id="edit-down">
							<div class="card-box">
								<div class="row">
									<div class="col-xs-12 col-sm-12">
										<div class="p-20">
											<form method="POST" action="control/contactbanner.php" enctype="multipart/form-data">
												<div class="form-group clearfix">
												
							<div style="background-color:#ff5d48; color:#fff; padding:5px; border-radius:0px">Instructions  <i class="fa fa-arrow-down"></i></div>
<div style="background-color:#ededed; color:#000; padding:5px; border-radius:0px; font-size:12px;border:1px solid #ff5d48">
*Banner should be in JPEG/PNG format <br> *Size should be less than 1 MB

</div>											
													<label>Select Image</label>
													<div class="col-sm-12 row">
													<label for="a" class="ace-file-input">
													<span class="ace-file-container" data-title="Choose">
														<span class="ace-file-name" data-title="No File ...">
														<i class=" ace-icon fa fa-upload" style="font-size: 100px; cursor: pointer;"></i>
														</span><i class="fa fa-arrow-left" style="margin-left: 0px;" aria-hidden="true"> Click here to upload</i>
													</span>
													
												<input onchange="readURL(this);" type="file" id="a"  style="display:none;" name="file"/>
<div id="img-hide"><img alt="Logo Display Here" id="test"  style="display:none;height:150px;width:150px;"/></div>
<div id="image-error" style="color:red;background-color:#ededed"></div>
													
													</div>
												</div>
												<button type="submit" name="submit" class="btn btn-primary waves-effect waves-light" id="final-submit" disabled>
													   <span class="btn-label"><i class="fa fa-check"></i>
													   </span>Submit
												</button>
											</form>
										</div>
									</div>
                                </div>
                                <!-- end row -->
                        	</div>
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
		data: "update="+v+"&status="+status+"&table=contactbanner",
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
		data: "update="+v+"&status="+status+"&table=contactbanner",
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
                    </div> <!-- container -->

                </div> <!-- content -->

            </div>
            <!-- End content-page -->

            <footer class="footer text-right">
                2016 &copy; IT Globaliser.
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
		<script>
			  $("#del").click(function(){
				var d = confirm("Are you sure you want to delete this row ?")
				var data = $("input:checked").serialize();
				if(d == 1){ // alert(data);
				$.ajax({
				  type:"post",
				  url:"delete.php",
				  data:data+"&table=contactbanner",
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