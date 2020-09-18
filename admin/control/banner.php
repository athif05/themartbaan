<?php
include '../core/core.php';

if(isset($_POST['submit']))
{
	$url = $_POST['url'];
	
  $t1 = $_POST['text1'];
  $t2 = $_POST['text2'];
  
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
      if($check !== false) {
          $uploadOk = 1;
      
      } else {
          echo "File is not an image.";
          $uploadOk = 0;
      }

  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "JPG" && $imageFileType != "JPEG"  && $imageFileType != "gif" ) {
      echo 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
      $uploadOk = 0;
  } 
  
  if ($uploadOk == 0) {
      echo "<script>alert('Sorry, your file was not uploaded');</script>";
  } else {
      if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
		  mysqli_query($con,"INSERT INTO `banner` (text1,text2,image,priority,status) VALUES ('$t1','$t2','$target_file','0','1')"); 
      } else{
        echo "<script>alert('Sorry, there was an error uploading your file.";
      }
	}
}
header("Location:$url");
?>