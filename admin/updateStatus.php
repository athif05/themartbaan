<?php
session_start();
include("core/core.php");

$as = $_POST['as'];
$id = $_POST['id'];
$type = $_POST['type'];
$flag = '';

if($type == 'category') {

	mysqli_query($con,"UPDATE `tbl_category` SET `status` = '$as' where `cid`='$id' ");
	$data = mysqli_fetch_array(mysqli_query($con,"SELECT * from `tbl_category` where `cid`='$id'"));
	if($data['status'] == 1){
		$flag = 1;
	}

} else if($type == 'brand') {

	mysqli_query($con,"UPDATE `tbl_brand` SET `status` = '$as' where `cid`='$id' ");
	$data = mysqli_fetch_array(mysqli_query($con,"select * from `tbl_brand` where `cid`='$id'"));

	if($data['status'] == 1){
		$flag = 1;
	}

} else if($type == 'attribute') {

	mysqli_query($con,"UPDATE `tbl_attribute` SET `status` = '$as' where `cid`='$id' ");
	$data = mysqli_fetch_array(mysqli_query($con,"select * from `tbl_attribute` where `cid`='$id'"));
	if($data['status'] == 1){
		$flag = 1;
	}
} else if($type == 'tbl_product') {

	mysqli_query($con,"UPDATE `tbl_product` SET `status` = '$as' where `cid`='$id' ");
	$data = mysqli_fetch_array(mysqli_query($con,"select * from `tbl_product` where `cid`='$id'"));
	if($data['status'] == 1){
		$flag = 1;
	}
} else if($type == 'banner') {

	mysqli_query($con,"UPDATE `banner` SET `status` = '$as' where `cid`='$id' ");
	$data = mysqli_fetch_array(mysqli_query($con,"select * from `banner` where `cid`='$id'"));
	if($data['status'] == 1){
		$flag = 1;
	}
} else if($type == 'listing_slider') {

	mysqli_query($con,"UPDATE `listing_slider` SET `status` = '$as' where `cid`='$id' ");
	$data = mysqli_fetch_array(mysqli_query($con,"select * from `listing_slider` where `cid`='$id'"));
	if($data['status'] == 1){
		$flag = 1;
	}
} else if($type == 'listing_sidebar_slider') {

	mysqli_query($con,"UPDATE `listing_sidebar_slider` SET `status` = '$as' where `cid`='$id' ");
	$data = mysqli_fetch_array(mysqli_query($con,"select * from `listing_sidebar_slider` where `cid`='$id'"));
	if($data['status'] == 1){
		$flag = 1;
	}
} else if($type == 'user') {

	mysqli_query($con,"UPDATE `user` SET `status` = '$as' where `cid`='$id' ");
	$data = mysqli_fetch_array(mysqli_query($con,"select * from `user` where `cid`='$id'"));

	mysqli_query($con, "UPDATE `login` set status='$as' where staffId='".$data['staffId']."'");

	if($data['status'] == 1) {
		$flag = 1;
	}
} else if($type == 'newsletter') {

	mysqli_query($con,"UPDATE `newsletter` SET `status` = '$as' where `cid`='$id' ");
	$data = mysqli_fetch_array(mysqli_query($con,"select * from `newsletter` where `cid`='$id'"));

	if($data['status'] == 1) {
		$flag = 1;
	}
} else if($type == 'clients') {

	mysqli_query($con,"UPDATE `clients` SET `status` = '$as' where `cid`='$id' ");
	$data = mysqli_fetch_array(mysqli_query($con,"select * from `clients` where `cid`='$id'"));

	if($data['status'] == 1) {
		$flag = 1;
	}
} else if($type == 'testimonial') {

	mysqli_query($con,"UPDATE `testimonial` SET `status` = '$as' where `cid`='$id' ");
	$data = mysqli_fetch_array(mysqli_query($con,"select * from `testimonial` where `cid`='$id'"));

	if($data['status'] == 1) {
		$flag = 1;
	}
}
echo $flag;
?>