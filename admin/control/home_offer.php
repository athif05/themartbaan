<?php
require_once "../core/core.php";

if(isset($_POST["submit"])){
	$update=$_POST["update"];
	$offer = $_POST["offer"];
	$offer2 = $_POST["offer2"];


	if($update){
	mysqli_query($con,"update `home_offer` set offer='$offer',offer2='$offer2'");
	}
	else{
		mysqli_query($con,"insert into `home_offer`(offer,offer2,status) values('$offer','$offer2,'1') ");
	}
	header("Location:../home_offer.php?myval=1");
}
?>