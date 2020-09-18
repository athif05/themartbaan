<?php
include "../core/core.php";

if(isset($_POST["submit"])){
	
	$as = $_POST["as"];
	$edit_id = $_POST["edit_id"];
		
	mysqli_query($con,"UPDATE `product_policy` set description='$as',post_date='$curDateTime' where cid='$edit_id'");
	
	header("Location:../product-policy.php");
}

?>