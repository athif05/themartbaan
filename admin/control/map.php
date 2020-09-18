<?php
include "../core/core.php";
@extract($_REQUEST);

if(isset($_POST["submit"])){
	
	$map = mysqli_real_escape_string($con,$_POST["map"]);
	
	$sql=mysqli_query($con, "SELECT * from `map`");
	$numm=mysqli_num_rows($sql);
	if($numm>0) {
		$line=mysqli_fetch_array($sql);
		
		mysqli_query($con,"UPDATE `map` set map='$map' where cid='".$line['cid']."'");
	} else {
	   
		mysqli_query($con,"INSERT INTO `map`(map) VALUES('$map') ");
	}

	header("Location:../map.php");
}

?>