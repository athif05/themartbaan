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
        <title><?php echo ADMIN_TITLE;?> || Social Media</title> 

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="assets/plugins/morris/morris.css">

        <!-- Switchery css -->
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" /> 
        <!-- Modernizr js -->
        <script src="assets/js/modernizr.min.js"></script>

		
<script src="//cdn.ckeditor.com/4.5.10/standard/ckeditor.js"></script>
<style>
#link{
	text-transform:capitalize;
}
</style>
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
                                    <h4 class="page-title">Social Link</h4> 
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row --> 
					<div class="col-xs-12 col-md-7">
							<div class="card-box table-responsive">
								<h4 class="m-t-0 header-title"><b>Select Social Media Links</b></h4>
								<div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap4 no-footer"><div class="row"><div class="col-md-12"><table id="datatable" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable_info">
									<thead>
										<tr role="row">
											<th rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 30px;">#</th>
											<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 200px;">Social Media</th>
											<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending">Address</th>
											<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 200px;">Status</th>
										</tr>
									</thead>
									<tbody>
									
									<?php
										$i=0;                     
										$res = mysqli_query($con,"SELECT * FROM `social_links` where status!=2");
										while ($x = mysqli_fetch_array($res)){
										$i++;
									  ?>
										<tr role="row" class="odd">
											<td class="sorting_1"><?php echo $i; ?>.</td>
											<td id="link"><?php echo $x['link'] ?></td>
											<td>
												<form method="POST" action="control/social.php" >
													<input type="hidden" name="hide" value="<?php echo $x['cid'] ?>" />
													http://<input required value="<?php echo substr($x['address'],7); ?>" type="text" name="social" style="width:80%" class="form-control" />
													<button type="submit" name="submit" class="btn btn-success"><i class="fa fa-check"></i></button>
												</form>
											</td>
											<td class="jagdish">  <input  type="checkbox" name="switch-field-1" data-plugin="switchery" data-color="#1bb99a" data-secondary-color="#ff5d48" data-switchery="true" <?php if($x["status"]==1){ echo 'checked'; } ?> id="checkstatus" ajay="123" datano="<?php echo $x["cid"];?>"> </td>
										</tr>
										<?php
										}
										?>
									</tbody>
								</table>
								</div>
								</div>
								</div>
							</div>
                        </div>
                    </div> <!-- container -->

                </div> <!-- content -->
<script src="assets/js/jquery.min.js" type="text/javascript"></script>
				<script type="text/javascript">
						
$('.jagdish input').change(function(e){
	
if($(this).prop("checked") == true) {
	var status=1;
	var v = $(this).attr('datano');
	
	 $.ajax({
		type: "GET",
		data: "update="+v+"&status="+status+"&table=social_links",
		url: "upsocial.php",
		//data: "update="+v+"&status="+status,
		success: function(data)
		{
			//location.reload();		
		}
	});
	

}
else if($(this).prop("checked") == false){
	var status=0;
	var v = $(this).attr('datano');
	
 $.ajax({
		type: "GET",
		data: "update="+v+"&status="+status+"&table=social_links",
		url: "upsocial.php",
		//data: "update="+v+"&status="+status,
		success: function(data)
		{
			//location.reload();
		}
	}); 
}	
});
</script> 
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