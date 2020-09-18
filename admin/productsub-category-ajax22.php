<?php
session_start();
include("core/core.php");
include 'core/other-script.php';

@extract($_REQUEST);

$prntId2 = $_POST["cnt_ID2"];

if($prntId2) {
?>
	<option value="">
		-- Select Sub SubCategory --
	</option>
	<?php
	$subsubcategorySql=mysqli_query($con, "SELECT cid,name from `tbl_category` where status=1 and subParentCategory='$prntId2'");
	while($subsubcategoryLine=mysqli_fetch_array($subsubcategorySql)) {
	?>
		<option value="<?php echo $subsubcategoryLine['cid'];?>">
			<?php echo $subsubcategoryLine['name'];?>
		</option>
	<?php } ?>
<?php } ?>