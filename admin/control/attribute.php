<?php
session_start();
include('../core/core.php');

@extract($_REQUEST);

if(isset($_POST['submitAttribute']))
{
	$url = $_POST['url'];
	$name = ucwords($_POST['name']);

	$chckSql=mysqli_query($con, "SELECT * from `tbl_attribute` where name='$name'");
	$chckNum=mysqli_num_rows($chckSql);

	if($chckNum==0) {
		mysqli_query($con, "INSERT into `tbl_attribute` set name='$name',status='1',post_date='$save_date',ipAddress='$ipAddress',last_updated='$curDateTime',editAttr='1'");
		$_SESSION['sess_msg']='Attribute added successfully.';
	} else {
		$_SESSION['sess_msg_err']='Attribute already added.';
	}
		
	header("Location:$url");
}



if(isset($_POST['submit']))
{
	$url = $_POST['url'];
	$name = ucwords($_POST['attributeName']);
	$attr_value = $_POST['attr_value'];
	$vl_array=explode(',',$attr_value);
	$arrayCnt=count($vl_array);

	for($i=0;$i<$arrayCnt;$i++) {

		$chckSql=mysqli_query($con, "SELECT * from `tbl_attribute` where name='$name'");
		$chckLine=mysqli_fetch_array($chckSql);

		if($chckLine['attr_value']=='') { 
			mysqli_query($con,"UPDATE `tbl_attribute` set name='$name',attr_value='".strtoupper($vl_array[$i])."',status='1',post_date='$save_date',ipAddress='$ipAddress',last_updated='$curDateTime' where cid='".$chckLine['cid']."'");
		} else {
			mysqli_query($con,"INSERT INTO `tbl_attribute` (name,attr_value,status,post_date,ipAddress,last_updated) VALUES ('$name','".strtoupper($vl_array[$i])."','1','$save_date','$ipAddress','$curDateTime')");
		}
	}
	
	$_SESSION['sess_msga']='Value added successfully.';

	header("Location:$url");
}
?>