<?php
session_start();
if(!isset($_SESSION['login_id']))
	{
		?>
		<script>
		window.location = "login/index.php";
		</script>
		<?php
	}
include 'core/core.php';
include 'core/other-script.php';

if(isset($_GET['update']))
{
	$table=$_GET['table'];
	$cid=$_GET['update'];
	$status=$_GET['status'];
	
		/* mysql_query("UPDATE `$table` SET status= 'deactivate' "); */
	mysqli_query($con,"UPDATE `$table` SET status= '$status' where cid='$cid' ");

}

?>