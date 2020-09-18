<?php 
require_once 'core/core.php';
require_once 'core/other-script.php';

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
        <link rel="shortcut icon" href="assets/images/favicon.png">

        <!-- App title -->
        <title><?php echo ADMIN_TITLE;?> || Map</title> 

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="assets/plugins/morris/morris.css">

        <!-- Switchery css -->
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" /> 
        <!-- Modernizr js -->
        <script src="assets/js/modernizr.min.js"></script>
		
	<script>
	function validate(){
		var a=document.getElementById("link-text").value;
		a=a.trim()
		if(a=='')
		{   document.getElementById("add1-error").style.color = "red";
	        document.getElementById("add1-error").innerHTML= " *Link can not be blank";
			
			return false;
		}
	}
	</script>
		
		
<script src="//cdn.ckeditor.com/4.5.10/standard/ckeditor.js"></script>
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
                                    <h4 class="page-title">MAP</h4> 
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->

							
                       <div class="row">
			<form role="form" method="POST" enctype="multipart/form-data" action="control/map.php" onSubmit="return validate(this);">					   
						<div class="col-xs-12 col-md-5">
                                <div class="card-box">
                                    
                                        
                                            <div class="p-20"> 
											
											<div class="form-group">
											<div class="row">
											<div class="col-md-6">
                                                    <label class="control-label">Add Map Link</label>
                                                    <input type="text" name="map" id="link-text" class="form-control"  autocomplete="off">
													<div style="inline-block; color:green;float:left" id="add1-error">  * Mandatory Field</div>
                                                     </div>
													 <div class="col-md-6">
													  <label class="control-label">To Get map Link Click Here...</label>
                                                   <a href="https://www.google.co.in/maps/" target="_blank"><button type="button" class="btn btn-success-outline waves-effect waves-light">MAP</button></a>
													  </div>
													   </div>
                                                </div>
												    
												<button type="submit" name="submit" class="btn btn-primary waves-effect waves-light">
												
                                                   <span class="btn-label"><i class="fa fa-check"></i>
                                                   </span>Submit
											</button>
                                            </div>
                                        
                        		</div>
                            </div>
							</form> 
					<div class="col-xs-12 col-md-6">
							<div class="card-box table-responsive">
								<h4 class="m-t-0 header-title"><b>map Table</b></h4>
								<div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap4 no-footer"><div class="row">  </div>
								<div class="row"><div class="col-md-12"><table id="datatable" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable_info">
									<thead>
										<tr role="row">
											<th rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 30px;">Sr. No.</th>
											<th rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 40px;" id="del">
												<i class="fa fa-trash fa-2x"></i>
											</th>
											<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 400px;">Map</th>
											 
											 
										</tr>
									</thead>
									<tbody>
									<?php
                                $i=0;                     
                                $res = mysqli_query($con,"SELECT * FROM  map");
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
										<td><?php echo $x['map']; ?> </td>
										 
										 
									</tr>
								<?php } ?>
									</tbody>
								</table></div></div> </div>
							</div>
                        </div>
						</div>
                    </div> <!-- container -->

                </div> <!-- content --> 
            </div> 
            <!-- /Right-bar -->

            <footer class="footer text-right">
                © <?php echo $copy_right; ?>
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

    </body> 
</html>
<script>
          $("#del").click(function(){
            var d = confirm("Are you sure you want to delete this row ?")
            var data = $("input:checked").serialize();
            if(d == 1){ // alert(data);
            $.ajax({
              type:"post",
              url:"delete.php",
              data:data+"&table=map",
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