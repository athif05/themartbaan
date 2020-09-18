<?php
session_start();
require_once 'admin/core/core.php';
require_once 'admin/core/other-script.php';
@extract($_REQUEST);

if(!isset($_SESSION['sess_clientId'])){
	$_SESSION['sess_clientId']='';
}

if(isset($_POST["stt_id"])){ 
    $stt_id = $_POST["stt_id"];
}

?>
  <option value="">
    Please city
  </option>
  <?php 
  $shippingCitySql=mysqli_query($con, "select * from cities where state_id='$stt_id' order by city asc");
  while ($shippingCityLine=mysqli_fetch_assoc($shippingCitySql)) {
  ?>
  <option value="<?php echo $shippingCityLine['id'];?>">
    <?php echo $shippingCityLine['city'];?>
  </option>
  <?php } ?>

