<?php
session_start();
require_once "../core/core.php";
require_once "image-upload-page.php";

@extract($_REQUEST);

if(isset($_POST['submit']))
{
	$title = $_POST['name'];
	$categoryId = $_POST['categoryId'];
	/*$subCategoryId = $_POST['subCategoryId'];
	$subSubcategoryId = $_POST['subSubcategoryId']='';*/
	$is_featured = isset($_POST['is_featured']);
	$detail = $_POST['detail'];
	$ingredients = $_POST['ingredients'];
	$mainAttrType = $_POST['mainAttrType'];
	$mainAttr = $_POST['mainAttr'];

	$editID = $_POST['editID'];

	$mainAttrTypeCount=count($mainAttrType);
	if($mainAttrTypeCount>0) {
		$mainAttrType=implode(',',$mainAttrType);
	}

	$mainAttrCount=count($mainAttr);
	if($mainAttrCount>0) {
		$mainAttr=implode(',',$mainAttr);
	}

	$pharmaceuticals = $_POST['pharmaceuticals'];
	$pharmaCount=count($pharmaceuticals);
	if($pharmaCount>0) {
		$pharmaceuticals=implode(',',$pharmaceuticals);
	}
	
	$wh='';

	$target_file='images';
	$target_file_thumb='images/thumb';

	if($_FILES['primaryImage']['size']>0) {
		//$imgae_name=_upload_image_file('primaryImage',200,200,$target_file,$target_file_thumb);
		$imgae_name=_upload_image_file('primaryImage',200,200,$target_file);
		$wh.=",primaryImage='$imgae_name'";
	}

	if($_FILES['image1']['size']>0) {
		$imgae_name1=_upload_image_file('image1',200,200,$target_file);
		$wh.=",image1='$imgae_name1'";
	}

	if(!empty($imgae_name) && empty($imgae_name1)){
		$wh.=",image1='$imgae_name'";
	}

	if($_FILES['image2']['size']>0) {
		$imgae_name2=_upload_image_file('image2',200,200,$target_file);
		$wh.=",image2='$imgae_name2'";
	}

	if($_FILES['image3']['size']>0) {
		$imgae_name3=_upload_image_file('image3',200,200,$target_file);
		$wh.=",image3='$imgae_name3'";
	}

	/*if($_FILES['image4']['size']>0) {
		$imgae_name4=_upload_image_file('image4',200,200,$target_file);
		$wh.=",image4='$imgae_name4'";
	}

	if($_FILES['image5']['size']>0) {
		$imgae_name5=_upload_image_file('image5',200,200,$target_file);
		$wh.=",image5='$imgae_name5'";
	}*/

	if(isset($editID) && ($editID!=0)){
		mysqli_query($con,"UPDATE `tbl_product` set title='$title',categoryId='$categoryId',subCategoryId='$subCategoryId',subSubCategoryId='$subSubcategoryId',is_featured='$is_featured',description='$detail',tags='$tags',mainAttrType='$mainAttrType',nameOfAttr='$mainAttr',ipAddress='$ipAddress',last_updated='$curDateTime',ingredients='$ingredients'$wh where cid='$editID'"); 
		$myID=$editID;
		header("Location:../product-inventory.php?prod_id=".base64_encode($myID)."&edit=1");
	} else {
		mysqli_query($con,"INSERT INTO `tbl_product` set title='$title',categoryId='$categoryId',subCategoryId='$subCategoryId',subSubCategoryId='$subSubcategoryId',is_featured='$is_featured',description='$detail',tags='$tags',mainAttrType='$mainAttrType',nameOfAttr='$mainAttr',status='1',post_date='$save_date',ipAddress='$ipAddress',last_updated='$curDateTime',ingredients='$ingredients'$wh"); 
		$myID=mysqli_insert_id($con);
		header("Location:../product-inventory.php?prod_id=".base64_encode($myID));
	}
	
}
?>