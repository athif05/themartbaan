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
require_once 'core/core.php';
require_once('core/other-script.php');
?>
<!DOCTYPE html>
<html> 
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
	 <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
        <!-- App Favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.png">

        <!-- App title -->
        <title><?php echo ADMIN_TITLE;?> || Contact Us</title>

        <!-- Switchery css -->
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" /> 
		<!-- Jquery filer css -->
        <link href="assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
        <link href="assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />
		 
        <!-- Modernizr js -->
        <script src="assets/js/modernizr.min.js"></script>
		<script>
	
	function validate(){
		var a=document.getElementById("add1").value;
		a=a.trim();
		var m=document.getElementById("mobile").value;
		m=m.trim();
		var e=document.getElementById("email").value;
		e=e.trim();
		//var o=document.getElementById("otp").value;
		//o=o.trim();
		
	
		if(a==''){	
		//alert("Please fill all the mandatory fields");
		document.getElementById("add1-error").style.color = "red";
		return false;
		}
		
		if(m==''){	
		//alert("Please fill all the mandatory fields");
		document.getElementById("mobile-error").style.color = "red";
		return false;
		}
		
		if(e==''){	
		//alert("Please fill all the mandatory fields");
		document.getElementById("email-error").style.color = "red";
		return false;
		}
		
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		
		if (!filter.test(e)) {
		document.getElementById("email-error").style.color = "red";
		document.getElementById("email-error").innerHTML=" &nbsp;* Enter a valid Email ";
		e.focus;
		return false;
		}
		
	//at end success
	      alert("Submitted Successfully");
		  return true;
		
	}
	</script>
	<script src="//cdn.ckeditor.com/4.5.10/standard/ckeditor.js"></script>
    </head>

    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            <?php include 'include/header.php';?>
            <?php include "include/sidebar.php";?>
             
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <h4 class="page-title">Address</h4> 
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->
					
					<div class="row">
					
					<?php
					$num=mysqli_query($con, "select count(*) as total from contact");
					$total=mysqli_fetch_assoc($num);
										
					@extract($_REQUEST);
					if(isset($cid)){
						$total=0;
					$cid=$_GET['cid'];
					$row=mysqli_query($con,"select * from contact where cid=$cid");
					$result=mysqli_fetch_assoc($row);
					
					}
					?>
				
						<div class="col-xs-12 col-md-8 col-md-offset-2" style="display:<?php if($total!=0){ echo 'none';}?>">
						<form role="form" method="POST" enctype="multipart/form-data" action="control/contact.php" onSubmit="return validate(this)">
							<div class="card-box">
								 
									 
										<h4 class="header-title m-t-0">Add Address</h4>
										<div style="background-color:#ff5d48; color:#fff; padding:5px; border-radius:0px">Instructions  <i class="fa fa-arrow-down"></i></div>
<div style="background-color:#ededed; color:#000; padding:5px; border-radius:0px; font-size:12px;border:1px solid #ff5d48">
*Please fill all the mandatory fields <br> *Email & Mobile No. should be in proper format	

