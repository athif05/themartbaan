<?php
session_start();
include "../core/core.php";
include "image-upload-page.php";
@extract($_REQUEST);

if(isset($_POST['submit']))
{
	$name = ucwords($_POST['name']);
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$address = ucwords($_POST['address']);
	
	$wh='';

	$target_file='images';
	
	if($_FILES['image']['size']>0) {
		//$imgae_name=_upload_image_file('primaryImage',200,200,$target_file,$target_file_thumb);
		$imgae_name=_upload_image_file('image',200,200,$target_file);
		$wh.=",image='$imgae_name'";
	}

	mysqli_query($con,"INSERT INTO `staff` set name='$name',email='$email',phone='$phone',address='$address',status='1',post_date='$save_date',ipAddress='$ipAddress',last_updated='$curDateTime'$wh"); 
	//$myID=mysqli_insert_id($con);
	header("Location:../manage-staff.php");
}

?>