<?php
session_start();
include('core/core.php');
include 'core/other-script.php';

if(!isset($_SESSION['login_id'])) {
	header("Location:login/index.php");	
}
?>
<!DOCTYPE html>
<html> 
	<head>  
		<meta charset="utf-8">     
		<meta name="viewport" content="width=device-width, initial-scale=1.0">      
		<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">       
		<meta name="author" content="Coderthemes">        <!-- App Favicon -->  
		<link rel="shortcut icon" href="assets/images/favicon.ico">		<!-- Custom box css -->		
		<link href="assets/plugins/custombox/css/custombox.min.css" rel="stylesheet">
		<!-- App title -->        
		<title><?php echo ADMIN_TITLE;?> | Products</title>        <!-- Switchery css -->
		<link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />  
		<!-- App CSS -->        
		<link href="assets/css/style.css" rel="stylesheet" type="text/css" />	
		<!-- Jquery filer css -->        
		<link href="assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />  
		<link href="assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />	
		<!-- Modernizr js -->        
		<script src="assets/js/modernizr.min.js"></script>	
 
		<style type="text/css">
			.addNewBtn{
				color: white; 
				background-color: #64b0f2; 
				padding: 5px 15px 5px 15px; 
				border-radius: 3px; 
			}
			.addNewBtn:hover{
				color: white; background-color: #3aa99e; padding: 5px 15px 5px 15px; border-radius: 3px;
			}
		</style>
	</head>    
	<body class="fixed-left">        <!-- Begin page -->        
		<div id="wrapper">            <!-- Top Bar Start -->            
			<!-- Top Bar End -->            <!-- ========== Left Sidebar Start ========== -->
			<?php include "include/sidebar.php";?>           
			<!-- Left Sidebar End --> 

			<div class="content-page">    <!-- Start content -->           
				<div class="content">   
					<div class="container">  
						<div class="row">	
							<div class="col-xs-12">		
								<div class="page-title-box">   
									<h4 class="page-title">Staff List</h4>
									<div class="clearfix"></div>   
								</div>		
							</div>		
						</div>                        <!-- end row -->	
						
						<div class="row">
							 	
							<div class="col-xs-12 col-md-12">						
								<div class="card-box table-responsive">		
									<h4 class="m-t-0 header-title">
										<b>Staff List</b>
										<b style="float: right;">
											<a href="staff.php" class="addNewBtn">
												<i class="fa fa-plus"></i> Add New Staff
											</a>
										</b>
									</h4>							
									<div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap4 no-footer">				
										<div class="row">
											<div class="col-md-12">
												<table id="datatable" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable_info">									
													<thead>
														<tr role="row">	
															<th rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 3%;">	#
															</th>

															<th rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 7%;" id="del">
																<i class="fa fa-trash fa-2x"></i>
															</th>

															<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 10%;">Image</th>

															<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 20%;">Name</th>

															<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 15%;">E-mail</th>

															<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 15%;">Phone</th>

															<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 23%;">Address</th>

															<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 7%;">Action</th>

														</tr>								
													</thead>									
													<tbody id="pbody">
													<?php
													$i=1;
$start=0;
if(isset($_GET['start'])) $start=$_GET['start'];
$pagesize=10;
if(isset($_GET['pagesize'])) $pagesize=$_GET['pagesize'];
$order_by='name'; //time_set
if(isset($_GET['order_by'])) $order_by=$_GET['order_by'];
$order_by2='asc';
if(isset($_GET['order_by2'])) $order_by2=$_GET['order_by2'];


$staffSql=mysqli_query($con,"SELECT * from `staff` order by $order_by $order_by2 limit $start,$pagesize");
$reccnt=mysqli_num_rows(mysqli_query($con,"SELECT * from `staff`"));

