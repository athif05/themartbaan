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
        <title><?php echo ADMIN_TITLE;?> | Stock Report</title>        <!-- Switchery css -->
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
                                    <h4 class="page-title">Stock Report</h4>
                                    <div class="clearfix"></div>   
                                </div>      
                            </div>      
                        </div>                        <!-- end row -->  
                        
                        <div class="row">
                                
                            <div class="col-xs-12 col-md-12">                       
                                <div class="card-box table-responsive">     
                                    <h4 class="m-t-0 header-title">
                                        <b>Stock Report Table</b>
                                    </h4>                           
                                    <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap4 no-footer">             
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table id="datatable" class="table table-striped table-bordered no-footer" role="grid" aria-describedby="datatable_info">                                 
                                                    <thead>
                                                        <tr role="row"> 
                                                            <th rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 10%;"> 
                                                                #
                                                            </th>

                                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 60%;">
                                                                Product Name
                                                            </th>

                                                            <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 30%;">
                                                                Stock
                                                            </th>

                                                        </tr>                               
                                                    </thead>                                    
                                                    <tbody id="pbody">
                                                    <?php 
                                                    $i=1;
                                                    $start=0;
                                                    if(isset($_GET['start'])) $start=$_GET['start'];
                                                    $pagesize=20;
                                                    if(isset($_GET['pagesize'])) $pagesize=$_GET['pagesize'];
                                                    $order_by='cid'; //time_set
                                                    if(isset($_GET['order_by'])) $order_by=$_GET['order_by'];
                                                    $order_by2='asc';
                                                    if(isset($_GET['order_by2'])) $order_by2=$_GET['order_by2'];

                                                    $productSql = mysqli_query($con,"SELECT * from `tbl_product` order by $order_by $order_by2 limit $start,$pagesize");
                                                    $reccnt=mysqli_num_rows(mysqli_query($con,"SELECT * from `tbl_product`"));
                                                    ?>
                                                    <?php
                                                    if($reccnt>0) {
                                                        while($productLine=mysqli_fetch_array($productSql)) {
                                                    ?>                                 
                                                    <tr role="row" class="odd">
                                                               
                                                        <td class="sorting_1" style="width: 10%;">
                                                            <?php echo $i+$start; ?>.
                                                        </td>   
                                                        <td style="width: 60%;">
                                                            <?php echo $productLine['title']; ?>
                                                        </td>
                                                        <td style="width: 30%;">
                                                            <?php
                                                            $invSql=mysqli_query($con, "SELECT * from `tbl_product_inventory` where prod_id='".$productLine['cid']."'");
                                                            while($invLine=mysqli_fetch_array($invSql)) { 

                                                            $attrSql=mysqli_query($con, "SELECT attr_value from `tbl_attribute` where cid='".$invLine['attributeNameId']."'");
                                                            $attrLine=mysqli_fetch_array($attrSql);
                                                            ?>
                                                            <span style="<?php if($invLine['inventory']<=5){ echo "color: red"; }?>">
                                                                <?php 
                                                                echo $attrLine['attr_value'].' - '.$invLine['inventory'].'<br>';
                                                                ?>
                                                            </span>
                                                            <?php
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>                    
                                                    <?php $i++;}  ?>
                                                    <tr>
                                                        <td colspan="1">
                                                            &nbsp;
                                                        </td>
                                                        <td colspan="2">
                                                            <?php include("core/paging.inc.php");?>
                                                        </td>
                                                    </tr>
                                                    <?php } else {?>
                                                    <tr>
                                                        <td colspan="3">
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

        <!-- export report js, start here --
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').DataTable( {
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ]
                } );
            } );
        </script>
        !-- export report js, end here -->
    </body>
</html>