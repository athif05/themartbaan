<?php
session_start();
include('core/core.php');
include 'core/other-script.php';

if(!isset($_SESSION['login_id'])) {
    header("Location:login/index.php"); 
}
?>
<!DOCTYPE html>
<html> 
    <head>  
        <meta charset="utf-8">     
        <meta name="viewport" content="width=device-width, initial-scale=1.0">      
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">       
        <meta name="author" content="Coderthemes">        <!-- App Favicon -->  
        <link rel="shortcut icon" href="assets/images/favicon.ico">     <!-- Custom box css -->     
        <link href="assets/plugins/custombox/css/custombox.min.css" rel="stylesheet">
        <!-- App title -->        
        <title><?php echo ADMIN_TITLE;?> | Payment Report</title>        <!-- Switchery css -->
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />  
        <!-- App CSS -->        
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />   
        <!-- Jquery filer css -->        
        <link href="assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />  
        <link href="assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />  
        <!-- Modernizr js -->        
        <script src="assets/js/modernizr.min.js"></script>  
    </head>    
    <body class="fixed-left">        <!-- Begin page -->        
        <div id="wrapper">            <!-- Top Bar Start -->            
            <!-- Top Bar End -->            <!-- ========== Left Sidebar Start ========== -->
            <?php include 'include/header.php';?>
            <?php include "include/sidebar.php";?>           
            <!-- Left Sidebar End --> 

            <div class="content-page">    <!-- Start content -->           
                <div class="content">   
                    <div class="container">  
                        <div class="row">   
                            <div class="col-xs-12">     
                                <div class="page-title-box">   
                                    <h4 class="page-title">Payment Report</h4>
                                    <div class="clearfix"></div>   
                                </div>      
                            </div>      
                        </div>                        <!-- end row -->  
                        
                        <div class="row">
                                
                            <div class="col-xs-12 col-md-12">                       
                                <div class="card-box table-responsive">     
                                    <h4 class="m-t-0 header-title">
                                        <b>Payment Report Table</b>
                                    </h4>                           
                                    <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap4 no-footer">             
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table id="datatable" class="table table-striped table-bordered no-footer" role="grid" aria-describedby="datatable_info">                                 
                                                    <thead>
                                                        <tr role="row"> 
                                                            <th rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 5%;"> #
                                                            </th>

                                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 15%;">Transaction ID</th>

                                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 15%;">Order ID</th>

                                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 20%;">Username</th>

                                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 15%;">Amount</th>

                                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 15%;">Method</th>

                                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 15%;">Date/Time</th>
                                                        </tr>                               
                                                    </thead>                                    
                                                    <tbody id="pbody">
                                                    <?php
                                                    $i=1;
                                                    $start=0;
                                                    if(isset($_GET['start'])) $start=$_GET['start'];
                                                    $pagesize=20;
                                                    if(isset($_GET['pagesize'])) $pagesize=$_GET['pagesize'];
                                                    $order_by='id'; //time_set
                                                    if(isset($_GET['order_by'])) $order_by=$_GET['order_by'];
                                                    $order_by2='desc';
                                                    if(isset($_GET['order_by2'])) $order_by2=$_GET['order_by2'];

                                                    $orderSql = mysqli_query($con,"SELECT * from `tbl_order_detail` where paymentStatus=1 order by $order_by $order_by2 limit $start,$pagesize");
                                                    $reccnt=mysqli_num_rows(mysqli_query($con,"SELECT * from `tbl_order_detail` where paymentStatus=1"));
                                                    if($reccnt>0) {
                                                        $amount=0;
                                                        while($orderLine=mysqli_fetch_array($orderSql)) {

                                                            $amount=$orderLine['finalAmount'];

                                                            $clientNameSql=mysqli_query($con, "SELECT * from `clients` where cid='".$orderLine['clientID']."'");
                                                            $clientNameLine=mysqli_fetch_array($clientNameSql);
                                                    ?>                                  
                                                    <tr role="row" class="odd">
                                                        <form method="POST">        
                                                        <td class="sorting_1" style="width: 5%;">
                                                            <?php echo $i+$start; $i++; ?>.
                                                        </td>   
                                                        <td style="width: 15%;">    
                                                            <?php echo $orderLine['transactionID'];?>
                                                        </td>   
                                                        <td style="width: 15%;">
                                                            <?php echo $orderLine['id'];?>
                                                        </td>                                       
                                                        <td style="width: 20%;">
                                                            <?php echo $clientNameLine['fname'].' '.$clientNameLine['lname'];?>
                                                        </td>

                                                        <td style="width: 15%;">
                                                            <?php echo number_format($amount,2,".",",");?>
                                                        </td>

                                                        <td style="width: 15%;">
                                                            Online
                                                        </td>
                                                        <td style="width: 15%;">
                                                            <?php echo date('d-M-Y h:iA',strtotime($orderLine['last_updated']));?>
                                                        </td>
                                                        </form>
                                                    </tr>                           
                                                    <?php }  ?>
                                                    <tr>
                                                        <td colspan="3">
                                                            &nbsp;
                                                        </td>
                                                        <td colspan="4">
                                                            <?php include("core/paging.inc.php");?>
                                                        </td>
                                                    </tr>
                                                    <?php } else {?>
                                                    <tr>
                                                        <td colspan="7">
                                                            No result.
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
                        </div>                 
                    </div> <!-- container -->            
                </div> <!-- content -->           
            </div>            <!-- End content-page -->                      
            <footer class="footer text-right">              
                2018 &copy; IT Globaliser Noida           
            </footer>        
        </div>        
        <!-- END wrapper -->
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
        <script src="assets/plugins/custombox/js/legacy.min.js"></script>       <!-- Jquery filer js -->        
        <script src="assets/plugins/jquery.filer/js/jquery.filer.min.js"></script>      <!-- page specific js -->        
        <script src="assets/pages/jquery.fileuploads.init.js"></script>        <!-- App js -->        
        <script src="assets/js/jquery.core.js"></script>        
        <script src="assets/js/jquery.app.js"></script>
    </body>
</html>