<?php
include "../core/core.php";

if(isset($_POST["submit"])){
	
	$heading = $_POST["heading"];
	$as = $_POST["as"];
	$st = 'unchecked';
	mysqli_query($con,"update `privacy_policy` set heading='$heading',description='".addslashes($as)."',status='1'");
	
	header("Location:../privacy_policy.php?myval=1");
}
?>