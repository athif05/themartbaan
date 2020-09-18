<?php
include('../core/core.php');

if(isset($_POST['submit']))
{
	
	$menus = $_POST['menus'];
	$cnt=count($menus);
	
	if($cnt>0) {
		$menus=implode(',',$menus);	
	}

	$sql=mysqli_query($con, "SELECT * from `menu_categories`");
	$numm=mysqli_num_rows($sql);

	if($numm>0) {
		$line=mysqli_fetch_array($sql);
		mysqli_query($con,"UPDATE `menu_categories` set categoriesId='$menus' where cid='".$line['cid']."'");
	} else {
		mysqli_query($con,"INSERT INTO `menu_categories` (categoriesId,post_date,ipAddress,last_updated) VALUES ('$menus','$save_date','$ipAddress','$curDateTime')"); 	
	}
	
	header("Location:../menu-categories.php");
}
?>