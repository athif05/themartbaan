<?php 
session_start();
@extract($_REQUEST); 

unset($_SESSION['sess_clientId']);
unset($_SESSION['sess_uname']);
unset($_SESSION['sess_uemail']);

session_destroy();

header('Location:index.php');
?>