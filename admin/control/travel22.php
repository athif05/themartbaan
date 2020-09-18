<?php
include "../core/core.php";

if(isset($_POST["submit"])){
	
	$heading = $_POST["heading"];
	$as = $_POST["as"];
	$st = 'unchecked';
	mysqli_query($con,"update `travel` set heading='$heading',description='".addslashes($as)."',status='1'");
	
	header("Location:../travel.php?myval=1");
}
?>