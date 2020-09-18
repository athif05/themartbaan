<?php 
session_start();
require_once '../core/core.php';
require_once '../core/other-script.php';

@extract($_REQUEST);

 $cid=$_GET['id']; 
 $table=$_GET['table'];  
 $field=$_GET['field']; 

if (isset($_POST["submit"])) 
{ 
$target_dir = "images/"; 
$target_file = $target_dir . basename($_FILES["file"]["name"]); 
$additional = '1'; 
while (file_exists($target_file)) 
{ 
    $info = pathinfo($target_file);

    $target_file = $info['dirname'] . '/'

              . $info['filename'] . $additional

              . '.' . $info['extension'];

} 
$uploadOk = 1;

$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION); 
    $check = getimagesize($_FILES["file"]["tmp_name"]);

    if($check != false) {

        echo "File is an image - " . $check["mime"] . ".";

        $uploadOk = 1; 
    } else {

        echo "File is not an image.";

        $uploadOk = 0; 
    } 
if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "JPEG" && $imageFileType != "png" && $imageFileType != "jpeg"

&& $imageFileType != "gif" ) {

    echo 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';

    $uploadOk = 0;

} 
 
if ($uploadOk == 0) {

    echo "<script>alert('Sorry, your file was not uploaded.";

// if everything is ok, try to upload file

} else {

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
		if(isset($_POST['lastimage'])){			$lastimage = $_POST['lastimage'];			
    unlink($lastimage);		}
        echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";

		mysqli_query($con,"update $table set $field='$target_file' where cid='$cid' "); 
    } else {

        echo "<script>alert('Sorry, there was an error uploading your file.";

    } 
}

?> 
		 <script> 
	window.close();

	window.opener.location.reload();

	</script> 
<?php

}

?> 
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
        <input id="a" type="file" name="file" />
      </div>
    </div>
    <br><br> 
    <div class="col-md-12">
      <div class="col-md-4"> 
        <img src="<?php echo $data[$field];?>" style="width:40%;height:40%;" />
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