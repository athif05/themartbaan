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
include('core/other-script.php');
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
        <title>Admin || IT Globaliser</title>

        <!-- Switchery css -->
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		
		<!-- Jquery filer css -->
        <link href="assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
        <link href="assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />
		 
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
			  
		       // var reader = new FileReader();
               // reader.onload = function (e) {
                //var v = "url(" + e.target.result + ")";	 
				
				//reader.readAsDataURL(this.files[0]);				
			    ////alert(v);
			  
		  $("#image-error").text("");
		  var filePath=$('#a').val();
		  
		  //var fileName = e.target.files[0].name;
		  //var tmppath = URL.createObjectURL(event.target.files[0]);
			//alert(fileName);
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
		if(size>512000 && t==0){
			 $("#image-error").text("* Image size should be less than 500 KB");
			 s=1;
		}
		if(s==0 && t==0){
			 $("#final-submit").css("background-color", "green");
		     $("#final-submit").removeAttr('disabled'); 
			 
			    $("#test").attr("src",filePath);
				
			   //$("#preview").html("<img src=C:\desktop\abc.jpg>");
		}
		else{
			$("#img-hide").css("display","none");
			//alert("hello");	
		}
    });
    });
	
	function validate(){
		var n=document.getElementById("attr-name").value;
		//var m=document.getElementById("msg").value;
		//alert(m);
	    n=n.trim()
		if(n==''){	
		
		alert("Please fill all the fields");
		return false;
		}
		else{
			
			return true;
		}
	}
	
	
</script>
    </head>

    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            <?php include "include/sidebar.php";?>
         
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <h4 class="page-title">Attractions</h4>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->

					
					<div class="row">
						<div class="col-xs-12 col-md-10 col-md-offset-1 ">
							<div class="card-box">
								<div class="row">
									<form method="POST" action="control/attraction.php" enctype="multipart/form-data" onSubmit="return validate(this)">
										<div class="col-xs-12 col-sm-12">
											<h4 class="header-title m-t-0">Add Attractions</h4>
											<input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
											
						<div style="background-color:#ff5d48; color:#fff; padding:5px; border-radius:0px">Instructions  <i class="fa fa-arrow-down"></i></div>
<div style="background-color:#ededed; color:#000; padding:5px; border-radius:0px; font-size:12px;border:1px solid #ff5d48">
*Image should be in JPEG/PNG format <br> *Size should be less than 500 KB <br> *Name & Description fields can not be blank
</div>
											<div class="p-20">
											<div class="row">
											
											<div class="col-md-6">
												<div class="form-group">
														<label class="control-label">Enter Description</label>
														<textarea name='text2'></textarea>
														<script>
														CKEDITOR.replace('text2');
														</script>
												</div> 
												</div>
												<div class="col-md-6">
												<div class="form-group">
													 <label class="control-label">Attraction Name</label>
													<input id="attr-name" type="text" name="text1"class="form-control" required="" placeholder="Attraction Name" data-parsley-id="34">
												</div>
												
												
												<div class="form-group clearfix">
													<label></label>
													<div class="col-sm-12 row">
													<label for="a" class="ace-file-input">
													<span class="ace-file-container" data-title="Choose">
														<span class="ace-file-name" data-title="No File ...">
														<i class=" ace-icon fa fa-upload" style="font-size: 100px; cursor: pointer;"></i>
														</span><i class="fa fa-arrow-left" style="margin-left:0px;" aria-hidden="true"> Click here to upload image</i>
													</span>
													
													<input onchange="readURL(this);" type="file" id="a"  style="display:none;" name="file"/>
<div id="img-hide"><img alt="Image Display Here" id="test"  style="display:none;height:90px;width:90px;"/></div>
<div id="image-error" style="color:red;background-color:#ededed">
													</div>
												</div>
												
												<button type="submit" name="submit" class="btn btn-primary waves-effect waves-light" id="final-submit" disabled>
													   <span class="btn-label"><i class="fa fa-check"></i>
													   </span>Submit
												</button>
												</div>
												</div>
												
											</div>
										</div>
									</form>
                                </div>
                                <!-- end row -->
                        	</div>
                        </div>
						<div class="col-xs-12 col-md-12">
							<div class="card-box table-responsive">
								<h4 class="m-t-0 header-title"><b>Table</b></h4>
								<div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap4 no-footer">
								<div class="row"><div class="col-md-12"><table id="datatable" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable_info">
									<thead>
										<tr role="row">
											<th rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 30px;">#</th>
											<th rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 40px;" id="del">
												<i class="fa fa-trash fa-2x"></i>
											</th>
											<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 340px;">Image</th>
											<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 340px;">Attraction</th>
											<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 340px;">Description</th>
											 
										</tr>
									</thead>
									<tbody>
									<?php
                                $i=0;                     
                                $res = mysqli_query($con,"SELECT * FROM attraction");
                                while ($x = mysqli_fetch_array($res)){
                                $i++; 
                              ?>
									<tr role="row" class="odd">
										<td class="sorting_1"><?php echo $i; ?>.</td>
										<td>
											<div class="checkbox checkbox-danger checkbox-circle">
												<input id="checkbox-12" type="checkbox" name="check[]" value="<?php echo $x["cid"]; ?>">
												<label for="checkbox-12"></label>
											</div>
										</td>
										<td><img src="control/<?php echo $x['image']; ?>" style="width:250px;height:200px">&nbsp;&nbsp;<a href="control/editimage.php?id=<?php echo $x["cid"];?>&table=attraction&field=image" onclick="window.open(this.href,'UPDATE','width=900,height=700'); return false"><span style="width:50px;height:50px;"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color:green;font-size:14px;"></i><span></span></span></a></td>
										<td><?php echo $x['text1']; ?>&nbsp;&nbsp;<a data-toggle="tooltip"
                                                    data-placement="top" title="Edit" href="edittext.php?id=<?php echo $x["cid"];?>&table=attraction&field=text1" onclick="window.open(this.href,'UPDATE','width=900,height=700'); return false"><span style="width:50px;height:50px;"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color:green;font-size:14px;"></i><span></span></span></a></td>
										<td><?php echo $x['text2']; ?>&nbsp;&nbsp;<a data-toggle="tooltip"
                                                    data-placement="top" title="Edit" href="edittext.php?id=<?php echo $x["cid"];?>&table=attraction&field=text2" onclick="window.open(this.href,'UPDATE','width=900,height=700'); return false"><span style="width:50px;height:50px;"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color:green;font-size:14px;"></i><span></span></span></a></td>
										
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
<script>
          $("#del").click(function(){
            var d = confirm("Are you sure you want to delete this row ?")
            var data = $("input:checked").serialize();
            if(d == 1){ // alert(data);
            $.ajax({
              type:"post",
              url:"delete.php",
              data:data+"&table=attraction",
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
