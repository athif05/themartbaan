<?php
include('../core/core.php');

if(isset($_POST['submit'])) {
	$url = $_POST['url'];
	$t1 = ucwords($_POST['text1']);
		
	mysqli_query($con,"INSERT INTO `role` (name,status,post_date,ipAddress,last_updated) VALUES ('$t1','1','$save_date','$ipAddress','$curDateTime')"); 

	header("Location:$url");
}
?>