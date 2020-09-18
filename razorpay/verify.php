<?php
session_start();
include("../admin/core/core.php");
require('config.php');

require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}


if ($success === true)
{   
    $_SESSION['tid']=$_POST['razorpay_payment_id'];
    
    mysqli_query($con, "UPDATE `payment` SET `status` = '1', `transaction_id` = '".$_POST['razorpay_payment_id']."' WHERE `payment_id` = '".$_POST['razorpay_order_id']."'");
    
    $ordIdSql=mysqli_query($con,"SELECT order_id from `payment`  WHERE `payment_id` = '".$_POST['razorpay_order_id']."'");
    $ordIdLine=mysqli_fetch_array($ordIdSql);
    
    $ordr_id=$ordIdLine['order_id'];
    $transactionID=$_POST['razorpay_payment_id'];
    mysqli_query($con, "UPDATE `tbl_order_detail` set paymentStatus='1',transactionID='$transactionID',orderStatus=1 where id='$ordr_id'");

    $inv=0;
    $cartSql=mysqli_query($con,"SELECT * from `tbl_cart` where orderID='$ordr_id'");
    while($cartLine=mysqli_fetch_array($cartSql)) {
        $inv=$cartLine['qnt'];
        mysqli_query($con,"UPDATE `tbl_product_inventory` set inventory=(`inventory`-$inv) where prod_id='".$cartLine['productID']."' and attributeNameId='".$cartLine['attr']."'");
    }

    header("location:../order-success-msg.php?oid=".base64_encode($ordr_id)); exit();

} 
else
{
    //$html = "<p>Your payment failed</p>
            // <p>{$error}</p>";
               // print_r($_POST); die;
header("location:../failed.php"); exit();
}