</div>
										<div class="p-20">
										 <div class="row">
										 	 <div class="col-md-6">
											<div class="form-group">
											<input type="hidden" value="<?php echo $cid;?>" name="update">
												<label>Address1<div style="inline-block; color:green;float:right" id="add1-error">  * Mandatory Field</div></label>
												<input type="text" id="add1" class="form-control" required placeholder="Type Address" name="add1" data-parsley-id="34"
												value="<?php if(isset($cid)){  echo $result['add1'];} ?>">
											</div>
											</div>
											
											 <div class="col-md-6">
											 <div class="form-group">
												<label>Address2</label>
												<input type="text" id="add2" class="form-control"  placeholder="Type Address" name="add2" data-parsley-id="34" value="<?php if(isset($cid)){ 
												echo $result['add2'];} ?>">
											</div>
											</div>
											</div>
											 <div class="row">
										 	 <div class="col-md-6">
											<div class="form-group">
												<label>Address3</label>
												<input type="text" class="form-control"  placeholder="Type Address" name="add3" data-parsley-id="34" value="<?php if(isset($cid)){  echo $result['add3'];} ?>">
											</div> 
											</div>
											<div class="col-md-6">
											<div class="form-group">
												<label>Mobile No.<div style="inline-block; color:green;float:right" id="mobile-error">  * Mandatory Field</div></label>
												<input type="text" id="mobile" class="form-control" maxlength="10" required placeholder="Type Mobile No."name="mob" data-parsley-id="34"
												value="<?php if(isset($cid)){ echo $result['mob'];} ?>">
											</div> 
											</div>
											</div>
											<div class="row">
										 	 <div class="col-md-6">
											<div class="form-group">
												<label>Phone</label>
												<input type="text" class="form-control"  placeholder="Type Phone No." name="phone" data-parsley-id="34" value="<?php if(isset($cid)){ 
												echo $result['phone'];} ?>">
											</div> 
											</div>
											
											<div class="col-md-6">
											<div class="form-group">
												<label>Email<div style="inline-block; color:green;float:right" id="email-error">  * Mandatory Field</div></label>
												<input type="text" id="email" class="form-control" required="" placeholder="Type Email" name="email" data-parsley-id="34" value="<?php if(isset($cid)){  echo $result['email'];} ?>">
											</div> 
											</div>
											</div>
											
													<button type="submit" name="submit" class="btn btn-primary waves-effect waves-light">
														   <span class="btn-label"><i class="fa fa-check"></i>
														   </span>  <?php if(isset($cid)){echo "Update";} else{ echo "Submit";}?>
													</button>
										</div>
									 
                            
                                <!-- end row -->
                        	</div>
							</form>
                        </div>
						
							</div>
						<div class="col-xs-12 col-md-12"> 
							<div class="card-box table-responsive">
								<h4 class="m-t-0 header-title"><b>Address Table</b></h4>
								<div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap4 no-footer">
								 <div class="row"><div class="col-md-12"><table id="datatable" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable_info">
									<thead>
										<tr role="row">
											<th rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 30px;">#</th>
																						 
											<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 400px;">Address1</th>
											<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 400px;">Address2</th>
											<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 400px;">Address3</th>
											<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 240px;">Mobile No.</th>
											<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 200px;">Phone No.</th>
											<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 240px;">Email </th>
										
											<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 290px;">Update</th>
										</tr>
									</thead>
									<tbody>
									
									<?php
									
									
									
                                $i=0;                     
                                $res = mysqli_query($con,"SELECT * FROM contact ");
                                while ($x = mysqli_fetch_array($res)){
                                $i++; 
                              ?>
									<tr role="row" class="odd">
										<td class="center"><?php echo $i; ?>.</td>
																				 
										<td><?php echo $x['add1']; ?>&nbsp;&nbsp;<a data-toggle="tooltip"
                                                    data-placement="top" title="Edit" href="edittext.php?id=<?php echo $x["cid"];?>&table=contact&field=add1" onclick="window.open(this.href,'UPDATE','width=900,height=700'); return false"><span style="width:50px;height:50px;"></td>
										<td><?php echo $x['add2']; ?>&nbsp;&nbsp;<a data-toggle="tooltip"
                                                    data-placement="top" title="Edit" href="edittext.php?id=<?php echo $x["cid"];?>&table=contact&field=add2" onclick="window.open(this.href,'UPDATE','width=900,height=700'); return false"><span style="width:50px;height:50px;">
													
													<span></span></span></a></td>
										<td><?php echo $x['add3']; ?>&nbsp;&nbsp;<a data-toggle="tooltip"
                                                    data-placement="top" title="Edit" href="edittext.php?id=<?php echo $x["cid"];?>&table=contact&field=add3" onclick="window.open(this.href,'UPDATE','width=900,height=700'); return false"><span style="width:50px;height:50px;">
													<span></span></span></a></td>
										<td><?php echo $x['mob']; ?>&nbsp;&nbsp;<a data-toggle="tooltip"
                                                    data-placement="top" title="Edit" href="edittext.php?id=<?php echo $x["cid"];?>&table=contact&field=mob" onclick="window.open(this.href,'UPDATE','width=900,height=700'); return false"><span style="width:50px;height:50px;">
													
													<span></span></span></a></td>
											<td><?php echo $x['phone']; ?>&nbsp;&nbsp;<a data-toggle="tooltip"
                                                    data-placement="top" title="Edit" href="edittext.php?id=<?php echo $x["cid"];?>&table=contact&field=phone" onclick="window.open(this.href,'UPDATE','width=900,height=700'); return false"><span style="width:50px;height:50px;">
													
													<span></span></span></a></td>
												<td><?php echo $x['email']; ?>&nbsp;&nbsp;<a data-toggle="tooltip"
                                                    data-placement="top" title="Edit" href="edittext.php?id=<?php echo $x["cid"];?>&table=contact&field=email" onclick="window.open(this.href,'UPDATE','width=900,height=700'); return false"><span style="width:50px;height:50px;">
													
													<span></span></span></a></td>
													
													
										
										<td class="jagdish"> 
										<a style="background-color:red; padding:5px; border:1px solid red; color:#fff" href="contact.php?cid=<?php echo $x["cid"];?>">Update </a>
										</td>
										 
									</tr>
								<?php } ?>
									 
									</tbody>
									 
								</table>
								</div>
								</div>
								</div>
							</div>
                        </div> 
						<script src="assets/js/jquery.min.js" type="text/javascript"></script>
						<script type="text/javascript">
						
$('.jagdish input').change(function(e){
	
if($(this).prop("checked") == true){
	var status=1;
	var v = $(this).attr('datano');
	
	 $.ajax({
		type: "GET",
		data: "update="+v+"&status="+status+"&table=contact",
		url: "update.php",
		//data: "update="+v+"&status="+status,
		success: function(data)
		{
			location.reload();		
		}
	});
	

}
else if($(this).prop("checked") == false){
	var status=0;
	var v = $(this).attr('datano');
	
 $.ajax({
		type: "GET",
		data: "update="+v+"&status="+status+"&table=contact",
		url: "update.php",
		//data: "update="+v+"&status="+status,
		success: function(data)
		{
			location.reload();
		}
	}); 
}	
});
</script>
						
<script>
          $("#del").click(function(){
            var d = confirm("Are you sure you want to delete this row ?")
            var data = $("input:checked").serialize();
            if(d == 1){ // alert(data);
            $.ajax({
              type:"post",
              url:"delete.php",
              data:data+"&table=contact",
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
    </body> 
</html>