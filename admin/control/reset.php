<?php
include "../core/core.php";

if(isset($_POST["submit"]))
{
	$cpass = $_POST["cpass"];
	$npass = $_POST["npass"];
	
	$s = mysqli_query($con,"select * from login where username='admin'");
	$r = mysqli_fetch_array($s);
	
	$g = $r["password"];
	if($cpass != $g){
		echo "<script>alert('You have entered the wrong current password')</script>";
		?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script>
		window.location = "../resetpassword.php";
		</script>
		<?php
	} else {
		mysqli_query($con,"update login set password = '$npass' where cid='".$r['cid']."'");
		echo "<script>alert('Your Password updated')</script>";
		?>
		<script>
		window.location = "../resetpassword.php";
		</script>
		<?php
	}
}
?>