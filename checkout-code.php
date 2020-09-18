<?php
session_start();
require_once 'admin/core/core.php';
require_once 'admin/core/other-script.php';
@extract($_REQUEST);

$save_date=date('Y-m-d');
$ipAddress=$_SERVER['REMOTE_ADDR'];
$curDateTime=date('y-m-d H:i:s');


if(isset($_POST['finalSubmitBtn'])){

    $firstname 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['billing_firstname'])));
    $email 		= strip_tags(trim(mysqli_real_escape_string($con, $_POST['billing_email'])));
    $company 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['billing_company'])));
    $telephone 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['billing_telephone'])));
    $street 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['billing_street'])));
    $state_id 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['billing_state_id'])));
    $city_id 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['billing_city_id'])));
    $postcode 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['billing_postcode'])));

    $cityName=_cityName($city_id);
    $stateName=_stateName($state_id);
    $clinet_country_name='India';
    
    $use_for_shipping 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['billing_use_for_shipping']))); //1 for same, 0 for different address


    $shipping_firstname 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['shipping_firstname'])));
    $shipping_email 		= strip_tags(trim(mysqli_real_escape_string($con, $_POST['shipping_email'])));
    $shipping_company 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['shipping_company'])));
    $shipping_telephone 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['shipping_telephone'])));
    $shipping_street 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['shipping_street'])));
    $shipping_state_id 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['shipping_state_id'])));
    $shipping_city_id 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['shipping_city_id'])));
    $shipping_postcode 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['shipping_postcode'])));
    
    $shipping_state_name=_stateName($shipping_state_id);
    $shipping_city_name=_cityName($shipping_city_id);

    if($use_for_shipping==0){

    	$shipping_address_id = strip_tags(trim(mysqli_real_escape_string($con, $_POST['shipping_address_id'])));

    	if($shipping_address_id!=999999){
    		$shipping_address_id=$shipping_address_id;
    	} else {
    		mysqli_query($con,"INSERT into `client_shipping_address` set client_id='".$_SESSION['sess_clientId']."',shipping_firstname='$shipping_firstname',shipping_email='$shipping_email',shipping_company='$shipping_company',shipping_telephone='$shipping_telephone',shipping_street='$shipping_street',shipping_state_name='$shipping_state_name',shipping_city_name='$shipping_city_name',shipping_postcode='$shipping_postcode',post_date='$save_date',ipAddress='$ipAddress',last_updated='$curDateTime'");	
			$shipping_address_id=mysqli_insert_id($con);
    	}

    } else if($use_for_shipping==1){

    	mysqli_query($con,"INSERT into `client_shipping_address` set client_id='".$_SESSION['sess_clientId']."',shipping_firstname='$shipping_firstname',shipping_email='$shipping_email',shipping_company='$shipping_company',shipping_telephone='$shipping_telephone',shipping_street='$shipping_street',shipping_state_name='$shipping_state_name',shipping_city_name='$shipping_city_name',shipping_postcode='$shipping_postcode',post_date='$save_date',ipAddress='$ipAddress',last_updated='$curDateTime'");	
		$shipping_address_id=mysqli_insert_id($con);
    }


   $cartSubTotal_save 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['cartSubTotal_save'])));
   $shippingCharge_save   = strip_tags(trim(mysqli_real_escape_string($con, $_POST['shippingTotal_save'])));
   $gstTotal_save   = strip_tags(trim(mysqli_real_escape_string($con, $_POST['gstTotal_save'])));
   $orderTotal_save 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['orderTotal_save'])));

 if($shipping_state_id==$state_id_gst){
    $gst=$gstTotal_save;
    $cgstTax=$gstTotal_save/2;
    $sgstTax=$gstTotal_save/2;
    $igstTax=0;
 } else {
    $gst=$gstTotal_save;
    $igstTax=$gstTotal_save;
    $cgstTax=0;
    $sgstTax=0;
 }

    
	$couponCode_save='';
	$discountAmount_save=0;
	$roundOffBefore=$orderTotal_save;
	$orderTotal_save=round($orderTotal_save);
	$roundOffAmount=number_format((float)($orderTotal_save-$roundOffBefore), 2, '.', '');


	mysqli_query($con,"INSERT into `tbl_order_detail` set clientID='".$_SESSION['sess_clientId']."',session_id='".session_id()."',amount='$cartSubTotal_save',gstTax='$gst',igstTax='$igstTax',cgstTax='$cgstTax',sgstTax='$sgstTax',roundOff='$roundOffAmount',shipping_charge='$shippingCharge_save',finalAmount='$orderTotal_save',couponCode_save='".strtoupper($couponCode_save)."',discountAmount_save='$discountAmount_save',client_name='$firstname',client_email='$email',client_phone='$telephone',client_company_name='$company',client_address='$street',client_city='$cityName',client_state='$stateName',client_country='$clinet_country_name',client_zipcode='$postcode',paymentStatus='0',post_date='$save_date',ipAddress='$ipAddress',last_updated='$curDateTime',use_for_shipping='$use_for_shipping',shipping_address_id='$shipping_address_id'");	
	$order_id=mysqli_insert_id($con);


    $tempProdSql=mysqli_query($con, "SELECT * from `tbl_temp` where ((sessionID = '".session_id()."')||((clientID='".$_SESSION['sess_clientId']."') && (clientID!=0)))");
	while($tempProdLine=mysqli_fetch_array($tempProdSql)) {

		$final_amount=0;
		$final_amount=($tempProdLine['amount']+(($tempProdLine['amount']*$tempProdLine['tax'])/100));

		mysqli_query($con, "INSERT into `tbl_cart` set clientID='".$_SESSION['sess_clientId']."',orderID='$order_id',sessionID='".session_id()."',productID='".$tempProdLine['productID']."',attr='".$tempProdLine['attr']."',rate='".$tempProdLine['rate']."',qnt='".$tempProdLine['qnt']."',amount='".$tempProdLine['amount']."',tax='".$tempProdLine['tax']."',final_amount='".$final_amount."',status='1',post_date='$save_date',ipAddress='$ipAddress',last_updated='$curDateTime'");
	}

	mysqli_query($con, "DELETE from `tbl_temp` where ((sessionID = '".session_id()."')||((clientID='".$_SESSION['sess_clientId']."') && (clientID!=0)))");

	////send to payment gateway.
	////header('Location:payment.php?oid='.base64_encode($order_id));
	header('Location:razorpay/index.php?oid='.base64_encode($order_id));
	///header('Location:index.php');
}
?>