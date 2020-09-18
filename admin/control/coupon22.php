<?php
session_start();
include "../core/core.php";
include "image-upload-page.php";
@extract($_REQUEST);

if(isset($_POST['submit']))
{
	$title = $_POST['title'];
	$couponCode = strtoupper($_POST['couponCode']);
	$startDate = date('Y-m-d',strtotime($_POST['startDate']));
	$endDate = date('Y-m-d',strtotime($_POST['endDate']));
	$discountAmount = $_POST['discountAmount'];
	$discountType = $_POST['discountType'];

	$editID = $_POST['editID'];

	if(isset($editID) && ($editID!=0)){
		mysqli_query($con,"UPDATE `tbl_coupon` set title='$title',couponCode='$couponCode',startDate='$startDate',endDate='$endDate',discountAmount='$discountAmount',discountType='$discountType' where cid='$editID'"); 
	} else {
		mysqli_query($con,"INSERT INTO `tbl_coupon` set title='$title',couponCode='$couponCode',startDate='$startDate',endDate='$endDate',discountAmount='$discountAmount',discountType='$discountType',status='1',post_date='$save_date',ipAddress='$ipAddress',last_updated='$curDateTime'"); 
		///$myID=mysqli_insert_id($con);
	}
	header("Location:../coupon-code.php");
}
?>