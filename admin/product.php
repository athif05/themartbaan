<?php
session_start();
require_once 'core/core.php';
require_once 'core/other-script.php';
@extract($_REQUEST);

if(!isset($_SESSION['login_id'])) {
?>
	<script>
		window.location = "login/index.php";
	</script>
<?php
}

if(isset($pid)) {
	$prodID=base64_decode($pid);
	$productSql=mysqli_query($con, "SELECT * from `tbl_product` where cid='".$prodID."'");
	$productLine=mysqli_fetch_array($productSql);
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
        <title><?php echo ADMIN_TITLE;?> || Product</title>

        <!-- Switchery css -->
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		
		<!-- Jquery filer css -->
        <link href="assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
       <link href="assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" /> 
        <!-- Modernizr js --> 
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

		function readURL1(input) {		
			if (input.files && input.files[0]) {	
				var reader = new FileReader();	
				reader.onload = function (e) {	
					$('#test1').show();	
					$('#test1').attr('src', e.target.result);	
				}	
				reader.readAsDataURL(input.files[0]);						
			}						
		}

		function readURL2(input) {		
			if (input.files && input.files[0]) {	
				var reader = new FileReader();	
				reader.onload = function (e) {	
					$('#test2').show();	
					$('#test2').attr('src', e.target.result);	
				}	
				reader.readAsDataURL(input.files[0]);						
			}						
		}

		function readURL3(input) {		
			if (input.files && input.files[0]) {	
				var reader = new FileReader();	
				reader.onload = function (e) {	
					$('#test3').show();	
					$('#test3').attr('src', e.target.result);	
				}	
				reader.readAsDataURL(input.files[0]);						
			}						
		}

		function readURL4(input) {		
			if (input.files && input.files[0]) {	
				var reader = new FileReader();	
				reader.onload = function (e) {	
					$('#test4').show();	
					$('#test4').attr('src', e.target.result);	
				}	
				reader.readAsDataURL(input.files[0]);						
			}						
		}

		function readURL5(input) {		
			if (input.files && input.files[0]) {	
				var reader = new FileReader();	
				reader.onload = function (e) {	
					$('#test5').show();	
					$('#test5').attr('src', e.target.result);	
				}	
				reader.readAsDataURL(input.files[0]);						
			}						
		}				
	</script>



	<script type="text/javascript">
	
		$(document).ready(function() {
			
			$("#a").change(function() {
				$("#image-error").text("");
				var filePath=$('#a').val();
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
				if(size>512000 && t==0) {
					$("#image-error").text("* Image size should be less than 500 KB");
					s=1;
				}
				if(s==0 && t==0) {
					$("#final-submit").css("background-color", "green");
					$("#final-submit").removeAttr('disabled'); 
				    $("#test").attr("src",filePath);
				} else{
					$("#img-hide").css("display","none");
				}
			});

			$("#a1").change(function() {
				$("#image-error1").text("");
				var filePath=$('#a1').val();
				var size=$("#a1")[0].files[0].size;
				var t=0;var s=0;var n=0;
				var fileUpload = $("#a1")[0];
				var type=this.files[0].type;
				var imgwidth = $(this).width();
				var imgheight = $(this).height();
				var maxwidth = 300;
				var maxheight = 300;
				var ValidImageTypes = ["image/jpeg", "image/png"];
				if ($.inArray(type, ValidImageTypes) < 0) {
					$("#image-error1").text("* Image should be in JPG/PNG format");
					t=1;
				}
				if(size>512000 && t==0) {
					$("#image-error1").text("* Image size should be less than 500 KB");
					s=1;
				}
				if(s==0 && t==0) {
					/*$("#final-submit").css("background-color", "green");
					$("#final-submit").removeAttr('disabled'); */
				    $("#test1").attr("src",filePath);
				} else{
					$("#img-hide1").css("display","none");
				}
			});

			$("#a2").change(function() {
				$("#image-error2").text("");
				var filePath=$('#a2').val();
				var size=$("#a2")[0].files[0].size;
				var t=0;var s=0;var n=0;
				var fileUpload = $("#a2")[0];
				var type=this.files[0].type;
				var imgwidth = $(this).width();
				var imgheight = $(this).height();
				var maxwidth = 300;
				var maxheight = 300;
				var ValidImageTypes = ["image/jpeg", "image/png"];
				if ($.inArray(type, ValidImageTypes) < 0) {
					$("#image-error2").text("* Image should be in JPG/PNG format");
					t=1;
				}
				if(size>512000 && t==0) {
					$("#image-error2").text("* Image size should be less than 500 KB");
					s=1;
				}
				if(s==0 && t==0) {
					/*$("#final-submit").css("background-color", "green");
					$("#final-submit").removeAttr('disabled'); */
				    $("#test2").attr("src",filePath);
				} else{
					$("#img-hide2").css("display","none");
				}
			});

			$("#a3").change(function() {
				$("#image-error3").text("");
				var filePath=$('#a3').val();
				var size=$("#a3")[0].files[0].size;
				var t=0;var s=0;var n=0;
				var fileUpload = $("#a3")[0];
				var type=this.files[0].type;
				var imgwidth = $(this).width();
				var imgheight = $(this).height();
				var maxwidth = 300;
				var maxheight = 300;
				var ValidImageTypes = ["image/jpeg", "image/png"];
				if ($.inArray(type, ValidImageTypes) < 0) {
					$("#image-error3").text("* Image should be in JPG/PNG format");
					t=1;
				}
				if(size>512000 && t==0) {
					$("#image-error3").text("* Image size should be less than 500 KB");
					s=1;
				}
				if(s==0 && t==0) {
					/*$("#final-submit").css("background-color", "green");
					$("#final-submit").removeAttr('disabled'); */
				    $("#test3").attr("src",filePath);
				} else{
					$("#img-hide1").css("display","none");
				}
			});

			$("#a4").change(function() {
				$("#image-error4").text("");
				var filePath=$('#a4').val();
				var size=$("#a4")[0].files[0].size;
				var t=0;var s=0;var n=0;
				var fileUpload = $("#a4")[0];
				var type=this.files[0].type;
				var imgwidth = $(this).width();
				var imgheight = $(this).height();
				var maxwidth = 300;
				var maxheight = 300;
				var ValidImageTypes = ["image/jpeg", "image/png"];
				if ($.inArray(type, ValidImageTypes) < 0) {
					$("#image-error4").text("* Image should be in JPG/PNG format");
					t=1;
				}
				if(size>512000 && t==0) {
					$("#image-error4").text("* Image size should be less than 500 KB");
					s=1;
				}
				if(s==0 && t==0) {
				    $("#test4").attr("src",filePath);
				} else{
					$("#img-hide4").css("display","none");
				}
			});

			$("#a5").change(function() {
				$("#image-error5").text("");
				var filePath=$('#a5').val();
				var size=$("#a5")[0].files[0].size;
				var t=0;var s=0;var n=0;
				var fileUpload = $("#a5")[0];
				var type=this.files[0].type;
				var imgwidth = $(this).width();
				var imgheight = $(this).height();
				var maxwidth = 300;
				var maxheight = 300;
				var ValidImageTypes = ["image/jpeg", "image/png"];
				if ($.inArray(type, ValidImageTypes) < 0) {
					$("#image-error5").text("* Image should be in JPG/PNG format");
					t=1;
				}
				if(size>512000 && t==0) {
					$("#image-error5").text("* Image size should be less than 500 KB");
					s=1;
				}
				if(s==0 && t==0) { 
				    $("#test5").attr("src",filePath);
				} else{
					$("#img-hide5").css("display","none");
				}
			});
		});
	
		function validate(){
			var n=document.getElementById("check-name").value;
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
                                    <h4 class="page-title">Product</h4> 
									
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div> 
					<div class="row" style="display:"> 
						<div class="col-xs-12 col-md-8 col-md-offset-2">
						<form role="form" method="post" action="control/product.php" enctype="multipart/form-data">
							<input type="hidden" name="editID" value="<?php if(isset($productLine['cid'])) {echo $productLine['cid'];}?>">
							<div class="card-box">
								<h4 class="header-title m-t-0">Add Product</h4>
								<div style="background-color:#ff5d48; color:#fff; padding:5px; border-radius:0px">Instructions  <i class="fa fa-arrow-down"></i></div>
									<div style="background-color:#ededed; color:#000; padding:5px; border-radius:0px; font-size:12px;border:1px solid #ff5d48">
									*Image should be in JPEG/PNG format <br> *Size should be less than 500 KB

									</div>
								<div class="p-20">
									<div class="form-group clearfix" style="border: 1px solid #ccc; border-radius:4px; padding: 5px;">
										<div style="float:left; width:50%;">
											<label>Select Primary Image</label>
											<label for="a" class="ace-file-input">
											<span class="ace-file-container" data-title="Choose">
												<span class="ace-file-name" data-title="No File ...">
												<i class=" ace-icon fa fa-upload" style="font-size: 100px; cursor: pointer;"></i>
												</span><i class="fa fa-arrow-left" aria-hidden="true"> Click here to upload</i>
											</span>
										</div>
										<div style="float:right; width:50%; text-align: center;">
											<input onchange="readURL(this);" type="file" id="a" style="display:none;" name="primaryImage"/>
											<div id="img-hide">
												<img alt="Image Display Here" id="test"  style="display:none;height:90px;width:90px;"/>
											</div>
											<div id="image-error" style="color:red;background-color:#ededed"></div>
											<?php 
											if(!empty($productLine['primaryImage'])) {
											?>
											<img src="control/images/<?php echo $productLine['primaryImage'];?>" style="border-radius:8px" id="view-image" width="150px" height="150px" title="Click to View Image">
											<?php	
											}
											?>
										</div>
									</div>

									<div class="form-group">
										<label>Name</label>
										<input type="text" name="name" id="name" class="form-control" value="<?php if(isset($productLine['title'])) { echo $productLine['title'];}?>" placeholder="Type Name" data-parsley-id="34" required>
									</div>

									<div style="float: left; width: 100%;">
										<div class="form-group" style="float: left; width: 49%;">
											<label>Category</label>
											<select class="form-control" name="categoryId" id="categoryId" required>
												<option value="">-- Select Category --</option>
												<?php
												$categorySql=mysqli_query($con, "SELECT * from `tbl_category` where parentCategory=0 and subParentCategory=0 order by name asc");
												while($categoryLine=mysqli_fetch_array($categorySql)){
												?>
												<option value="<?php echo $categoryLine['cid'];?>" <?php if(isset($productLine['categoryId']) && ($productLine['categoryId']==$categoryLine['cid'])) { echo "selected";}?>>
													<?php echo $categoryLine['name'];?>
												</option>
												<?php } ?>
											</select>
										</div>
										<div class="form-group" style="float: right; width: 49%;margin-top: 33px; text-align: right;">
											<!-- <label>Sub-Category</label>
											<select class="form-control" name="subCategoryId" id="subCategoryId">
												<option value="">-- Select Sub-Category --</option>
												<?php if(isset($productLine['cid'])) { 
												$subCategorySql=mysqli_query($con, "SELECT cid,name from `tbl_category` where status=1 and subParentCategory='".$productLine['categoryId']."' order by name asc");
												while($subCategoryLine=mysqli_fetch_array($subCategorySql)){
												?>
												<option value="<?php echo $subCategoryLine['cid'];?>" <?php if(isset($productLine['subCategoryId']) && ($productLine['subCategoryId']==$subCategoryLine['cid'])) { echo "selected";}?>>
													<?php echo $subCategoryLine['name'];?>
												</option>
												<?php } ?>
												<?php }?>
											</select> -->

											<b><input type="checkbox" name="is_featured" value="1" <?php if(isset($productLine['is_featured']) && ($productLine['is_featured']==1)) { echo "checked";}?>> &nbsp; Featured</b>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label">Description</label>
										<textarea name='detail' id="msg"><?php if(isset($productLine['description'])){echo $productLine['description'];}?></textarea>
										<script>
										CKEDITOR.replace('detail');
										</script>
									</div>

									<div class="form-group">
										<label class="control-label">Ingredients</label>
										<textarea name='ingredients' id="ingredients"><?php if(isset($productLine['ingredients'])){echo $productLine['ingredients'];}?></textarea>
										<script>
										CKEDITOR.replace('ingredients');
										</script>
									</div>

									<!-- <div class="form-group">
										<label>Tags</label>
										<input type="text" name="tags" id="tags" data-role="tagsinput" value="<?php if(isset($productLine['tags'])){echo $productLine['tags'];}?>" class="form-control"  placeholder="Type Name" data-parsley-id="34">
									</div> -->

									<!-- <div style="float: left; width: 100%;">
										<div class="form-group" style="float: left; width: 49%;">
											<label>Current Price</label>
											<input id="check-name" type="text" name="name" class="form-control"  placeholder="Type Name" data-parsley-id="34">
										</div>
										<div class="form-group" style="float: right; width: 49%;">
											<label>Discount Price</label>
											<input id="check-name" type="text" name="name" class="form-control"  placeholder="Type Name" data-parsley-id="34">
										</div>
									</div>

									<div class="form-group">
										<label>Inventory</label>
										<input id="check-name" type="text" name="name" class="form-control"  placeholder="Inventory" data-parsley-id="34">
									</div> -->

									<!-- <input type="text" name="add_attr_div_val[]" id="add_attr_div_val" value="">
									<div class="form-group" id="add_attr_div">
										
									</div> -->

									<div class="clearfix"></div>
									<div class="form-group">
										<a href="javascript(0)" style="float: right; color: black; font-size: 14px;" data-toggle="modal" data-target="#myModal">+ Add Attribute (Weight)</a>
									</div>
								  <!-------add attribute modal---------->

								    <!-- The Modal -->
								  <div class="modal" id="myModal">
								    <div class="modal-dialog">
								      <div class="modal-content">
								      
								        <!-- Modal Header -->
								        <div class="modal-header">
								          <h4 class="modal-title">Add Attribute</h4>
								          <button type="button" class="close" data-dismiss="modal">&times;</button>
								        </div>
								        
										<!-- Modal body -->
										<div class="modal-body">
											<?php

											$r=0;
											$attgrpSql=mysqli_query($con,"SELECT * from `tbl_attribute` group by name");
											while ($attgrpLine=mysqli_fetch_array($attgrpSql)) {
												$r++;
											?>
											<div style="float: left; width: 25%; margin-bottom: 5px;">
												<input type="checkbox" name="mainAttrType[]" class="checked_rates" id="<?php echo $attgrpLine['cid'];?>" value="<?php echo $attgrpLine['name'];?>" <?php if(isset($productLine['mainAttrType']) && ($productLine['mainAttrType']==$attgrpLine['name'])){echo "checked";}?>> &nbsp;<?php echo $attgrpLine['name'];?>
											</div>
											<div style="float: left; width: 2%; margin-bottom: 5px;">
												:
											</div>
											<div style="float: right; width: 73%; margin-bottom: 5px;">
												<?php
												$j=0;
												$attributeSql=mysqli_query($con,"SELECT * from `tbl_attribute` where name='".$attgrpLine['name']."'");
												$attributeNum=mysqli_num_rows($attributeSql);

												if(isset($productLine['nameOfAttr'])){
													$attrigrpName="_".$attgrpLine['name'];

													$nmb=str_replace($attrigrpName,'',$productLine['nameOfAttr']);

													$exp=explode(',',$nmb);
												}
												
												/*$cnt=count($exp);
												for($k=0;$k<$cnt;$k++) {
													$exp[$k];
												}*/

												?>
												<input type="hidden" name="nameOfAttr" value="<?php echo $attributeNum;?>" id="noOfAttr<?php echo $attgrpLine['cid'];?>">
												<?php while ($attributeLine=mysqli_fetch_array($attributeSql)) {
													$j++;
												?>
												<input type="checkbox" name="mainAttr[]" class="checked_ratesPlan checked_ratesPlan_<?php echo $attgrpLine['cid'];?>" id="checked_ratesPlan<?php echo $attgrpLine['cid'];?><?php echo $j;?>" data-id="<?php echo $attgrpLine['cid'];?>" value="<?php echo $attributeLine['cid'];?>_<?php echo $attgrpLine['name'];?>" <?php if(isset($productLine['nameOfAttr']) &&(in_array($attributeLine['cid'], $exp))){ echo "checked";}?>> 
												&nbsp;
												<?php echo $attributeLine['attr_value'];?> 
												&nbsp; &nbsp;
												<?php } ?>
											</div>
											<div class="clearfix"></div>
											<?php } ?>
										</div>
								        
								        <!-- Modal footer -->
								        <div class="modal-footer">
								          <button type="button" class="btn btn-danger" data-dismiss="modal">Submit</button>
								        </div>
								        
								      </div>
								    </div>
								  </div>

								<!--------add attribute modal----------->

									<div class="clearfix"></div>

									<div class="form-group">
										<label>More Images</label>
										<div class="clearfix"></div>
										<div class="form-group clearfix" style="float:
										left; width:49%; border: 1px solid #ccc; border-radius:4px; padding: 5px;">
											<div style="float:left; width:50%;">
												<label>Select Image 1</label>
												<label for="a1" class="ace-file-input">
												<span class="ace-file-container" data-title="Choose">
													<span class="ace-file-name" data-title="No File ...">
													<i class="ace-icon fa fa-upload" style="font-size: 60px; cursor: pointer;"></i>
													</span><i class="fa fa-arrow-up" aria-hidden="true"> Click here to upload</i>
												</span>
											</div>
											<div style="float:right; width:50%; text-align: center;">
												<input onchange="readURL1(this);" type="file" id="a1"  style="display:none;" name="image1"/>
												<div id="img-hide1">
													<img alt="Image Display Here" id="test1"  style="display:none;height:90px;width:90px;"/>
												</div>
												<div id="image-error1" style="color:red;background-color:#ededed"></div>
												<?php 
												if(!empty($productLine['image1'])) {
												?>
												<img src="control/images/<?php echo $productLine['image1'];?>" style="border-radius:8px" id="view-image" width="130px" height="110px" title="Click to View Image">
												<?php	
												}
												?>
											</div>
										</div>

										<div class="form-group clearfix" style="float:
										right; width:49%; border: 1px solid #ccc; border-radius:4px; padding: 5px;">
											<div style="float:left; width:50%;">
												<label>Select Image 2</label>
												<label for="a2" class="ace-file-input">
												<span class="ace-file-container" data-title="Choose">
													<span class="ace-file-name" data-title="No File ...">
													<i class="ace-icon fa fa-upload" style="font-size: 60px; cursor: pointer;"></i>
													</span><i class="fa fa-arrow-up" aria-hidden="true"> Click here to upload</i>
												</span>
											</div>
											<div style="float:right; width:50%; text-align: center;">
												<input onchange="readURL2(this);" type="file" id="a2" style="display:none;" name="image2"/>
												<div id="img-hide2">
													<img alt="Image Display Here" id="test2"  style="display:none;height:90px;width:90px;"/>
												</div>
												<div id="image-error2" style="color:red;background-color:#ededed"></div>
												<?php 
												if(!empty($productLine['image2'])) {
												?>
												<img src="control/images/<?php echo $productLine['image2'];?>" style="border-radius:8px" id="view-image" width="130px" height="110px" title="Click to View Image">
												<?php	
												}
												?>
											</div>
										</div>

										<div class="form-group clearfix" style="float:
										left; width:49%; border: 1px solid #ccc; border-radius:4px; padding: 5px;">
											<div style="float:left; width:50%;">
												<label>Select Image 3</label>
												<label for="a3" class="ace-file-input">
												<span class="ace-file-container" data-title="Choose">
													<span class="ace-file-name" data-title="No File ...">
													<i class="ace-icon fa fa-upload" style="font-size: 60px; cursor: pointer;"></i>
													</span><i class="fa fa-arrow-up" aria-hidden="true"> Click here to upload</i>
												</span>
											</div>
											<div style="float:right; width:50%; text-align: center;">
												<input onchange="readURL3(this);" type="file" id="a3"  style="display:none;" name="image3"/>
												<div id="img-hide3">
													<img alt="Image Display Here" id="test3"  style="display:none;height:90px;width:90px;"/>
												</div>
												<div id="image-error3" style="color:red;background-color:#ededed"></div>
												<?php 
												if(!empty($productLine['image3'])) {
												?>
												<img src="control/images/<?php echo $productLine['image3'];?>" style="border-radius:8px" id="view-image" width="130px" height="110px" title="Click to View Image">
												<?php	
												}
												?>
											</div>
										</div>

										<!--<div class="form-group clearfix" style="float:
										right; width:49%; border: 1px solid #ccc; border-radius:4px; padding: 5px;">
											<div style="float:left; width:50%;">
												<label>Select Image 4</label>
												<label for="a4" class="ace-file-input">
												<span class="ace-file-container" data-title="Choose">
													<span class="ace-file-name" data-title="No File ...">
													<i class="ace-icon fa fa-upload" style="font-size: 60px; cursor: pointer;"></i>
													</span><i class="fa fa-arrow-up" aria-hidden="true"> Click here to upload</i>
												</span>
											</div>
											<div style="float:right; width:50%; text-align: center;">
												<input onchange="readURL4(this);" type="file" id="a4"  style="display:none;" name="image4"/>
												<div id="img-hide4">
													<img alt="Image Display Here" id="test4"  style="display:none;height:90px;width:90px;"/>
												</div>
												<div id="image-error4" style="color:red;background-color:#ededed"></div>
												<?php 
												if(!empty($productLine['image4'])) {
												?>
												<img src="control/images/<?php echo $productLine['image4'];?>" style="border-radius:8px" id="view-image" width="130px" height="110px" title="Click to View Image">
												<?php	
												}
												?>
											</div>
										</div>-->

										<!--<div class="form-group clearfix" style="float:
										left; width:49%; border: 1px solid #ccc; border-radius:4px; padding: 5px;">
											<div style="float:left; width:50%;">
												<label>Select Image 5</label>
												<label for="a5" class="ace-file-input">
												<span class="ace-file-container" data-title="Choose">
													<span class="ace-file-name" data-title="No File ...">
													<i class="ace-icon fa fa-upload" style="font-size: 60px; cursor: pointer;"></i>
													</span><i class="fa fa-arrow-up" aria-hidden="true"> Click here to upload</i>
												</span>
											</div>
											<div style="float:right; width:50%; text-align: center;">
												<input onchange="readURL5(this);" type="file" id="a5"  style="display:none;" name="image5"/>
												<div id="img-hide5">
													<img alt="Image Display Here" id="test5" style="display:none;height:90px;width:90px;"/>
												</div>
												<div id="image-error5" style="color:red;background-color:#ededed"></div>
												<?php 
												if(!empty($productLine['image5'])) {
												?>
												<img src="control/images/<?php echo $productLine['image5'];?>" style="border-radius:8px" id="view-image" width="130px" height="110px" title="Click to View Image">
												<?php	
												}
												?>
											</div>
										</div>-->
									</div>

									<div class="clearfix"></div>
									
									<button type="submit" name="submit" class="btn btn-primary waves-effect waves-light" id="final-submit">
										<span class="btn-label"><i class="fa fa-check"></i>
										</span>Submit
									</button>

									<button type="button" name="cancel" class="btn btn-danger waves-effect waves-light" onclick="location.href='product-list.php'">
										<span class="btn-label"><i class="fa fa-close"></i>
										</span>Cancel
									</button>

								</div>
                                <!-- end row -->
                        	</div>
							</form>
                        </div>
					</div>
                    </div> <!-- container --> 
                </div> <!-- content --> 
            </div>  
            <footer class="footer text-right">
              <?php echo $copy_right;?>
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
		<script src="assets/js/jquery.min.js" type="text/javascript"></script>

		<script type="text/javascript">
			/*multiple tags script, start here */
			(function ($) {
				"use strict";

				var defaultOptions = {
				    tagClass: function(item) {
				      return 'label label-info';
				    },
				    itemValue: function(item) {
				      return item ? item.toString() : item;
				    },
				    itemText: function(item) {
				      return this.itemValue(item);
				    },
				    itemTitle: function(item) {
				      return null;
				    },
				    freeInput: true,
				    addOnBlur: true,
				    maxTags: undefined,
				    maxChars: undefined,
				    confirmKeys: [13, 44],
				    delimiter: ',',
				    delimiterRegex: null,
				    cancelConfirmKeysOnEmpty: true,
				    onTagExists: function(item, $tag) {
				      $tag.hide().fadeIn();
				    },
				    trimValue: false,
				    allowDuplicates: false
				};

			  	/**
			   	* Constructor function
			   	*/
				function TagsInput(element, options) {
				    this.itemsArray = [];
				    this.$element = $(element);
				    this.$element.hide();
				    this.isSelect = (element.tagName === 'SELECT');
				    this.multiple = (this.isSelect && element.hasAttribute('multiple'));
				    this.objectItems = options && options.itemValue;
				    this.placeholderText = element.hasAttribute('placeholder') ? this.$element.attr('placeholder') : '';
				    this.inputSize = Math.max(1, this.placeholderText.length);
				    this.$container = $('<div class="bootstrap-tagsinput"></div>');
				    this.$input = $('<input type="text" placeholder="' + this.placeholderText + '"/>').appendTo(this.$container);
				    this.$element.before(this.$container);
				    this.build(options);
				}

				TagsInput.prototype = {
				    constructor: TagsInput,

				    /**
				     * Adds the given item as a new tag. Pass true to dontPushVal to prevent
				     * updating the elements val()
				    */
				    add: function(item, dontPushVal, options) {
				      var self = this;

				    if (self.options.maxTags && self.itemsArray.length >= self.options.maxTags)
				        return;

				    // Ignore falsey values, except false
				    if (item !== false && !item)
				        return;

				    // Trim value
				    if (typeof item === "string" && self.options.trimValue) {
				        item = $.trim(item);
				    }

				    // Throw an error when trying to add an object while the itemValue option was not set
				    if (typeof item === "object" && !self.objectItems)
				        throw("Can't add objects when itemValue option is not set");

				    // Ignore strings only containg whitespace
				    if (item.toString().match(/^\s*$/))
				        return;

				    // If SELECT but not multiple, remove current tag
				    if (self.isSelect && !self.multiple && self.itemsArray.length > 0)
				        self.remove(self.itemsArray[0]);

				      if (typeof item === "string" && this.$element[0].tagName === 'INPUT') {
				        var delimiter = (self.options.delimiterRegex) ? self.options.delimiterRegex : self.options.delimiter;
				        var items = item.split(delimiter);
				        if (items.length > 1) {
				          for (var i = 0; i < items.length; i++) {
				            this.add(items[i], true);
				          }

				          if (!dontPushVal)
				            self.pushVal();
				          return;
				        }
				    }

				    var itemValue = self.options.itemValue(item),
				        itemText = self.options.itemText(item),
				        tagClass = self.options.tagClass(item),
				        itemTitle = self.options.itemTitle(item);

				    // Ignore items allready added
				    var existing = $.grep(self.itemsArray, function(item) { return self.options.itemValue(item) === itemValue; } )[0];
				      if (existing && !self.options.allowDuplicates) {
				        // Invoke onTagExists
				        if (self.options.onTagExists) {
				          var $existingTag = $(".tag", self.$container).filter(function() { return $(this).data("item") === existing; });
				          self.options.onTagExists(item, $existingTag);
				        }
				        return;
				      }

				      // if length greater than limit
				      if (self.items().toString().length + item.length + 1 > self.options.maxInputLength)
				        return;

				      // raise beforeItemAdd arg
				      var beforeItemAddEvent = $.Event('beforeItemAdd', { item: item, cancel: false, options: options});
				      self.$element.trigger(beforeItemAddEvent);
				      if (beforeItemAddEvent.cancel)
				        return;

				      // register item in internal array and map
				      self.itemsArray.push(item);

				      // add a tag element

				      var $tag = $('<span class="tag ' + htmlEncode(tagClass) + (itemTitle !== null ? ('" title="' + itemTitle) : '') + '">' + htmlEncode(itemText) + '<span data-role="remove"></span></span>');
				      $tag.data('item', item);
				      self.findInputWrapper().before($tag);
				      $tag.after(' ');

				      // add <option /> if item represents a value not present in one of the <select />'s options
				      if (self.isSelect && !$('option[value="' + encodeURIComponent(itemValue) + '"]',self.$element)[0]) {
				        var $option = $('<option selected>' + htmlEncode(itemText) + '</option>');
				        $option.data('item', item);
				        $option.attr('value', itemValue);
				        self.$element.append($option);
				      }

				      if (!dontPushVal)
				        self.pushVal();

				      // Add class when reached maxTags
				      if (self.options.maxTags === self.itemsArray.length || self.items().toString().length === self.options.maxInputLength)
				        self.$container.addClass('bootstrap-tagsinput-max');

				      self.$element.trigger($.Event('itemAdded', { item: item, options: options }));
				    },

				    /**
				     * Removes the given item. Pass true to dontPushVal to prevent updating the
				     * elements val()
				     */
				    remove: function(item, dontPushVal, options) {
				      var self = this;

				      if (self.objectItems) {
				        if (typeof item === "object")
				          item = $.grep(self.itemsArray, function(other) { return self.options.itemValue(other) ==  self.options.itemValue(item); } );
				        else
				          item = $.grep(self.itemsArray, function(other) { return self.options.itemValue(other) ==  item; } );

				        item = item[item.length-1];
				      }

				      if (item) {
				        var beforeItemRemoveEvent = $.Event('beforeItemRemove', { item: item, cancel: false, options: options });
				        self.$element.trigger(beforeItemRemoveEvent);
				        if (beforeItemRemoveEvent.cancel)
				          return;

				        $('.tag', self.$container).filter(function() { return $(this).data('item') === item; }).remove();
				        $('option', self.$element).filter(function() { return $(this).data('item') === item; }).remove();
				        if($.inArray(item, self.itemsArray) !== -1)
				          self.itemsArray.splice($.inArray(item, self.itemsArray), 1);
				      }

				      if (!dontPushVal)
				        self.pushVal();

				      // Remove class when reached maxTags
				      if (self.options.maxTags > self.itemsArray.length)
				        self.$container.removeClass('bootstrap-tagsinput-max');

				      self.$element.trigger($.Event('itemRemoved',  { item: item, options: options }));
				    },

				    /**
				     * Removes all items
				     */
				    removeAll: function() {
				      var self = this;

				      $('.tag', self.$container).remove();
				      $('option', self.$element).remove();

				      while(self.itemsArray.length > 0)
				        self.itemsArray.pop();

				      self.pushVal();
				    },

				    /**
				     * Refreshes the tags so they match the text/value of their corresponding
				     * item.
				     */
				    refresh: function() {
				      var self = this;
				      $('.tag', self.$container).each(function() {
				        var $tag = $(this),
				            item = $tag.data('item'),
				            itemValue = self.options.itemValue(item),
				            itemText = self.options.itemText(item),
				            tagClass = self.options.tagClass(item);

				          // Update tag's class and inner text
				          $tag.attr('class', null);
				          $tag.addClass('tag ' + htmlEncode(tagClass));
				          $tag.contents().filter(function() {
				            return this.nodeType == 3;
				          })[0].nodeValue = htmlEncode(itemText);

				          if (self.isSelect) {
				            var option = $('option', self.$element).filter(function() { return $(this).data('item') === item; });
				            option.attr('value', itemValue);
				          }
				      });
				    },

				    /**
				     * Returns the items added as tags
				     */
				    items: function() {
				      return this.itemsArray;
				    },

				    /**
				     * Assembly value by retrieving the value of each item, and set it on the
				     * element.
				     */
				    pushVal: function() {
				      var self = this,
				          val = $.map(self.items(), function(item) {
				            return self.options.itemValue(item).toString();
				          });

				      self.$element.val(val, true).trigger('change');
				    },

				    /**
				     * Initializes the tags input behaviour on the element
				     */
				    build: function(options) {
				      var self = this;

				      self.options = $.extend({}, defaultOptions, options);
				      // When itemValue is set, freeInput should always be false
				      if (self.objectItems)
				        self.options.freeInput = false;

				      makeOptionItemFunction(self.options, 'itemValue');
				      makeOptionItemFunction(self.options, 'itemText');
				      makeOptionFunction(self.options, 'tagClass');

				      // Typeahead Bootstrap version 2.3.2
				      if (self.options.typeahead) {
				        var typeahead = self.options.typeahead || {};

				        makeOptionFunction(typeahead, 'source');

				        self.$input.typeahead($.extend({}, typeahead, {
				          source: function (query, process) {
				            function processItems(items) {
				              var texts = [];

				              for (var i = 0; i < items.length; i++) {
				                var text = self.options.itemText(items[i]);
				                map[text] = items[i];
				                texts.push(text);
				              }
				              process(texts);
				            }

				            this.map = {};
				            var map = this.map,
				                data = typeahead.source(query);

				            if ($.isFunction(data.success)) {
				              // support for Angular callbacks
				              data.success(processItems);
				            } else if ($.isFunction(data.then)) {
				              // support for Angular promises
				              data.then(processItems);
				            } else {
				              // support for functions and jquery promises
				              $.when(data)
				               .then(processItems);
				            }
				          },
				          updater: function (text) {
				            self.add(this.map[text]);
				            return this.map[text];
				          },
				          matcher: function (text) {
				            return (text.toLowerCase().indexOf(this.query.trim().toLowerCase()) !== -1);
				          },
				          sorter: function (texts) {
				            return texts.sort();
				          },
				          highlighter: function (text) {
				            var regex = new RegExp( '(' + this.query + ')', 'gi' );
				            return text.replace( regex, "<strong>$1</strong>" );
				          }
				        }));
				      }

				      // typeahead.js
				      if (self.options.typeaheadjs) {
				          var typeaheadConfig = null;
				          var typeaheadDatasets = {};

				          // Determine if main configurations were passed or simply a dataset
				          var typeaheadjs = self.options.typeaheadjs;
				          if ($.isArray(typeaheadjs)) {
				            typeaheadConfig = typeaheadjs[0];
				            typeaheadDatasets = typeaheadjs[1];
				          } else {
				            typeaheadDatasets = typeaheadjs;
				          }

				          self.$input.typeahead(typeaheadConfig, typeaheadDatasets).on('typeahead:selected', $.proxy(function (obj, datum) {
				            if (typeaheadDatasets.valueKey)
				              self.add(datum[typeaheadDatasets.valueKey]);
				            else
				              self.add(datum);
				            self.$input.typeahead('val', '');
				          }, self));
				      }

				      self.$container.on('click', $.proxy(function(event) {
				        if (! self.$element.attr('disabled')) {
				          self.$input.removeAttr('disabled');
				        }
				        self.$input.focus();
				      }, self));

				        if (self.options.addOnBlur && self.options.freeInput) {
				          self.$input.on('focusout', $.proxy(function(event) {
				              // HACK: only process on focusout when no typeahead opened, to
				              //       avoid adding the typeahead text as tag
				              if ($('.typeahead, .twitter-typeahead', self.$container).length === 0) {
				                self.add(self.$input.val());
				                self.$input.val('');
				              }
				          }, self));
				        }


				      self.$container.on('keydown', 'input', $.proxy(function(event) {
				        var $input = $(event.target),
				            $inputWrapper = self.findInputWrapper();

				        if (self.$element.attr('disabled')) {
				          self.$input.attr('disabled', 'disabled');
				          return;
				        }

				        switch (event.which) {
				          // BACKSPACE
				          case 8:
				            if (doGetCaretPosition($input[0]) === 0) {
				              var prev = $inputWrapper.prev();
				              if (prev.length) {
				                self.remove(prev.data('item'));
				              }
				            }
				            break;

				          // DELETE
				          case 46:
				            if (doGetCaretPosition($input[0]) === 0) {
				              var next = $inputWrapper.next();
				              if (next.length) {
				                self.remove(next.data('item'));
				              }
				            }
				            break;

				          // LEFT ARROW
				          case 37:
				            // Try to move the input before the previous tag
				            var $prevTag = $inputWrapper.prev();
				            if ($input.val().length === 0 && $prevTag[0]) {
				              $prevTag.before($inputWrapper);
				              $input.focus();
				            }
				            break;
				          // RIGHT ARROW
				          case 39:
				            // Try to move the input after the next tag
				            var $nextTag = $inputWrapper.next();
				            if ($input.val().length === 0 && $nextTag[0]) {
				              $nextTag.after($inputWrapper);
				              $input.focus();
				            }
				            break;
				         default:
				             // ignore
				         }

				        // Reset internal input's size
				        var textLength = $input.val().length,
				            wordSpace = Math.ceil(textLength / 5),
				            size = textLength + wordSpace + 1;
				        $input.attr('size', Math.max(this.inputSize, $input.val().length));
				      }, self));

				      self.$container.on('keypress', 'input', $.proxy(function(event) {
				         var $input = $(event.target);

				         if (self.$element.attr('disabled')) {
				            self.$input.attr('disabled', 'disabled');
				            return;
				         }

				         var text = $input.val(),
				         maxLengthReached = self.options.maxChars && text.length >= self.options.maxChars;
				         if (self.options.freeInput && (keyCombinationInList(event, self.options.confirmKeys) || maxLengthReached)) {
				            // Only attempt to add a tag if there is data in the field
				            if (text.length !== 0) {
				               self.add(maxLengthReached ? text.substr(0, self.options.maxChars) : text);
				               $input.val('');
				            }

				            // If the field is empty, let the event triggered fire as usual
				            if (self.options.cancelConfirmKeysOnEmpty === false) {
				               event.preventDefault();
				            }
				         }

				         // Reset internal input's size
				         var textLength = $input.val().length,
				            wordSpace = Math.ceil(textLength / 5),
				            size = textLength + wordSpace + 1;
				         $input.attr('size', Math.max(this.inputSize, $input.val().length));
				      }, self));

				      // Remove icon clicked
				      self.$container.on('click', '[data-role=remove]', $.proxy(function(event) {
				        if (self.$element.attr('disabled')) {
				          return;
				        }
				        self.remove($(event.target).closest('.tag').data('item'));
				      }, self));

				      // Only add existing value as tags when using strings as tags
				      if (self.options.itemValue === defaultOptions.itemValue) {
				        if (self.$element[0].tagName === 'INPUT') {
				            self.add(self.$element.val());
				        } else {
				          $('option', self.$element).each(function() {
				            self.add($(this).attr('value'), true);
				          });
				        }
				      }
				    },

				    /**
				     * Removes all tagsinput behaviour and unregsiter all event handlers
				     */
				    destroy: function() {
				      var self = this;

				      // Unbind events
				      self.$container.off('keypress', 'input');
				      self.$container.off('click', '[role=remove]');

				      self.$container.remove();
				      self.$element.removeData('tagsinput');
				      self.$element.show();
				    },

				    /**
				     * Sets focus on the tagsinput
				     */
				    focus: function() {
				      this.$input.focus();
				    },

				    /**
				     * Returns the internal input element
				     */
				    input: function() {
				      return this.$input;
				    },

				    /**
				     * Returns the element which is wrapped around the internal input. This
				     * is normally the $container, but typeahead.js moves the $input element.
				     */
				    findInputWrapper: function() {
				      var elt = this.$input[0],
				          container = this.$container[0];
				      while(elt && elt.parentNode !== container)
				        elt = elt.parentNode;

				      return $(elt);
				    }
				  };

				  /**
				   * Register JQuery plugin
				   */
				  $.fn.tagsinput = function(arg1, arg2, arg3) {
				    var results = [];

				    this.each(function() {
				      var tagsinput = $(this).data('tagsinput');
				      // Initialize a new tags input
				      if (!tagsinput) {
				          tagsinput = new TagsInput(this, arg1);
				          $(this).data('tagsinput', tagsinput);
				          results.push(tagsinput);

				          if (this.tagName === 'SELECT') {
				              $('option', $(this)).attr('selected', 'selected');
				          }

				          // Init tags from $(this).val()
				          $(this).val($(this).val());
				      } else if (!arg1 && !arg2) {
				          // tagsinput already exists
				          // no function, trying to init
				          results.push(tagsinput);
				      } else if(tagsinput[arg1] !== undefined) {
				          // Invoke function on existing tags input
				            if(tagsinput[arg1].length === 3 && arg3 !== undefined){
				               var retVal = tagsinput[arg1](arg2, null, arg3);
				            }else{
				               var retVal = tagsinput[arg1](arg2);
				            }
				          if (retVal !== undefined)
				              results.push(retVal);
				      }
				    });

				    if ( typeof arg1 == 'string') {
				      // Return the results from the invoked function calls
				      return results.length > 1 ? results : results[0];
				    } else {
				      return results;
				    }
				  };

				  $.fn.tagsinput.Constructor = TagsInput;

				  /**
				   * Most options support both a string or number as well as a function as
				   * option value. This function makes sure that the option with the given
				   * key in the given options is wrapped in a function
				   */
				  function makeOptionItemFunction(options, key) {
				    if (typeof options[key] !== 'function') {
				      var propertyName = options[key];
				      options[key] = function(item) { return item[propertyName]; };
				    }
				  }
				  function makeOptionFunction(options, key) {
				    if (typeof options[key] !== 'function') {
				      var value = options[key];
				      options[key] = function() { return value; };
				    }
				  }
				  /**
				   * HtmlEncodes the given value
				   */
				  var htmlEncodeContainer = $('<div />');
				  function htmlEncode(value) {
				    if (value) {
				      return htmlEncodeContainer.text(value).html();
				    } else {
				      return '';
				    }
				  }

				  /**
				   * Returns the position of the caret in the given input field
				   * http://flightschool.acylt.com/devnotes/caret-position-woes/
				   */
				  function doGetCaretPosition(oField) {
				    var iCaretPos = 0;
				    if (document.selection) {
				      oField.focus ();
				      var oSel = document.selection.createRange();
				      oSel.moveStart ('character', -oField.value.length);
				      iCaretPos = oSel.text.length;
				    } else if (oField.selectionStart || oField.selectionStart == '0') {
				      iCaretPos = oField.selectionStart;
				    }
				    return (iCaretPos);
				  }

				  /**
				    * Returns boolean indicates whether user has pressed an expected key combination.
				    * @param object keyPressEvent: JavaScript event object, refer
				    *     http://www.w3.org/TR/2003/WD-DOM-Level-3-Events-20030331/ecma-script-binding.html
				    * @param object lookupList: expected key combinations, as in:
				    *     [13, {which: 188, shiftKey: true}]
				    */
				  function keyCombinationInList(keyPressEvent, lookupList) {
				      var found = false;
				      $.each(lookupList, function (index, keyCombination) {
				          if (typeof (keyCombination) === 'number' && keyPressEvent.which === keyCombination) {
				              found = true;
				              return false;
				          }

				          if (keyPressEvent.which === keyCombination.which) {
				              var alt = !keyCombination.hasOwnProperty('altKey') || keyPressEvent.altKey === keyCombination.altKey,
				                  shift = !keyCombination.hasOwnProperty('shiftKey') || keyPressEvent.shiftKey === keyCombination.shiftKey,
				                  ctrl = !keyCombination.hasOwnProperty('ctrlKey') || keyPressEvent.ctrlKey === keyCombination.ctrlKey;
				              if (alt && shift && ctrl) {
				                  found = true;
				                  return false;
				              }
				          }
				      });

				      return found;
				  }

				  /**
				   * Initialize tagsinput behaviour on inputs and selects which have
				   * data-role=tagsinput
				   */
				  $(function() {
				    $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
				  });
				})(window.jQuery);
			/*multiple tags script, end hehe */
			/*category ajax, start here*/
			$('#categoryId').on('change', function() {
				var cnt_ID = $("#categoryId").val();
				$.ajax({
					type:"post",
					url:"category-ajax.php",
					data:"cnt_ID="+cnt_ID,
					success:function(data1) {
						$('#subCategoryId').html(data1);
					}
				});
			});
			/*category ajax, end here*/

			/*subcategory ajax, start here*/
			$('#subCategoryId').on('change', function() {
				var subcnt_ID = $("#subCategoryId").val();
				$.ajax({
					type:"post",
					url:"sub-category-ajax.php",
					data:"cnt_ID="+subcnt_ID,
					success:function(data11) {
						$('#subSubcategoryId').html(data11);
					}
				});
			});
			/*subcategory ajax, end here*/

			/* this line of code is used for, check all attribute value on one click, start here */
			$('.checked_rates').on('change', function() {
                var price_room_id=$(this).attr("id");
                var price_room_idval=$(this).val();
                var no_of_attr=$('#noOfAttr'+price_room_id).val();

                /*var htmlDiv=$('#add_attr_div').html();
                $('#add_attr_div').html(htmlDiv);
                var valDiv=$('#add_attr_div_val').val();
                valDiv=valDiv+','+price_room_idval;
                var valDiv = valDiv.replace(/(^,)|(,$)/g, "");
                $('#add_attr_div_val').val(valDiv);*/

                for(var k=1;k<=no_of_attr;k++) {                	
                	$('#checked_ratesPlan'+price_room_id+k).prop('checked', $(this).prop("checked"));
                } 
            });
            /* this line of code is used for, check all attribute value on one click, end here */



           $('.checked_ratesPlan').change(function(){ //".checkbox" change 
                
                /* this line of code is used for checked and unchecked rooms when we select any one of these room's plans, start here */
                var price_rom_dataId=$(this).attr("data-id");
                var price_rom_id=$(this).attr("id");

                if($('.checked_ratesPlan_'+price_rom_dataId+':checked').length > 0){
                    $('#'+price_rom_dataId).prop('checked',true);
                } else {
                    $('#'+price_rom_dataId).prop('checked',false);                    
                }
                /* this line of code is used for checked and unchecked rooms when we select any one of these room's plans, end here */
            });
		</script>

		<script>
			  $("#del").click(function(){
				var d = confirm("Are you sure you want to delete this row ?")
				var data = $("input:checked").serialize();
				if(d == 1){ // alert(data);
				$.ajax({
				  type:"post",
				  url:"delete.php",
				  data:data+"&table=testimonial",
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