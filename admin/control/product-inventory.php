<?php
session_start();
require_once "../core/core.php";
require_once "image-upload-page.php";
@extract($_REQUEST);

if(isset($_POST['submit'])) {

	$prod_id = $_POST['prod_id'];
	$attributeNameId = $_POST['attributeNameId'];
	$currentPrice = $_POST['currentPrice'];
	$discountPrice = $_POST['discountPrice'];
	$inventory = $_POST['inventory'];

	$edit = $_POST['edit'];

	$attributeNameIdCount=count($attributeNameId);
	/*if($attributeNameIdCount>0) {
		$mainAttrType=implode(',',$attributeNameId);
	}*/

	if(isset($edit) && $edit==1){
		mysqli_query($con,"DELETE from `tbl_product_inventory` where prod_id='$prod_id'");
	}

	for($j=0;$j<$attributeNameIdCount;$j++) {

		mysqli_query($con,"INSERT into `tbl_product_inventory` set prod_id='$prod_id',attributeNameId='".$attributeNameId[$j]."',currentPrice='".$currentPrice[$j]."',discountPrice='".$discountPrice[$j]."',inventory='".$inventory[$j]."',status='1',post_date='$save_date',ipAddress='$ipAddress',last_updated='$curDateTime'");
	}

	//header("Location:../product-list.php?prod_id=".base64_encode($myID));
	header("Location:../product-list.php");
}
?>