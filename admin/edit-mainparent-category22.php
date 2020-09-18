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

@extract($_REQUEST);

 $cid=$_GET['id'];
 $table=$_GET['table'];
 $cate_id=$_GET['cate_id'];
 $sub_cate_id=$_GET['sub_cate_id'];

if (isset($_POST["submit"])) 
{ 
	$parentCategory = mysqli_real_escape_string($con,$_POST['parentCategory']);
	$subParentCategory = mysqli_real_escape_string($con,$_POST['subParentCategory']); 
	mysqli_query($con,"UPDATE $table SET parentCategory='$parentCategory',subParentCategory='$subParentCategory' WHERE cid='$cid' ");	 
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
        <link href="assets/plugins/custombox/css/custombox.min.css" rel="stylesheet">	
		<!-- App title -->        
		<title><?php echo ADMIN_TITLE;?> | Category</title>        <!-- Switchery css -->
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
         
        <div class="col-md-12"> 
			<select class="form-control" required name="parentCategory" id="parentCategory" onchange="_cat_ajax(this.value)">
				<option value="">
					-- Select Parent Category --
				</option>
				<?php
				$categorySql=mysqli_query($con, "SELECT cid,name from `tbl_category` where status=1 and parentCategory=0");
				while($categoryLine=mysqli_fetch_array($categorySql)) {
				?>
				<option value="<?php echo $categoryLine['cid'];?>" <?php if($categoryLine['cid']==$cate_id)
				{ echo "selected";}?>>
					<?php echo $categoryLine['name'];?>
				</option>
				<?php } ?>
			</select>  

			<select class="form-control" required name="subParentCategory" id="subParentCategory" style="margin-top: 10px; margin-bottom: 20px;">
				<option value="">
					-- Select Category --
				</option>
				<?php
				$prcategorySql=mysqli_query($con, "SELECT cid,name from `tbl_category` where status=1 and parentCategory='$cate_id' and subParentCategory=0");
				while($prcategoryLine=mysqli_fetch_array($prcategorySql)) {
				?>
					<option value="<?php echo $prcategoryLine['cid'];?>" <?php if($prcategoryLine['cid']==$sub_cate_id)
				{ echo "selected";}?>>
						<?php echo $prcategoryLine['name'];?>
					</option>
				<?php } ?>
			</select>  

            <input type="submit" name="submit" class="btn btn-primary" style="margin-top: 10px;" /> 
        </div> 
      	 
      </form> 
    </div> 
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>        <!-- jQuery  -->        
		<script src="assets/js/jquery.min.js"></script>        
		<script src="assets/js/tether.min.js"></script>
		<!-- Tether for Bootstrap -->        
		<script src="assets/js/bootstrap.min.js"></script>        
		<script src="assets/js/detect.js"></script>       
		<script src="assets/js/fastclick.js"></script>       
		<script src="assets/js/jquery.blockUI.js"></script>       
		<script src="assets/js/waves.js"></script>        
		<script src="assets/js/jquery.nicescroll.js"></script>      
		<script src="assets/js/jquery.scrollTo.min.js"></script>      
		<script src="assets/js/jquery.slimscroll.js"></script>      
		<script src="assets/plugins/switchery/switchery.min.js"></script>	
		<script src="assets/plugins/custombox/js/custombox.min.js"></script>     
		<script src="assets/plugins/custombox/js/legacy.min.js"></script>		<!-- Jquery filer js -->        
		<script src="assets/plugins/jquery.filer/js/jquery.filer.min.js"></script>		<!-- page specific js -->        
		<script src="assets/pages/jquery.fileuploads.init.js"></script>        <!-- App js -->        
		<script src="assets/js/jquery.core.js"></script>        
		<script src="assets/js/jquery.app.js"></script>
		<script src="ajax.js"></script>
<script type="text/javascript">
	/*category ajax, start here*/
	function _cat_ajax(idd) {
		
		url = document.location.href;
        xend = url.lastIndexOf("/") + 1;
        var base_url = url.substring(0, xend);
        url="category-ajax.php";
        if (url.substring(0, 4) != 'http') {
          url = base_url + url;       
        }

        var strSubmit="cnt_ID="+idd;   
        var strURL = url;
      
        document.getElementById('subParentCategory').innerHTML="<img src='images/loding.gif'>";
        var strResultFunc = "displaysubResult_state";
        xmlhttpPost(strURL, strSubmit, strResultFunc)
        return true; 
	}

	function displaysubResult_state(strIn_price) {
        document.getElementById('subParentCategory').innerHTML=strIn_price;
    }

	/*category ajax, end here*/
</script>
  </body> 
</html>