<?php
session_start();
include 'core/core.php';
include 'core/other-script.php';
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
			<?php include 'include/header.php';?>
			<?php include "include/sidebar.php";?>           
			<!-- Left Sidebar End --> 

			<div class="content-page">    <!-- Start content -->           
				<div class="content">   
					<div class="container">  
						<div class="row">	
							<div class="col-xs-12">		
								<div class="page-title-box">   
									<h4 class="page-title">Product List</h4>
									<div class="clearfix"></div>   
								</div>		
							</div>		
						</div>                        <!-- end row -->	

						<div class="row">

							<div class="col-xs-12 col-md-12">						
								<div class="card-box table-responsive">		
									<h4 class="m-t-0 header-title">
										<b>Product List Table</b>
										<b style="float: right;">
											<a href="category.php" class="addNewBtn" target="_blank">
												<i class="fa fa-cog"></i> Product Setting
											</a>
										</b>
									</h4>							
									<div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap4 no-footer">
									<div style="clear: both; height: 15px;"></div>
									<div style="float: left; width: 100%;">
										<div style="float: left; width: 8%;">
												<button type="button" name="cancel" class="btn btn-success waves-effect waves-light" title="Add New Product" onclick="location.href='product.php'">
													<i class="fa fa-plus"></i> Add
												</button>
											</div>
										<form name="srchFrm" method="post">
											<div style="float: left; width: 40%;">
												<input type="text" name="srchByProductName" id="srchByProductName" value="<?php if(isset($srchByProductName)){ echo $srchByProductName;}?>" class="form-control" placeholder="Product Name / Tag Name" style="width: 98%;" autocomplete="off">
											</div>
											
											<div style="float: left; width: 35%;">
												
												<select class="form-control" name="srchByCategory" id="srchByCategory" style="width:98%; border:1px solid #ccc; height: 34px;">
													<option value="">-- All --</option>
													<?php
													$catSql=mysqli_query($con, "SELECT * from `tbl_category` where status=1 and parentCategory=0 and subParentCategory=0");
													while($catLine=mysqli_fetch_array($catSql)){
													?>
													<option value="<?php echo $catLine['cid'];?>" <?php if(isset($srchByCategory) && ($srchByCategory==$catLine['cid'])){ echo "selected";}?>>
														<?php echo $catLine['name'];?>
													</option>
													<?php } ?>
												</select>
											</div>
											<div style="float: left; width: 8%; text-align: right;">
												<input type="submit" name="submit" value="Search"class="btn btn-primary ">
											</div>

											<div style="float: left; width: 7%; text-align: right;">
												<button type="button" name="cancel" class="btn btn-danger waves-effect waves-light" onclick="location.href='product-list.php'">Clear
												</button>
											</div>
											
										</form>
									</div>
									<div style="clear: both; height: 15px;"></div>			
										<div class="row">
											<div class="col-md-12">
												<table id="datatable" class="table table-striped table-bordered no-footer" role="grid" aria-describedby="datatable_info">									
													<thead>
														<tr role="row">	
															<th rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 5%;">#
															</th>

															<th rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 5%;" id="del">
															<i class="fa fa-trash fa-2x"></i>
															</th>

															<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 10%;">Image</th>

															<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 35%;">Name</th>

															<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 15%;">Inventory</th>

															<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 20%;">Category</th>

															<!-- <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 15%;">Tags</th> -->

															<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 10%;">Action</th>

														</tr>								
													</thead>									
													<tbody id="pbody">
													<?php
													$i=1;
													$start=0;
													if(isset($_GET['start'])) $start=$_GET['start'];
													$pagesize=10;
													if(isset($_GET['pagesize'])) $pagesize=$_GET['pagesize'];
													$order_by='title'; //time_set
													if(isset($_GET['order_by'])) $order_by=$_GET['order_by'];
													$order_by2='asc';
													if(isset($_GET['order_by2'])) $order_by2=$_GET['order_by2'];

													$wh='';
													if(!empty($srchByProductName)) {
														$wh.=" and ((title like ('%$srchByProductName%')) ||(tags like ('%$srchByProductName%')))";
													}
													if(!empty($srchByCategory)) {
														$wh.=" and categoryId='$srchByCategory'";
													}

													$productSql = mysqli_query($con,"SELECT * from `tbl_product` where cid!=''$wh order by $order_by $order_by2 limit $start,$pagesize");
													$reccnt=mysqli_num_rows(mysqli_query($con,"SELECT * from `tbl_product` where cid!=''$wh"));
													?>
													<input type="hidden" name="allRows" id="allRows" value="<?php echo $reccnt;?>">
													<?php
													if($reccnt>0) {

														while($productLine=mysqli_fetch_array($productSql)) {

															$categoryName=_categoryNameFunction($productLine['categoryId']);
															$sub_categoryName=_categoryNameFunction($productLine['subCategoryId']);
													?>
													<tr role="row" class="odd" style="background-color: white;">
														<form method="POST">		
															<td class="sorting_1" style="width: 5%;">
																<?php echo $i+$start; ?>.
															</td>	
															<td style="width: 5%;">	
																<div class="checkbox checkbox-danger checkbox-circle">
																	<input id="checkbox-12" type="checkbox" name="check[]" value="<?php echo $productLine["cid"]; ?>">
																	<label for="checkbox-12"></label>
																</div>
															</td>	
															<td style="width: 10%;">
																<img src="<?php if(isset($productLine['primaryImage'])){?>control/images/<?php echo $productLine['primaryImage'];?><?php } else {?>images/no_image_icon.png<?php }?>" style="border-radius:8px" id="view-image" width="50px" height="50px" title="Click to View Image">
															</td>										
															<td style="width: 35%;">
																<a title="Edit Product" href="product.php?pid=<?php echo base64_encode($productLine["cid"]);?>" style="color:#64b0f2;">
																	<?php echo $productLine['title']; ?>
																</a>
															</td>

															<td style="width: 15%;">
																<?php
																$ttlShowProd=0;
																$ttlProdSql=mysqli_query($con,"SELECT * from `tbl_product_inventory` where prod_id='".$productLine['cid']."'");
																$ttlProdNum=mysqli_num_rows($ttlProdSql);
																while($ttlProdLine=mysqli_fetch_array($ttlProdSql)) {
																	$ttlShowProd=$ttlShowProd+$ttlProdLine['inventory'];
																}

																if($ttlShowProd>0){
																?>
																<a href="javascript:void(0)" onclick="_show_details(<?php echo $i;?>)" title="Expand Inventory" style="float;right; color:green;"> &nbsp;
																	<?php echo $ttlShowProd;?><?php if($ttlProdNum>1){?> - (<?php echo $ttlProdNum;?>)<?php } ?> 
																</a>
															<?php } ?>
															</td>

															<td style="width: 20%;">
																<?php echo $categoryName; ?>
															</td>

															<!--<td style="width: 29%;">
																<?php //echo $sub_categoryName; ?>
															</td>-->

															<!-- <td style="width: 15%;">
																<?php //echo $productLine['tags']; ?>
															</td> -->

															<td style="width: 10%;">
															<?php
															$str1 = '';
															if($productLine['status'] == '1'){
															$str1 = 'checked';
															}
															?>

															<input class="status" dataid="<?php echo $productLine['cid']?>" type="checkbox" data-plugin="switchery" data-color="#3aa99e"  <?php echo $str1;?>/>
															</td>
														</form>
													</tr>
													<tr id="dtl_<?php echo $i;?>" style="display: none;">
														<td colspan="7">
															<table cellpadding="0" cellspacing="0" width="100%;">
																<thead>
																	<th>Weight</th>
																	<th>Price</th>
																	<th>Dis. Price</th>
																	<th>
																		Inventory &nbsp;
																		<a href="product-inventory.php?prod_id=<?php echo base64_encode($productLine['cid'])?>&edit=1" title="Edit Inventory">
																			<span style="width:50px;height:50px;">  
																				<i class="fa fa-pencil-square-o" aria-hidden="true" style="color:green;font-size:14px;"></i>
																			</span>
																		</a>

																	</th>
																</thead>
															<?php
															$productStockSql=mysqli_query($con,"SELECT * from `tbl_product_inventory` where prod_id='".$productLine['cid']."' order by inventory asc");
															while($productStockLine = mysqli_fetch_array($productStockSql)) {

															$attributeSql=mysqli_query($con,"SELECT * from `tbl_attribute` where cid='".$productStockLine['attributeNameId']."'");
															$attributeLine=mysqli_fetch_array($attributeSql);
															?>
																<tbody>
																	<td>
																		<?php echo $attributeLine['attr_value']; ?>
																	</td>
																	<td>
																		<?php echo $productStockLine['currentPrice']; ?>
																	</td>
																	<td>
																		<?php echo $productStockLine['discountPrice']; ?>
																	</td>
																	<td>
																		<?php echo $productStockLine['inventory']; ?>
																	</td>
																</tbody>
															<?php } ?>
															</table>
														</td>
													</tr>							
													<?php $i++;} ?>
													<tr>
														<td colspan="7" style="height: 20px;">
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
			<footer class="footer text-right">2018 &copy; IT Globaliser Noida</footer>     
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
		/*show and hide product inventory details, start here*/
		function _show_details(iddd) {
			var allRw=$('#allRows').val();
			for(var j=1;j<=allRw;j++) {
				if(j!=iddd) {
					$('#dtl_'+j).hide();
				}
			}
			$('#dtl_'+iddd).toggle();
		}
		/*show and hide product inventory details, end here*/

		$('#pbody').on('change','.status', function(){

			var as = '';
			if($(this).is(':checked')) {
				var as = 1;
			}

			var id = $(this).attr('dataid');

			$.ajax({
				method: 'POST',
				url: 'updateStatus.php',
				data: 'as='+as+'&id='+id+'&type=tbl_product',
				success : function(data) {
					//alert('Updated');
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
						data:data+"&table=tbl_product",
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