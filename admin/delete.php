<?php
include 'core/core.php';

$table = $_POST["table"];
foreach ($_POST['check'] as $key => $cid) {
	$sql = mysqli_query($con,"SELECT * from `$table` where cid = '$cid' ");
	
	$x = mysqli_fetch_array($sql);
	if($x['image']){
	unlink('control/'.$x['image']);
	}
    
    if($table=='tbl_product') {
    	mysqli_query($con,"DELETE FROM `$table` WHERE `cid` = '$cid'");
    	mysqli_query($con,"DELETE FROM `tbl_product_inventory` WHERE `prod_id` = '$cid'");
    } else {
    	mysqli_query($con,"DELETE FROM `$table` WHERE `cid` = '$cid'");
    }
    	
}
echo "deleted";
?>