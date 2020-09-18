<?php
session_start();
require_once 'admin/core/core.php';
@extract($_REQUEST);

if(isset($_POST['send'])){

    $username 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['email'])));
    $password 	= strip_tags(trim(mysqli_real_escape_string($con, $_POST['password'])));
    $chck 		= strip_tags(trim(mysqli_real_escape_string($con, $_POST['chck'])));

    $password = base64_encode($password);
    
    $chckSql=mysqli_query($con, "SELECT * from `clients` where (email='$username') and password='$password'");
    $chckNum=mysqli_num_rows($chckSql);
    if($chckNum>0) {
    	$chckLine=mysqli_fetch_array($chckSql);

    	$_SESSION['sess_clientId']=$chckLine['cid'];
        $_SESSION['sess_uname']=$chckLine['fname'];
        $_SESSION['sess_uemail']=$chckLine['email'];
        
        if($chck==1) {
            header('Location:checkout.php');
        } else{
            header('Location:index.php');
        }
    	
    } else {
    	$_SESSION['sess_msg_err']='Sorry, E-mail or password is wrong.';
    	header('Location:login.php');
    }
}
?>