<?php
include 'core/core.php';

$order_id = $_POST["order_id"];
$status_id = $_POST["status_id"];


mysqli_query($con, "UPDATE `tbl_order_detail` set orderStatus='$status_id' where id='$order_id'");

echo "deleted";
?>