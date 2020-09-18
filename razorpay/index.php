<?php
session_start();
require_once '../admin/core/core.php';
require('config.php');
require('razorpay-php/Razorpay.php');
@extract($_REQUEST);


$time=date('h:i:s a');
$date=date('Y-m-d'); 
$receipt=mt_rand();

$oid=base64_decode($oid);
$ordDtklSql=mysqli_query($con,"SELECT * from `tbl_order_detail` where id='$oid'");
$ordDtklLine=mysqli_fetch_array($ordDtklSql);

$name=$ordDtklLine['client_name'];
$email=$ordDtklLine['client_email'];
$mbl_number=$ordDtklLine['client_phone'];
$net_amount=$ordDtklLine['finalAmount'];

mysqli_query($con, "INSERT INTO `payment` set order_id='$oid',`name`='".$name."',`email`='".$email."',`mobile`='".$mbl_number."',`netamount`='".$net_amount."',`time`='".$time."',`date`='".$date."',`reciptid`='".$receipt."'");
$last_id = mysqli_insert_id($con);
    
    
// Create the Razorpay Order
use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);

//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//
$orderData = [
    'receipt'         => $receipt,
    'amount'          => $net_amount * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);
//print_r($razorpayOrder); die;

$razorpayOrderId = $razorpayOrder['id'];

mysqli_query($con, "UPDATE `payment` SET `payment_id` = '".$razorpayOrderId."' WHERE `id` = ".$last_id."");

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];


if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$checkout = 'automatic';

$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => "themartbaan",
    "description"       => "Online Payment",
    "image"             => "logo.png",
    "prefill"           => [
    "name"              => $name,
    "email"             => $email,
    "contact"           => $mbl_number,
    ],
    "notes"             => [
    "address"           => "Hello World",
    "merchant_order_id" => $receipt,
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];


if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);

//print_r($data); die;
require("checkout/{$checkout}.php");
?>