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
		<title><?php echo ADMIN_TITLE;?> | Category</title>        <!-- Switchery css -->
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
										<h4 class="page-title">
											Add Sub-Category
										</h4>
									</div>
									<div class="col-md-6" style="float: right;">
										<?php include('product-setting-menu.php');?>
									</div>
									<div class="clearfix"></div>
								</div>		
							</div>		
						</div>                        <!-- end row -->	
						<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
						<style>
							.loader{
								background-color:rgba(0,0,0,0.2);
								box-shadow: ;
								position:fixed;
								padding:10px;	
								top:300px;
								right:500px;
								left:500px;
								bottom:500px;
								z-index:2;
								display:none;
								border:1px solid grey;
							}
							.loader-img{

							}
						</style>
						
						<script type="text/javascript">
							$(document).ready(function() {

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
									var ValidImageTypes = ["image/jpeg", "image/png"];
									if ($.inArray(type, ValidImageTypes) < 0) {
										$("#image-error").text("* Slider image should be in JPG/PNG format");
										t=1;
									}
									if(size>500000 && t==0) {
										$("#image-error").text("* Slider image size should be less than 500KB");/*1 MB = 8000000*/
										s=1;
									}

									if(s==0 && t==0) {
										$("#final-submit").css("background-color", "green");
										$("#final-submit").removeAttr('disabled'); 

										$("#test").attr("src",filePath);
									} else {
										$("#img-hide").css("display","none");
									}
								});
								$("a").click(function() {
									var v=$(this).attr("name");

									$(".loader").css("display","block");	
									var htm="<img src="+v+">";
									
									$(".loader").animate({height: "330px",width:"450px"});
									$("#check-img").attr("src",v);
								});

								$("#close").click(function() {

									$(".loader").animate({height:"10px",width:"10px"},300, function(){
										$(".loader").css("display","none");
									});	
								});
							});
						</script>	

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

						<div class="row">
							<div class="col-xs-12 col-md-5">							
								<div class="card-box">							
									<div class="row">	
										<form method="POST" action="control/sub-category.php" enctype="multipart/form-data" >							
											<div class="col-xs-12 col-sm-12">	

												<div style="background-color:#ff5d48; color:#fff; padding:5px; border-radius:0px; width:100%">
													Instructions  
													<i class="fa fa-arrow-down"></i>
												</div>
												<div style="background-color:#ededed; color:#000; padding:5px; border-radius:0px; font-size:12px;border:1px solid #ff5d48; margin-bottom:10px">
													* Category Image should be in JPEG/PNG format <br> 
													*Size should be less than 500 KB
												</div>
												<h4 class="header-title m-t-0">Add Sub Category</h4>	
												<input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />			
												<div class="p-20">												
													<div class="form-group">	
														<label>Name</label>		
														<input type="text" name="name"class="form-control" required="" placeholder="Type something" data-parsley-id="34">	
													</div>

													<div class="form-group">	
														<label>Category</label>		
														<select class="form-control" required name="parentCategory" id="parentCategory">
															<option value="">
																-- Select Category --
															</option>
															<?php
															$categorySql=mysqli_query($con, "SELECT cid,name from `tbl_category` where status=1 and parentCategory=0");
															while($categoryLine=mysqli_fetch_array($categorySql)) {
															?>
															<option value="<?php echo $categoryLine['cid'];?>">
																<?php echo $categoryLine['name'];?>
															</option>
															<?php } ?>
														</select>
													</div>	
																									
													<div class="form-group clearfix">
														<label>Image</label>			
														<div class="col-sm-12 row">			
															<label for="a" class="ace-file-input">	
																<span class="ace-file-container" data-title="Choose">
																	<span class="ace-file-name" data-title="No File ...">		
																		<i class=" ace-icon fa fa-upload" style="font-size: 100px; cursor: pointer;"></i>						
																	</span>
																	<i class="fa fa-arrow-left" style="margin-left:0px;" aria-hidden="true">
																		Click here to upload
																	</i>	
																</span>	

																<input onchange="readURL(this);" type="file" id="a"  style="display:none;" name="file"/>
																<div id="img-hide">
																	<img alt="Logo Display Here" id="test"  style="display:none;height:140px;width:140px;"/>
																</div>
																<div id="image-error" style="color:red;background-color:#ededed">
																</div>
														</div>								
													</div>						
													<button type="submit" name="submit" class="btn btn-primary waves-effect waves-light" id="final-submit" disabled>
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

							<div class="col-xs-12 col-md-7">						
								<div class="card-box table-responsive">		
									<h4 class="m-t-0 header-title"><b>Sub-Category Table</b></h4>								
									<div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap4 no-footer">				
										<div class="row">
											<div class="col-md-12">
												<table id="datatable" class="table table-striped table-bordered no-footer" role="grid" aria-describedby="datatable_info">									
													<thead>
														<tr role="row">	
															<th rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 5%;">	#
															</th>

															<th rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 7%;" id="del">
																<i class="fa fa-trash fa-2x"></i>
															</th>

															<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 20%;">Image</th>

															<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 29%;">Name</th>

															<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 29%;">Parent</th>

															<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 10%;">Action</th>

														</tr>								
													</thead>									
													<tbody id="pbody">
													<?php
													$data = mysqli_query($con,"SELECT * from `tbl_category` where  parentCategory!=0 order by cid asc");
													$i=1;
													$num = mysqli_num_rows($data);
													if($num>0){
													while($result = mysqli_fetch_array($data)) {

														$parentCategoryName=_categoryNameFunction($result['parentCategory']);
													?>									
													<tr role="row" class="odd">
														<form method="POST">		
														<td class="sorting_1" style="width: 5%;">
															<?php echo $i; $i++;?>.
														</td>	
														<td style="width: 7%;">	
															<div class="checkbox checkbox-danger checkbox-circle">
																<input id="checkbox-12" type="checkbox" name="check[]" value="<?php echo $result["cid"]; ?>">
																<label for="checkbox-12"></label>
															</div>
														</td>	
														<td style="width: 20%;">
															
															<img src="control/<?php echo $result['imageName'];?>" style="border-radius:8px" id="view-image" width="50px" height="50px" title="Click to View Image">
														
															&nbsp;&nbsp;
															<a href="control/editimage.php?id=<?php echo $result["cid"];?>&table=tbl_category&field=imageName" onclick="window.open(this.href,'UPDATE','width=900,height=700'); return false">
																<span style="width:50px;height:50px;">

																	<i class="fa fa-pencil-square-o" aria-hidden="true" style="color:green;font-size:14px;"></i>
																</span>
															</a>
														</td>										
														<td style="width: 29%;">
															<?php echo $result['name']; ?>&nbsp;&nbsp;
															<a data-toggle="tooltip" data-placement="top" title="Edit" href="edittext.php?id=<?php echo $result["cid"];?>&table=tbl_category&field=name" onclick="window.open(this.href,'UPDATE','width=900,height=700'); return false">
																<span style="width:50px;height:50px;">
																	<i class="fa fa-pencil-square-o" aria-hidden="true" style="color:green;font-size:14px;"></i>
																</span>
															</a>
														</td>

														<td style="width: 29%;">

															<?php echo $parentCategoryName; ?>&nbsp;&nbsp;
															<a data-toggle="tooltip" data-placement="top" title="Edit" href="edit-parent-category.php?id=<?php echo $result["cid"];?>&table=tbl_category&field=parentCategory&cate_id=<?php echo $result['parentCategory'];?>" onclick="window.open(this.href,'UPDATE','width=900,height=700'); return false">
																<span style="width:50px;height:50px;">
																	<i class="fa fa-pencil-square-o" aria-hidden="true" style="color:green;font-size:14px;"></i>
																</span>
															</a>
														</td>

														<td style="width: 10%;">
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
														<td colspan="6" style="height: 20px;">
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
					data: 'as='+as+'&id='+id+'&type=category',
					success : function(data) {
						alert('Updated');
						/*if(data == '1') {
							$('#statusAlert').trigger('click');
						} else {
							$('#statusAlertDeactivate').trigger('click');
						}*/
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
						data:data+"&table=tbl_category",
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