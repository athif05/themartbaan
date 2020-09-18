<?php
include "../core/core.php";

if(isset($_POST["submit"])){
	$update=$_POST["update"];
	$add1 = $_POST["add1"];
	$add2 = $_POST["add2"];
	$add3 = $_POST["add3"];
	$mob = $_POST["mob"];
	$phone = $_POST["phone"];
	$email = $_POST["email"];

	if($update){
	mysqli_query($con,"update `contact` set add1='$add1',add2='$add2',add3='$add3',mob='$mob',phone='$phone',email='$email',status='1'");
	}
	else{
		mysqli_query($con,"insert into `contact`(add1,add2,add3,mob,phone,email,status) values('$add1','$add2','$add3','$mob','$phone','$email','1') ");
	}
	header("Location:../contact.php?myval=1");
}
?>