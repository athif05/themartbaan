<?php
include "../core/core.php";

if(isset($_POST["submit"])){
	
	$link = $_POST["social"]; 
	$link="http://".$link;
	$hide = $_POST["hide"];  
	mysqli_query($con,"UPDATE `social_links` SET address='$link' WHERE cid='$hide' ");
	
	header("Location:../socialmedia.php");
}

?>