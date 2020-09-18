<?php
session_start();
require_once 'admin/core/core.php';
require_once 'admin/core/other-script.php';
@extract($_REQUEST);

$save_date=date('Y-m-d');
$ipAddress=$_SERVER['REMOTE_ADDR'];
$curDateTime=date('y-m-d H:i:s');


if(isset($_POST['submit'])){

    $client_id 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['client_id'])));
    $product_id = strip_tags(trim(mysqli_real_escape_string($con, $_POST['product_id'])));
    $review_star= strip_tags(trim(mysqli_real_escape_string($con, $_POST['review_star'])));
    $comment 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['comment'])));
    $author 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['author'])));
    $email 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['email'])));

	mysqli_query($con,"INSERT into `product_review` set client_id='".$client_id."',product_id='".$product_id."',review_star='$review_star',comment='$comment',author='$author',email='$email',status='0',post_date='$save_date',ipAddress='$ipAddress',last_updated='$curDateTime'");

	$_SESSION['sess_msg']='Review successfully submited.';	
	
	header('Location:product-detail.php?pro_id='.md5($product_id).'#reviews_tabs');
}
?>