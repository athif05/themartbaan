<?php
session_start();
include("core/core.php");
include 'core/other-script.php';

@extract($_REQUEST);

$staff_ID = $_POST["staff_ID"];

if($staff_ID) {
	$unameSql=mysqli_query($con,"SELECT email from `staff` where cid='".$staff_ID."'");
	$unameLine=mysqli_fetch_array($unameSql);

	echo "`".$unameLine['email'];
} 
?>