if($reccnt>0) {
while($staffLine=mysqli_fetch_array($staffSql)) {


													?>									
													<tr role="row" class="odd">
														<form method="POST">		
														<td class="sorting_1" style="width: 3%;">
															<?php echo $i; $i++;?>.
														</td>	
														<td style="width: 7%;">	
															<div class="checkbox checkbox-danger checkbox-circle">
																<input id="checkbox-12" type="checkbox" name="check[]" value="<?php echo $staffLine["cid"]; ?>">
																<label for="checkbox-12"></label>
															</div>
														</td>	
														<td style="width: 10%;">
															
															<img src="control/images/<?php echo $staffLine['image'];?>" style="border-radius:8px" id="view-image" width="50px" height="50px" title="Click to View Image">
														
															&nbsp;&nbsp;
															<a href="control/edit_product_image.php?id=<?php echo $staffLine["cid"];?>&table=staff&field=image" onclick="window.open(this.href,'UPDATE','width=900,height=700'); return false">
																<span style="width:50px;height:50px;">

																	<i class="fa fa-pencil-square-o" aria-hidden="true" style="color:green;font-size:14px;"></i>
																</span>
															</a>
														</td>										
														<td style="width: 20%;">
															<?php echo $staffLine['name']; ?>&nbsp;&nbsp;
															<a data-toggle="tooltip" data-placement="top" title="Edit" href="edittext.php?id=<?php echo $staffLine["cid"];?>&table=staff&field=name" onclick="window.open(this.href,'UPDATE','width=900,height=700'); return false">
																<span style="width:50px;height:50px;">
																	<i class="fa fa-pencil-square-o" aria-hidden="true" style="color:green;font-size:14px;"></i>
																</span>
															</a>
														</td>

														<td style="width: 15%;">
															<?php echo $staffLine['email']; ?>&nbsp;&nbsp;
															<a data-toggle="tooltip" data-placement="top" title="Edit" href="edittext.php?id=<?php echo $staffLine["cid"];?>&table=staff&field=email" onclick="window.open(this.href,'UPDATE','width=900,height=700'); return false">
																<span style="width:50px;height:50px;">
																	<i class="fa fa-pencil-square-o" aria-hidden="true" style="color:green;font-size:14px;"></i>
																</span>
															</a>
														</td>

														<td style="width: 15%;">
															<?php echo $staffLine['phone']; ?>&nbsp;&nbsp;
															<a data-toggle="tooltip" data-placement="top" title="Edit" href="edittext.php?id=<?php echo $staffLine["cid"];?>&table=staff&field=phone" onclick="window.open(this.href,'UPDATE','width=900,height=700'); return false">
																<span style="width:50px;height:50px;">
																	<i class="fa fa-pencil-square-o" aria-hidden="true" style="color:green;font-size:14px;"></i>
																</span>
															</a>
														</td>

														<td style="width: 23%;">
															<?php echo $staffLine['address']; ?>&nbsp;&nbsp;
															<a data-toggle="tooltip" data-placement="top" title="Edit" href="edittext.php?id=<?php echo $staffLine["cid"];?>&table=staff&field=address" onclick="window.open(this.href,'UPDATE','width=900,height=700'); return false">
																<span style="width:50px;height:50px;">
																	<i class="fa fa-pencil-square-o" aria-hidden="true" style="color:green;font-size:14px;"></i>
																</span>
															</a>
														</td>

														<td style="width: 7%;">
															<?php
																$str1 = '';
																if($staffLine['status'] == '1'){
																	$str1 = 'checked';
																}
															?>

<input class="status" dataid="<?php echo $staffLine['cid']?>" type="checkbox" data-plugin="switchery" data-color="#3aa99e"  <?php echo $str1;?>/>&nbsp;&nbsp;
														</td>
														</form>
													</tr>							
													<?php }  ?>
													<tr>
	                                                    <td colspan="6">
	                                                    	&nbsp;
	                                                    </td>
	                                                    <td colspan="6">
	                                                    	<?php include("core/paging.inc.php");?>
	                                                    </td>
	                                                </tr>
													<?php } else {?>
														No result.
													<?php } ?>
													</tbody>
												</table>								
											</div>								
										</div>								
									</div>							
								</div>                      
							</div>					
						</div>                 
					</div> <!-- container -->            
				</div> <!-- content -->           
			</div>            <!-- End content-page -->                      
			<footer class="footer text-right">              
				2018 &copy; IT Globaliser Noida           
			</footer>        
		</div>        
		<!-- END wrapper -->
		<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>        <!-- jQuery  -->        
		<script src="assets/js/jquery.min.js"></script>        
		<script src="assets/js/tether.min.js"></script>
		<!-- Tether for Bootstrap -->        
		<script src="assets/js/bootstrap.min.js"></script>        
		<script src="assets/js/detect.js"></script>       
		<script src="assets/js/fastclick.js"></script>       
		<script src="assets/js/jquery.blockUI.js"></script>       
		<script src="assets/js/waves.js"></script>        
		<script src="assets/js/jquery.nicescroll.js"></script>      
		<script src="assets/js/jquery.scrollTo.min.js"></script>      
		<script src="assets/js/jquery.slimscroll.js"></script>      
		<script src="assets/plugins/switchery/switchery.min.js"></script>	
		<script src="assets/plugins/custombox/js/custombox.min.js"></script>     
		<script src="assets/plugins/custombox/js/legacy.min.js"></script>		<!-- Jquery filer js -->        
		<script src="assets/plugins/jquery.filer/js/jquery.filer.min.js"></script>		<!-- page specific js -->        
		<script src="assets/pages/jquery.fileuploads.init.js"></script>        <!-- App js -->        
		<script src="assets/js/jquery.core.js"></script>        
		<script src="assets/js/jquery.app.js"></script>

		<script>

			$('#pbody').on('change','.status', function(){

				var as = '';
				if($(this).is(':checked')) {
					var as = 1;
				}

				var id = $(this).attr('dataid');

				$.ajax({
					method: 'POST',
					url: 'updateStatus.php',
					data: 'as='+as+'&id='+id+'&type=staff',
					success : function(data) {
						alert('Updated');
					}
				});
			});
		</script>

		<script>
			$("#del").click(function() {
				var d = confirm("Are you sure you want to delete this row ?");
				var data = $("input:checked").serialize();
				if(d == 1) { 
					$.ajax({
						type:"post",
						url:"delete.php",
						data:data+"&table=staff",
						success:function(data1){
							window.location.href =window.location.href;
						}
					});
				}
			});
			$(":checkbox").click(function() {
				if($("input:checked").length > 0) {
					$("#del").css("color","red");
					$("#del").css("cursor","pointer");
				} else {
					$("#del").css("color","#333939");
					$("#del").css("cursor","auto");
				}
			});
		</script> 
	</body>
</html>