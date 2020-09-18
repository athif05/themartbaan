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

$cid=$_GET['id'];
$table=$_GET['table'];

$field=$_GET['field']; 

if (isset($_POST["submit"])) 
{ 
$newtext = mysqli_real_escape_string($con,$_POST['newtext']);
$oldText = mysqli_real_escape_string($con,$_POST['oldText']); 
mysqli_query($con,"UPDATE $table SET $field='$newtext' WHERE $field='$oldText' ");	 
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
   <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App title -->
        <title>Admin || IT Globaliser</title>

        <!-- Switchery css -->
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		
		<!-- Jquery filer css -->
        <link href="assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
        <link href="assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />
		 
        <!-- Modernizr js -->
        <script src="assets/js/modernizr.min.js"></script>

		<script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','../../www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-79190402-1', 'auto');
          ga('send', 'pageview');

        </script>
	<!--<script src="//cdn.ckeditor.com/4.5.10/standard/ckeditor.js"></script>-->

	</head> 
  <body> 
    <div class="col-md-6" style="margin-top: 40px;">  
      <form method="POST" enctype="multipart/form-data" > 
         <?php 
        $sql="SELECT $field FROM `$table` WHERE `cid`='$cid'"; 
      	$query = mysqli_query($con,$sql); 
      	while($data=mysqli_fetch_array($query)) 
      	{ 
	
      ?> 
        <div class="col-md-12"> 
          <input type="hidden" name="oldText" value="<?php echo strip_tags($data[$field]);?>">
		      <textarea name="newtext" class="form-control" rows="6"><?php echo strip_tags($data[$field]);?></textarea>  
            <input type="submit" name="submit" class="btn btn-primary" style="margin-top: 10px;" /> 
        </div> 
      	 <?php } ?> 
      </form> 
    </div> 
<script src="js/jquery.js"></script> 
<script src="bs3/js/bootstrap.min.js"></script> 
<script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script> 
<script src="js/easypiechart/jquery.easypiechart.js"></script> 
<script src="js/sparkline/jquery.sparkline.js"></script> 
<script src="js/iCheck/jquery.icheck.js"></script> 
<script type="text/javascript" src="js/ckeditor/ckeditor.js"></script> 
<!--common script init for all pages--> 
<script src="js/scripts.js"></script> 
<script src="js/icheck-init.js"></script> 
  </body> 
</html>