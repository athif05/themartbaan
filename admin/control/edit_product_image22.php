<?php 
session_start();
include '../core/core.php';
include '../core/other-script.php';
include 'image-upload-page.php';
@extract($_REQUEST);

$cid=$_GET['id']; 
$table=$_GET['table'];  
$field=$_GET['field']; 

if (isset($_POST["submit"])) { 

	$target_file='images';
	
	if($_FILES[$field]['size']>0) {
		$imgae_name=_upload_image_file($field,200,200,$target_file);
		//$wh.=",$field='$imgae_name'";		
		mysqli_query($con,"update $table set $field='$imgae_name' where cid='$cid' ");
	} 
?> 
<script> 
	window.close();
	window.opener.location.reload();
</script> 
<?php } ?> 
<html>

<head> 
<!-- Switchery css -->
        <link href="../assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- App CSS -->
        <link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
		
		<!-- Jquery filer css -->
        <link href="../assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
        <link href="../assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />
		 
        <!-- Modernizr js -->
        <script src="../assets/js/modernizr.min.js"></script>

		<script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','../../www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-79190402-1', 'auto');
          ga('send', 'pageview');

        </script>
	

</head>

<body>

<div class="col-md-6"> 

<form method="POST" enctype="multipart/form-data" >

<?php
	$query=mysqli_query($con,"SELECT $field FROM `$table` WHERE cid='$cid'");
	while($data=mysqli_fetch_array($query)) {
?>
  <div class="col-md-12">
    <div class="col-md-12">
      <label for='a' class="btn btn-success">Choose Image</label>
      <input type="hidden" name="lastimage" value="<?php echo $data[$field];?>" />
      <label for='b' class="btn btn-danger">upload Image</label>
      <div class="col-md-6" style="display:none;">
        <input id="a" type="file" name="<?php echo $field;?>" />
      </div>
    </div>
    <br><br> 
    <div class="col-md-12">
      <div class="col-md-4"> 
        <img src="images/<?php echo $data[$field];?>" style="width:40%;height:40%;" />
      </div>
    </div>
    <div class="col-md-6"  style="display:none;">
      <input id="b" type="submit" class="btn-success" name="submit"/>
    </div> 
  </div> 
<?php } ?>
</form>
</div>
</body>
</html>