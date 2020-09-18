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
        <title><?php echo ADMIN_TITLE;?> | Privacy Policy</title> 
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

			<script type="text/javascript">
		
			$("#document").ready(function(){
			$("#error").css("display","none");
				
			 $("#form1").submit(function(e){
				 var heading=$.trim($("#check-heading").val());
				 //var icon=$.trim($("#check-icon").val());
                 
				if(heading=='')
					{	
				 $(" #error").slideDown();
				 e.preventDefault();
					}

            });
			
				$("#update-btn").click(function(){
		$("#edit-down").slideDown("9000");
	});
				
			});
		
		</script>
	
	
	
	
		
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
							<div class="col-sm-12">
								<?php include('content-page-menu.php');?>
							</div>
						</div>
                        <!-- end row -->

					<?php
					$total=1;
					@extract($_REQUEST);
					if(isset($cid)){
						$total=0;
						$cid=$_GET['cid'];
						$row=mysqli_query($con,"select * from `travel` where cid='1'");
						$result=mysqli_fetch_assoc($row);
					}
					?>
                       <div class="row" id="edit-down" style="display:<?php if($total!=0){ echo 'none';}?>">					
						<div class="col-sm-8 col-sm-offset-2">
						<form id="form1" role="form" method="POST" enctype="multipart/form-data" action="control/travel.php">
                                <div class="card-box">
                                    <div class="col-xs-12 col-sm-12">

									<div id="error" style="display:none;background-color:#f4511e; height:30px; padding:5px;color:#fff ";><i class="fa fa-exclamation-triangle"></i>&nbsp;Please fill both the below fields.</div>

									</div>
									<div class="col-xs-12 col-sm-12">
										<div class="p-20"> 
										<div class="form-group">
												<label class="control-label">Heading</label>
												<input type="text" required name="heading" class="form-control"  autocomplete="off" 
												id="check-heading" value="<?php if(isset($cid)){  echo $result['heading'];} ?>">
												 
											</div>
											<div class="form-group">
													<label class="control-label">Enter Description</label>
													<textarea name='as' id="check-desc"><?php if(isset($cid)){  echo $result['description'];} ?></textarea>
													<script>
													CKEDITOR.replace('as');
													</script>
											</div>    
											<input id="check-submit" type="submit" name="submit"  class="button" id="final-submit">
											   
										    </input>	
										</div>
									</div> 
                        		</div>
                            </div>
					</div>
					</form>
					
					
					<div class="col-xs-12 col-md-7">
							<div class="card-box table-responsive">
								<h4 class="m-t-0 header-title"><b>Privacy Policy</b></h4>
								<div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap4 no-footer">
								<div class="row">
								<div class="col-md-12">
								<table id="datatable" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable_info">
									<thead>
										<tr role="row">
											<th rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 30px;">S.No</th>
											
											<th class="" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 340px;">Heading</th>
											<th class="" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 340px;">Description</th>
											<th class="" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 290px;">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i=0;                     
											$res = mysqli_query($con,"SELECT * FROM `travel`");
											while ($x = mysqli_fetch_array($res))
											{
											$i++;
										?>
										<tr role="row" class="odd">
											<td class="sorting_1"><?php echo $i; ?></td>
											
											<td><?php echo $x["heading"]; ?>
										
													
													</td>
													
			<td><?php echo $x["description"]; ?>
			
			</td>
			
			<td class="jagdish">  
			

			<div style="position:relative;top:20px;"><a style="background-color:red; padding:5px; border:1px solid red; color:#fff" href="travel.php?cid=<?php echo $x["cid"];?>">Update </a>
			</div>
			</td>
			</tr>
			<?php } ?>
									</tbody>
								</table></div></div></div>
							</div>
                        </div>
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
    </body> 
</html>