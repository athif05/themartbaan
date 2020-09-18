<?php
include 'core/core.php';

$table = $_POST["table"];

foreach ($_POST['check'] as $key => $cid) {
	$sql = mysqli_query($con,"SELECT * from `$table` where cid = '$cid' ");
	$x = mysqli_fetch_array($sql);

    mysqli_query($con,"DELETE FROM `$table` WHERE `cid` = '$cid'");
    mysqli_query($con,"DELETE FROM `login` WHERE staffId='".$x['staffId']."'");
}
echo "deleted";
?>