<?php 
session_start();
if(!isset($_SESSION['login_id']))
	{
		?>
		<script>
		window.location = "login/index.php";
		</script>
		<?php
	}
require_once 'core/core.php';
require_once('core/other-script.php');
?>
<!DOCTYPE html>
<html> 
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
	 <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
        <!-- App Favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.png">

        <!-- App title -->
        <title><?php echo ADMIN_TITLE;?> || Home Offer</title>

        <!-- Switchery css -->
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" /> 
		<!-- Jquery filer css -->
        <link href="assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
        <link href="assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />
		 
        <!-- Modernizr js -->
        <script src="assets/js/modernizr.min.js"></script>
		<script>
	
	function validate(){
		var a=document.getElementById("offer").value;
		a=a.trim();
		
		if(a==''){
		document.getElementById("offer-error").style.color = "red";
		return false;
		}
		
	//at end success
	      alert("Submitted Successfully");
		  return true;
		
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
             
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <h4 class="page-title">Home Offer</h4> 
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->
					
					<div class="row">
					
					<?php
					$num=mysqli_query($con, "select count(*) as total from home_offer");
					$total=mysqli_fetch_assoc($num);
										
					@extract($_REQUEST);
					if(isset($id)){
						$total=0;
					$id=$_GET['id'];
					$row=mysqli_query($con,"select * from home_offer where id=$id");
					$result=mysqli_fetch_assoc($row);
					
					}
					?>
				
						<div class="col-xs-12 col-md-8 col-md-offset-2" style="display:<?php if($total!=0){ echo 'none';}?>">
						<form role="form" method="POST" enctype="multipart/form-data" action="control/home_offer.php" onSubmit="return validate(this)">
							<div class="card-box">
								 
										<div class="p-20">
										 <div class="row">
										 	 <div class="col-md-6">
											<div class="form-group">
											<input type="hidden" value="<?php echo $id;?>" name="update">
												<label>Offer Title<div style="inline-block; color:green;float:right" id="add1-error">  * Mandatory Field</div></label>
												<input type="text" id="add1" class="form-control" required placeholder="Type Address" name="offer" data-parsley-id="34"
												value="<?php if(isset($id)){  echo $result['offer'];} ?>">
											</div>
											</div>

											<div class="col-md-6">
											<div class="form-group">
											
												<label>Offer Title 2<div style="inline-block; color:green;float:right" id="add1-error">  * Mandatory Field</div></label>
												<input type="text" id="add1" class="form-control" required placeholder="Type Address" name="offer2" data-parsley-id="34"
												value="<?php if(isset($id)){  echo $result['offer2'];} ?>">
											</div>
											</div>
											
											</div>
										
											<button type="submit" name="submit" class="btn btn-primary waves-effect waves-light">
												<span class="btn-label"><i class="fa fa-check"></i>
												</span>  
												<?php if(isset($id)){echo "Update";} else{ echo "Submit";}?>
											</button>
										</div>
                                <!-- end row -->
                        	</div>
							</form>
                        </div>
						
							</div>
						<div class="col-xs-12 col-md-12"> 
							<div class="card-box table-responsive">
								<h4 class="m-t-0 header-title"><b>Offer Table</b></h4>
								<div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap4 no-footer">
								 <div class="row"><div class="col-md-12"><table id="datatable" class="table table-striped table-bordered dataTable no-footer" role="grid">
									<thead>
										<tr role="row">
											<th rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 5%;">#</th>
											<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 35%;">Offer Title</th>
											<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 50%;">Offer Title2</th>
											<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 10%;">Update</th>
										</tr>
									</thead>
									<tbody>
									
									<?php
                                $i=0;                     
                                $res = mysqli_query($con,"SELECT * FROM home_offer");
                                while ($x = mysqli_fetch_array($res)){
                                $i++; 
                              ?>
									<tr role="row" class="odd">
										<td class="center"><?php echo $i; ?>.</td>
																				 
										<td><?php echo $x['offer']; ?></td>

                                        <td><?php echo $x['offer2']; ?></td>
										
										<td class="jagdish"> 
										
										<a style="background-color:red; padding:5px; border:1px solid red; color:#fff" href="home_offer.php?id=<?php echo $x["id"];?>">Update </a>
										</td>
										 
									</tr>
								<?php } ?>
									 
									</tbody>
									 
								</table>
								</div>
								</div>
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
		data: "update="+v+"&status="+status+"&table=contact",
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
		data: "update="+v+"&status="+status+"&table=contact",
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

            <footer class="footer text-right">
                © <?php echo $copy_right; ?>
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
    </body> 
</html>