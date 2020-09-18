<?php
session_start();
include "../core/core.php";
include "image-upload-page.php";
@extract($_REQUEST);

if(isset($_POST['submit']))
{
	$staffId = $_POST['staffId'];
	$roleId = $_POST['roleId'];
	$userName = $_POST['userName'];
	$password = $_POST['password'];

	$editID = $_POST['editID'];
	
	if($editID) {
		mysqli_query($con,"UPDATE `user` set staffId='$staffId',roleId='$roleId',userName='$userName',password='$password',ipAddress='$ipAddress',last_updated='$curDateTime' where cid='$editID'"); 
		mysqli_query($con,"UPDATE `login` set username='$userName',password='$password',role='$roleId' where staffId='$staffId'");
	} else {
		
		mysqli_query($con,"INSERT INTO `user` set staffId='$staffId',roleId='$roleId',userName='$userName',password='$password',status='1',post_date='$save_date',ipAddress='$ipAddress',last_updated='$curDateTime'"); 
		mysqli_query($con,"INSERT into `login` set username='$userName',password='$password',status='1',role='$roleId',staffId='$staffId'");
	}
	
	//$myID=mysqli_insert_id($con);
	header("Location:../manage-user.php");
}

?>