<?php 
require_once 'core/core.php';
require_once 'core/other-script.php';

session_start();
if(!isset($_SESSION['login_id'])) {
?>
<script>
	window.location = "login/index.php";
</script>
<?php
}

if(isset($_GET['cid'])) { 
	$cid=base64_decode($_GET['cid']);
	$postSql=mysqli_query($con, "SELECT * from `testimonial` where cid='$cid'");
	$postLine=mysqli_fetch_array($postSql);
}

?>
<!DOCTYPE html>
<html> 
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.png">

        <!-- App title -->
        <title><?php echo ADMIN_TITLE;?> || Testimonial</title>

        <!-- Switchery css -->
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		
		<!-- Jquery filer css -->
        <link href="assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
       <link href="assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" /> 
        <!-- Modernizr js --> 
        <script src="assets/js/modernizr.min.js"></script> 

	<script src="//cdn.ckeditor.com/4.5.10/standard/ckeditor.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	

	<script type="text/javascript">
		
	function validate(){
		var n=document.getElementById("check-name").value;
	    n=n.trim()
		if(n==''){	
		
		alert("Please fill all the fields");
		return false;
		}
		else{
			
			return true;
		}
	}

	</script>	
    </head> 
    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            <?php include 'include/header.php';?>
            <?php include "include/sidebar.php";?>
            <!-- Left Sidebar End --> 
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container"> 
                        <div class="row">
							<div class="col-xs-12">

								<div class="page-title-box">
                                    <h4 class="page-title">Testimonial</h4> 
									
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div> 
					<div class="row" style="display:<?php if(isset($postLine['cid'])) {echo "block";} else { echo "none"; }?>;"> 
						<div class="col-xs-12 col-md-8 col-md-offset-2">
						<form role="form" method="POST" action="control/home_testimonial.php" enctype="multipart/form-data" onSubmit="return validate(this)">
							<input type="hidden" name="cid" value="<?php if(isset($postLine['cid'])){echo $postLine['cid'];}?>">
							<div class="card-box">
								
								<div class="p-20">
									
									<div class="form-group">
										<label>Name</label>
										<input id="check-name" type="text" name="name" class="form-control" placeholder="Type Name" data-parsley-id="34" value="<?php if(isset($postLine['heading'])){ echo $postLine['heading'];}?>">
									</div>
									<div class="form-group">
										<label class="control-label">Enter Message</label>
										<textarea name='detail' id="msg"><?php if(isset($postLine['description'])){ echo $postLine['description'];}?></textarea>
										<script>
										CKEDITOR.replace('detail');
										</script>
									</div>
										<button type="submit" name="submit" class="btn btn-primary waves-effect waves-light" id="final-submit">
											   <span class="btn-label"><i class="fa fa-check"></i>
											   </span>Submit
										</button>
								</div>
								
                                <!-- end row -->
                        	</div>
							</form>
                        </div>
						
							</div>
							
						<div class="col-xs-12 col-md-12">
							<form role="form" method="POST" enctype="multipart/form-data">
							<div class="card-box table-responsive">
								<h4 class="m-t-0 header-title"><b>Testimonial</b></h4>
								<div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap4 no-footer">
								<div class="row"><div class="col-md-12"><table id="datatable" class="table table-striped table-bordered no-footer" role="grid" aria-describedby="datatable_info">
									<thead>
										<tr role="row">
											<th rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 30px;">Sr. No.</th>
											<th id="del" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 40px;">
												<i class="fa fa-trash fa-2x"></i>
											</th>
											
											<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 140px;">Name</th>
											<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 340px;">Reviews</th>
											<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 290px;">Approval</th>
											 
										</tr>
									</thead>
									<tbody id="pbody">
										<?php
											$i=0;                     
											$res = mysqli_query($con,"SELECT * FROM testimonial");
											while ($x = mysqli_fetch_array($res))
											{
											$i++;
										?>
									<tr role="row" class="odd">
										<td class="sorting_1"><?php echo $i; ?>.</td>
										<td>
											<div class="checkbox checkbox-danger checkbox-circle">
												<input id="checkbox-12" type="checkbox" name="check[]" value="<?php echo $x["cid"]; ?>">
												<label for="checkbox-12"></label>
											</div>
										</td>
										
										<td><?php echo $x["heading"]; ?>&nbsp;&nbsp;
										
										<td>  
										<?php
										$str=$x["description"];
										$str=trim($str);
										$str=strip_tags($str);
										//echo $str;
										echo substr($str,0,250); ?>
										
										</td> 
													
										<td class="jagdish"> 

											<?php
												$str1 = '';
												if($x['status'] == '1'){
													$str1 = 'checked';
												}
											?>

											<input class="status" dataid="<?php echo $x['cid']?>" type="checkbox" data-plugin="switchery" data-color="#3aa99e"  <?php echo $str1;?>/>

											<br><br>
                        					<a href="home_testimonial.php?cid=<?php echo base64_encode($x['cid']);?>">
                        						Edit
                        					</a>

										</td>
									</tr>
									<?php
											}
										?>
									</tbody>
								</table>
								</div>
								</div>
								</div>
							</div>
							</form>
                        </div> 
<script src="assets/js/jquery.min.js" type="text/javascript"></script>
						<script type="text/javascript"> 
$('#pbody').on('change','.status', function(){

				var as = '';
				if($(this).is(':checked')) {
					var as = 1;
				}

				var id = $(this).attr('dataid');

				$.ajax({
					method: 'POST',
					url: 'updateStatus.php',
					data: 'as='+as+'&id='+id+'&type=testimonial',
					success : function(data) {
						alert('Updated');
					}
				});
			});

</script> 
                    </div> <!-- container --> 
                </div> <!-- content --> 
            </div>  
            <footer class="footer text-right">
              © <?php echo $copy_right; ?>
            </footer> 
        </div> 
        <script>
            var resizefunc = [];
        </script> 
        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/tether.min.js"></script><!-- Tether for Bootstrap -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/plugins/switchery/switchery.min.js"></script>
		<!-- Jquery filer js -->
        <script src="assets/plugins/jquery.filer/js/jquery.filer.min.js"></script>
		<!-- page specific js -->
        <script src="assets/pages/jquery.fileuploads.init.js"></script>
        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
<script>
			  $("#del").click(function(){
				var d = confirm("Are you sure you want to delete this row ?")
				var data = $("input:checked").serialize();
				if(d == 1){ // alert(data);
				$.ajax({
				  type:"post",
				  url:"delete.php",
				  data:data+"&table=testimonial",
				  success:function(data1){
					window.location.href =window.location.href;
				  }
				});}
			  });
			  $(":checkbox").click(function(){
			  if($("input:checked").length > 0){
				$("#del").css("color","red");
				$("#del").css("cursor","pointer");
			  }else{
				$("#del").css("color","#333939");
				$("#del").css("cursor","auto");
			  }
			});
		  </script>
    </body> 
</html>