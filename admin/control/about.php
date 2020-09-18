<?php
include "../core/core.php";

if(isset($_POST["submit"])){
	
	$heading = $_POST["heading"];
	$as = $_POST["as"];
	
	$st = 'unchecked';
	
	$wh='';
	$edit_id = $_POST["edit_id"];

	mysqli_query($con,"UPDATE `about` set heading='$heading',description='$as',status='1'$wh where cid='$edit_id'");
	
	header("Location:../about.php");
}

?>