<?php
session_start();
include("core/core.php");
include 'core/other-script.php';

@extract($_REQUEST);

$prntId = $_POST["cnt_ID"];

if($prntId) {
?>
	<option value="">
		-- Select Category --
	</option>
	<?php
	$prcategorySql=mysqli_query($con, "SELECT cid,name from `tbl_category` where status=1 and subParentCategory='$prntId'");
	while($prcategoryLine=mysqli_fetch_array($prcategorySql)) {
	?>
		<option value="<?php echo $prcategoryLine['cid'];?>">
			<?php echo $prcategoryLine['name'];?>
		</option>
	<?php } ?>
<?php } ?>