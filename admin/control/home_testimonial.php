<?php
session_start();
include "../core/core.php";

if(isset($_POST['submit'])) {

	$t1 = $_POST['name'];

	$t2 = $_POST['detail'];

  $cid = $_POST['cid'];


  if($cid) {

      mysqli_query($con,"UPDATE `testimonial` set heading='$t1',description='$t2' where cid='$cid'"); 
      //$_SESSION['msg']="Added successfully";
      header("Location:../home_testimonial.php");

    } else {
      mysqli_query($con,"INSERT INTO `testimonial` set heading='$t1',description='$t2'"); 
    $_SESSION['msg']="Added successfully";
    header("Location:../home_testimonial.php");
    }


}
?>