<?php
session_start();
require_once 'admin/core/core.php';
require_once 'admin/core/other-script.php';
@extract($_REQUEST);

if(isset($_POST['edit'])){

    $firstname 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['billing_firstname'])));
    $company 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['billing_company'])));
    $telephone 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['billing_telephone'])));
    $street 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['billing_street'])));
    $state_id 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['billing_state_id'])));
    $city_id 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['billing_city_id'])));
    $postcode 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['billing_postcode'])));


    mysqli_query($con, "update clients set fname='$firstname',billing_company='$company',phone='$telephone',billing_street='$street',billing_state_id='$state_id',billing_city_id='$city_id',billing_postcode='$postcode' where cid='".$_SESSION['sess_clientId']."'");

	header('Location:myaccount.php#cnt');
}
?>