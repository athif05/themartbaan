<?php
$orderStatusArray[]='Pending';
$orderStatusArray[]='New';
$orderStatusArray[]='Processing';
$orderStatusArray[]='Delivered';
$orderStatusArray[]='Cancelled';
$orderStatusArray[]='Return';


$product_gst=18;//in percentage.
$state_id_gst=23;

/*this function is used for calculate gst tax on subtotal amount, start here*/
function _calculate_gst($tx, $amnt){
	$tax_price=array();
	$tax=($amnt*$tx)/100;
	$finalAmount=$amnt+$tax;
	$tax_price[]=$tax;
	$tax_price[]=$finalAmount;
	return $tax_price;
}
/*this function is used for calculate gst tax on subtotal amount, end here*/

/*this function is used for city name, start here*/
function _cityName($cty_id) {
	global $con;
 	$_citySql=mysqli_query($con,"SELECT city from `cities` where id='$cty_id'");
	$_cityLine=mysqli_fetch_array($_citySql);
	$cityName=$_cityLine['city'];
	return $cityName;
}
/*this function is used for city name, end here*/


/*this function is used for state name, start here*/
function _stateName($state_id) {
	global $con;
 	$_stateSql=mysqli_query($con,"SELECT name from `states` where id='$state_id'");
	$_stateLine=mysqli_fetch_array($_stateSql);
	$statName=$_stateLine['name'];
	return $statName;
}
/*this function is used for state name, end here*/



/*this function is used for get total amount of cart item, start here*/
function _totalCartAmount() {
	global $con;
 	$_totalCartAmountSql=mysqli_query($con,"SELECT sum(amount) as amnt from `tbl_temp` where ((sessionID = '".session_id()."')||((clientID='".$_SESSION['sess_clientId']."') && (clientID!=0)))");
	$_totalCartAmountLine=mysqli_fetch_array($_totalCartAmountSql);
	$totalAmount=$_totalCartAmountLine['amnt'];
	return $totalAmount;
}
/*this function is used for get total amount of cart item, end here*/

/*this function is used for get category name, start here*/
 function _categoryNameFunction($c_id) {
 	global $con;
 	$parentCatSql=mysqli_query($con,"SELECT name from `tbl_category` where cid='$c_id'");
	$parentCatLine=mysqli_fetch_array($parentCatSql);
	$resultName=$parentCatLine['name'];
	return $resultName;
 }
 /*this function is used for get category name, end here*/

/*this function is used for count no of product, category, brand, user for show in dashboard, start here */
 function _countNoOfProd($c_tbl) {
 	global $con;
 	if($c_tbl=='tbl_category') {
 		$cntSql=mysqli_query($con,"SELECT count(*) as cn_t from $c_tbl where status=1 and parentCategory=0 and subParentCategory=0");
 	} else if($c_tbl=='tbl_order_detail'){
 		$cntSql=mysqli_query($con,"SELECT count(*) as cn_t from $c_tbl where orderStatus=1");
 	} else {
 		$cntSql=mysqli_query($con,"SELECT count(*) as cn_t from $c_tbl");
 	}
 	
	$cntLine=mysqli_fetch_array($cntSql);
	$cntOfProd=$cntLine['cn_t'];
	return $cntOfProd;
 }
 /*this function is used for count no of product, category, brand, user for show in dashboard, end here */

 /*this function is used for get name of role and staff, start here*/
 function _role_staff_Name($ts_tbl, $rs_id, $rs_clmn) {
 	global $con;
 	$rsSql=mysqli_query($con, "SELECT $rs_clmn from $ts_tbl where cid='".$rs_id."'");
	$rsLine=mysqli_fetch_array($rsSql);

	$rs_name=$rsLine[$rs_clmn];
	return $rs_name;
 }
 /*this function is used for get name of role and staff, end here*/
?>

<script>
/* Only numbers are allowed, start here */
function _isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
}
/* Only numbers are allowed, end here */

/* Only characters are allowed, start here */
function _isAlphabetKey(evt){
	var keyCode = (evt.which) ? evt.which : evt.keyCode
	if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32 && keyCode != 46 && keyCode != 8 && keyCode != 9 && keyCode != 11)
			return false;
	return true;
}
/* Only characters are allowed, end here */

/* Only characters are allowed, start here */
function _isAmountKey(evt){
	var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode!=46)
        return false;
    return true;
}
/* Only characters are allowed, end here */

/* e-mail validation, start here */
function _mail_validate(nm) {
	var atposition=nm.indexOf("@");  
	var dotposition=nm.lastIndexOf(".");  
	if (atposition<1 || dotposition<atposition+2 || dotposition+2>=nm.length){  
		var n=2;
	  } else {
	  	var n=1;
	  }

	  return n;
}
/* e-mail validation, end here */
</script>