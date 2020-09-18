<?php
session_start();
require_once 'admin/core/core.php';
require_once 'admin/core/other-script.php';
@extract($_REQUEST);

if(!isset($_SESSION['sess_clientId'])){
	$_SESSION['sess_clientId']='';
}

if(isset($_POST["st_id"])){ 
    $st_id = $_POST["st_id"];
}

?>
<select id="billing_city_id" name="billing_city_id" title="City" class="validate-select required-entry">
  <option value="">
    Please city
  </option>
  <?php 
  $citySql=mysqli_query($con, "select * from cities where state_id='$st_id' order by city asc");
  while ($cityLine=mysqli_fetch_assoc($citySql)) {
  ?>
  <option value="<?php echo $cityLine['id'];?>">
    <?php echo $cityLine['city'];?>
  </option>
  <?php } ?>
</select>
<span id="billing_city_idError" class="redClr"></span>
