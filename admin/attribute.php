<?php
session_start();
require_once 'core/core.php';
require_once 'core/other-script.php';
@extract($_REQUEST);

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
		<link rel="shortcut icon" href="assets/images/favicon.png">		<!-- Custom box css -->		
		<link href="assets/plugins/custombox/css/custombox.min.css" rel="stylesheet">	
		<!-- App title -->        
		<title><?php echo ADMIN_TITLE;?> || Attributes</title>        <!-- Switchery css -->
		<link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />      
		<!-- App CSS -->        
		<link href="assets/css/style.css" rel="stylesheet" type="text/css" />	
		<!-- Jquery filer css -->        
		<link href="assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />  
		<link href="assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />	
		<!-- Modernizr js -->        
		<script src="assets/js/modernizr.min.js"></script>	

		<script>       
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)          })(window,document,'script','../../www.google-analytics.com/analytics.js','ga');          ga('create', 'UA-79190402-1', 'auto');          ga('send', 'pageview');     
		</script>  

	</head>    
	<body class="fixed-left">        <!-- Begin page -->        
		<div id="wrapper">            <!-- Top Bar Start -->            
			<!-- Top Bar End -->            <!-- ========== Left Sidebar Start ========== -->
			<?php include 'include/header.php';?>
			<?php include "include/sidebar.php";?>           
			<!-- Left Sidebar End --> 

			<div class="content-page">    <!-- Start content -->           
				<div class="content">   
					<div class="container">  
						<div class="row">	
							<div class="col-xs-12">		
								<div class="page-title-box">   
									<div class="col-md-6">
										<h4 class="page-title">Add Attribute</h4>
									</div>
									<div class="col-md-6" style="float: right;">
										<?php include('product-setting-menu.php');?>
									</div>
									<div class="clearfix"></div>  
								</div>		
							</div>		
						</div>                        <!-- end row -->	
					
							

						<div class="row">
							<div class="col-xs-12 col-md-6">							
								<div class="card-box">							
									<div class="row">	
										<form method="POST" action="control/attribute.php" enctype="multipart/form-data" >							
											<div class="col-xs-12 col-sm-12 col-md-12">	

												<?php if(isset($_SESSION['sess_msg']) && $_SESSION['sess_msg']!=''){?>
						                        <div class="alert alert-success text-center" role="alert">
						                            <?php echo $_SESSION['sess_msg']; $_SESSION['sess_msg']='';?>
						                        </div>
						                        <?php } ?>
						                        <?php if(isset($_SESSION['sess_msg_err']) && $_SESSION['sess_msg_err']!=''){?>
						                        <div class="alert alert-danger text-center" role="alert">
						                            <?php echo $_SESSION['sess_msg_err']; $_SESSION['sess_msg_err']='';?>
						                        </div>
						                        <?php } ?>

												<h4 class="header-title m-t-0">Add Attribute</h4>	
												<input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />			
												<div class="p-20">												
													<div class="form-group">	
														<label>Name</label>		
														<input type="text" name="name"class="form-control" required="" placeholder="Add Attribute" data-parsley-id="34" style="width:350px;">	
													</div>
																			
													<button type="submit" name="submitAttribute" class="btn btn-primary waves-effect waves-light" id="final-submit">
														<span class="btn-label"><i class="fa fa-check"></i></span>Submit
													</button>		
												</div>									
											</div>									
										</form>                              
									</div>                              
									<!-- end row -->                        
								</div>                      
							</div>

							<div class="col-xs-12 col-md-6">							
								<div class="card-box">							
									<div class="row">	
										<form method="POST" action="control/attribute.php" enctype="multipart/form-data" >							
											<div class="col-xs-12 col-sm-12 col-md-12">	
												<?php if(isset($_SESSION['sess_msga']) && $_SESSION['sess_msga']!=''){?>
						                        <div class="alert alert-success text-center" role="alert">
						                            <?php echo $_SESSION['sess_msga']; $_SESSION['sess_msga']='';?>
						                        </div>
						                        <?php } ?>
						                        <?php if(isset($_SESSION['sess_msg_erra']) && $_SESSION['sess_msg_erra']!=''){?>
						                        <div class="alert alert-danger text-center" role="alert">
						                            <?php echo $_SESSION['sess_msg_erra']; $_SESSION['sess_msg_erra']='';?>
						                        </div>
						                        <?php } ?>
												<h4 class="header-title m-t-0">Add Attribute Value</h4>	
												<input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />			
												<div class="p-20">												
													<div class="form-group">	
														<label>Attribute Name</label>		
														<select name="attributeName" class="form-control">
															<?php 
															$attSql=mysqli_query($con, "SELECT * from `tbl_attribute` group by name");
															while($attLine=mysqli_fetch_array($attSql)){
															?>
															<option value="<?php echo $attLine['name'];?>">
																<?php echo $attLine['name'];?>
															</option>
															<?php } ?>
														</select>	
													</div>

													<div class="form-group">	
														<label>Value(Comma Seprated)</label>		
														<input type="text" name="attr_value"class="form-control" required="" placeholder="eg, S, M, XL" data-parsley-id="34" style="width:350px;">	
													</div>	
																									
																			
													<button type="submit" name="submit" class="btn btn-primary waves-effect waves-light" id="final-submit">
														<span class="btn-label"><i class="fa fa-check"></i></span>Submit
													</button>		
												</div>									
											</div>									
										</form>                              
									</div>                              
									<!-- end row -->                        
								</div>                      
							</div>	
							
							<!-- end row -->  

							<div class="col-xs-12 col-md-12">						
								<div class="card-box table-responsive">		
									<h4 class="m-t-0 header-title"><b>Brand Table</b></h4>								
									<div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap4 no-footer">				
										<div class="row">
											<div class="col-md-12">
												<table id="datatable" class="table table-striped table-bordered no-footer" role="grid" aria-describedby="datatable_info">									
													<thead>
														<tr role="row">	
															<th rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 10%;">	#
															</th>

															<th rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 10%;" id="del">
																<i class="fa fa-trash fa-2x"></i>
															</th>

															<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 30%;">Name</th>

															<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 30%;">Value</th>

															<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 20%;">Action</th>

														</tr>								
													</thead>									
													<tbody id="pbody">
													<?php
													$ed=0;
													$data = mysqli_query($con,"SELECT * from `tbl_attribute` where attr_value!='' order by name asc");
													$i=1;
													$num = mysqli_num_rows($data);
													if($num>0){
													while($result = mysqli_fetch_array($data)) {	
													?>									
													<tr role="row" class="odd">
														<form method="POST">		
														<td class="sorting_1" style="width: 10%;">
															<?php echo $i; $i++;?>.
														</td>	
														<td style="width: 10%;">	
															<div class="checkbox checkbox-danger checkbox-circle">
																<input id="checkbox-12" type="checkbox" name="check[]" value="<?php echo $result["cid"]; ?>">
																<label for="checkbox-12"></label>
															</div>
														</td>	
														
														<td style="width: 30%;">
															
															<?php if($result['editAttr']==1){?>
																<?php echo $result['name']; ?>
															&nbsp;&nbsp;
															<a data-toggle="tooltip" data-placement="top" title="Edit" href="edittext2.php?id=<?php echo $result["cid"];?>&table=tbl_attribute&field=name" onclick="window.open(this.href,'UPDATE','width=900,height=700'); return false">
																<span style="width:50px;height:50px;">
																	<i class="fa fa-pencil-square-o" aria-hidden="true" style="color:green;font-size:14px;"></i>
																</span>
															</a>
														<?php } ?>
														</td>									
														<td style="width: 30%;">
															<?php echo $result['attr_value']; ?>&nbsp;&nbsp;
															<a data-toggle="tooltip" data-placement="top" title="Edit" href="edittext.php?id=<?php echo $result["cid"];?>&table=tbl_attribute&field=attr_value" onclick="window.open(this.href,'UPDATE','width=900,height=700'); return false">
																<span style="width:50px;height:50px;">
																	<i class="fa fa-pencil-square-o" aria-hidden="true" style="color:green;font-size:14px;"></i>
																</span>
															</a>
														</td>

														<td style="width: 20%;">
															<?php
																$str1 = '';
																if($result['status'] == '1'){
																	$str1 = 'checked';
																}
															?>

<input class="status" dataid="<?php echo $result['cid']?>" type="checkbox" data-plugin="switchery" data-color="#3aa99e"  <?php echo $str1;?>/>&nbsp;&nbsp;
														</td>
														</form>
													</tr>
													<?php } } else { ?>
													<tr>
														<td colspan="5" style="height: 20px;">
															No result...
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
						</div>                 
					</div> <!-- container -->            
				</div> <!-- content -->           
			</div>            <!-- End content-page -->                      
			<footer class="footer text-right">              
				<?php echo $copy_right;?>         
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
					data: 'as='+as+'&id='+id+'&type=attribute',
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
				if(d == 1) { // alert(data);
					$.ajax({
						type:"post",
						url:"delete.php",
						data:data+"&table=tbl_attribute",
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