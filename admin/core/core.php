<?php
ini_set('date.timezone', 'Asia/Kolkata');

$con = mysqli_connect("localhost","root","","themartbaan");
//$con = mysqli_connect("localhost","themartbaan","ytE,sRu3C*wK","themartbaan");

$copy_right="2020 The Martbaan (Dadi ka Achaar) All Rights Reserved.";


$drt='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; //get current URL.
$ss=explode('/',$drt); //explode by '/'.
$drt2=count($ss)-1;

$mm=$ss[$drt2];
$nm=explode($mm,$drt);
$urlForBE=$nm[0].'verify-account.php';

define('ADMIN_TITLE', 'The Martbaan Admin');
define('SITE_TITLE', 'The Martbaan Dadi ka Achaar');
define('INVOICE_TITLE', 'The Martbaan Dadi ka Achaar');

$save_date=date('Y-m-d');
$ipAddress=$_SERVER['REMOTE_ADDR'];
$curDateTime=date('y-m-d H:i:s');
?>