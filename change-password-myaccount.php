<?php
session_start();
require_once 'admin/core/core.php';
require_once 'admin/core/other-script.php';
@extract($_REQUEST);

if(isset($_POST['update_password'])){

    $current_password = strip_tags(trim(mysqli_real_escape_string($con, $_POST['current_password'])));
    $new_password 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['new_password'])));

    $current_password=base64_encode($current_password);
    $new_password=base64_encode($new_password);

    $checkSql=mysqli_query($con, "select cid from `clients` where cid='".$_SESSION['sess_clientId']."' and password='$current_password'");
    $checkNum=mysqli_num_rows($checkSql);

    if($checkNum==0){
    	$_SESSION['sess_msg_err'] = "Sorry current password mismatch.";
    } else {
    	mysqli_query($con, "update `clients` set password='$new_password' where cid='".$_SESSION['sess_clientId']."'");

    	$_SESSION['sess_msg'] = "Password successfully updated.";
    }
    
	header('Location:myaccount.php#cnt');
}
?>