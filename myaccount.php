<?php
session_start();
require_once 'admin/core/core.php';
require_once 'admin/core/other-script.php';
@extract($_REQUEST);

$clientContactSql=mysqli_query($con, "select * from `clients` where cid='".$_SESSION['sess_clientId']."'");
$clientContactLine=mysqli_fetch_assoc($clientContactSql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title><?php echo SITE_TITLE ?> || My Account</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Default Description">
  <meta name="keywords" content="fashion, store, E-commerce">
  <meta name="robots" content="*">
  <link rel="icon" href="#" type="image/x-icon">
  <link rel="shortcut icon" href="#" type="image/x-icon">

  <!-- CSS Style -->
  <link rel="stylesheet" type="text/css" href="stylesheet/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="stylesheet/font-awesome.css" media="all">
  <link rel="stylesheet" type="text/css" href="stylesheet/revslider.css" >
  <link rel="stylesheet" type="text/css" href="stylesheet/owl.carousel.css">
  <link rel="stylesheet" type="text/css" href="stylesheet/owl.theme.css">
  <link rel="stylesheet" type="text/css" href="stylesheet/jquery.bxslider.css">
  <link rel="stylesheet" type="text/css" href="stylesheet/jquery.mobile-menu.css">
  <link rel="stylesheet" type="text/css" href="stylesheet/style.css" media="all">
  <link rel="stylesheet" type="text/css" href="stylesheet/responsive.css" media="all">
  <link rel="stylesheet" href="stylesheet/hxi4fbo.css">
  <link href="https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,500,600,700" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:700,600,800,400' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i,900" rel="stylesheet"></head>
  <body>
    <div id="page">
      <?php include ('header.php'); ?>
      <!--container-->

      <div class="page-heading">
        <div class="page-title">
          <h2>My Account</h2>
        </div>
      </div>
      <section class="main-container col2-right-layout">
        <div class="main container">
          <div class="row">
            <section class="col-main col-sm-9 col-xs-12 wow bounceInUp animated animated" style="visibility: visible;">
              <div class="my-account">

                <!--page-title--> 
                <!-- BEGIN DASHBOARD-->
                <div class="dashboard">
                  <div class="welcome-msg">
                    <p class="hello"><strong>Hello, <?php echo ucwords($_SESSION['sess_uname']);?>!</strong></p>
                    <p>From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.</p>
                  </div>
                  <div class="recent-orders">
                    <div class="title-buttons"> 
                      <strong>Recent Orders</strong> 
                      <a href="javascript:void(0)" id="viewAllBtn" onclick="show_all_orders(1)">View All</a>
                      <a href="javascript:void(0)" id="viewLessBtn" onclick="show_all_orders(2)" style="display: none;">View Less</a>
                    </div>
                    <div class="table-responsive" id="viewLessDiv">
                      <table class="data-table table-striped" id="my-orders-table">
                        <colgroup>
                          <col width="">
                          <col width="">
                          <col>
                          <col width="1">
                          <col width="1">
                          <col width="20%">
                        </colgroup>
                        <thead>
                          <tr class="first last">
                            <th>Order # </th>
                            <th>Date</th>
                            <th>Ship To</th>
                            <th><span class="nobr">Order Total</span></th>
                            <th>Status</th>
                            <th>&nbsp;</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $ordersSql=mysqli_query($con,"select * from `tbl_order_detail` where clientID='".$_SESSION['sess_clientId']."' order by id desc limit 0,10");
                          while($ordersLine=mysqli_fetch_assoc($ordersSql)){

                            $shippingAddSql=mysqli_query($con,"select shipping_firstname from `client_shipping_address` where id='".$ordersLine['shipping_address_id']."'");
                            $shippingAddLine=mysqli_fetch_assoc($shippingAddSql);
                          ?>
                          <tr class="first odd">
                            <td><?php echo $ordersLine['id'];?></td>
                            <td>
                              <span class="nobr">
                                <?php echo date('d-M-Y',strtotime($ordersLine['post_date']));?>
                              </span>
                            </td>
                            <td>
                              <?php echo ucwords($shippingAddLine['shipping_firstname']);?>
                            </td>
                            <td>
                              <span class="price">
                                <i class="fa fa-inr"></i>
                                <?php echo number_format($ordersLine['finalAmount'],2); ?>
                              </span>
                            </td>
                            <td>
                              <?php
                              $orderStatus=$ordersLine['orderStatus'];
                              for($yt=0;$yt<count($orderStatusArray);$yt++){
                              
                              if($yt==$orderStatus){ 
                              ?>
                                <?php if($yt==1){ echo "Pending"; } else {?>
                                <em><?php echo $orderStatusArray[$yt];?></em>
                              <?php } } }?>
                            </td>
                            <td class="a-center last">
                              <span class="nobr"> 
                                
                                <a href="javascript:void(0)" title="Expand" onclick="_expand_order_dtls(<?php echo $ordersLine['id'];?>)">
                                  View Order
                                </a>

                              </span>
                            </td>
                          </tr>

                          <tr id="order_dtls_<?php echo $ordersLine['id']?>" style="display: none;">
                            <td colspan="6">
                              <table class="data-table table-striped" id="my-orders-table">
                                <colgroup>
                                  <col width="">
                                  <col width="">
                                  <col>
                                  <col width="1">
                                  <col width="1">
                                  <col width="20%">
                                </colgroup>
                                <thead>
                                  <tr class="first last">
                                    <th class="product_thumb">No.</th>
                                    <th class="product_thumb">Image</th>
                                    <th class="product_name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product_quantity">Quantity</th>
                                    <th class="product_total">Total</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php
                                  $hh=1;
                                  $cartSql=mysqli_query($con, "SELECT * from `tbl_cart` where orderID='".$ordersLine['id']."'");
                                  
                                    $cartSubtotal=0;
                                    while($cartLine=mysqli_fetch_array($cartSql)) {

                                      $prodCart_Sql=mysqli_query($con, "SELECT * from `tbl_product` where cid='".$cartLine['productID']."'");
                                      $prodCart_Line=mysqli_fetch_array($prodCart_Sql);
                                  ?>
                                  <tr class="first odd">
                                    <td><?php echo $hh; $hh++;?></td>
                                    <td>
                                      <img class="header_cart" src="admin/control/images/<?php echo $prodCart_Line['primaryImage'];?>" alt="<?php echo $prodCart_Line['title'];?>" style="height: 50px;">
                                    </td>
                                    <td>
                                      <?php echo $prodCart_Line['title'];?>
                                    </td>
                                    <td>
                                      <span class="price">
                                        <i class="fa fa-inr"></i> <?php echo number_format($cartLine['rate'],2);?>
                                      </span>
                                    </td>
                                    <td>
                                      <?php echo $cartLine['qnt'];?>
                                    </td>
                                    <td class="a-center last">
                                      <i class="fa fa-inr"></i>  <?php echo number_format($cartLine['amount'],2);?>
                                    </td>
                                  </tr>

                          <?php } ?>
                        </tbody>
                      </table>
                            </td>
                          </tr>

                          <?php } ?>
                        </tbody>
                      </table>
                    </div>


                    <div class="table-responsive" id="viewAllDiv" style="display: none;">
                      <table class="data-table table-striped" id="my-orders-table">
                        <colgroup>
                          <col width="">
                          <col width="">
                          <col>
                          <col width="1">
                          <col width="1">
                          <col width="20%">
                        </colgroup>
                        <thead>
                          <tr class="first last">
                            <th>Order # </th>
                            <th>Date</th>
                            <th>Ship To</th>
                            <th><span class="nobr">Order Total</span></th>
                            <th>Status</th>
                            <th>&nbsp;</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $ordersSql2=mysqli_query($con,"select * from `tbl_order_detail` where clientID='".$_SESSION['sess_clientId']."' order by id desc");
                          while($ordersLine2=mysqli_fetch_assoc($ordersSql2)){

                            $shippingAddSql2=mysqli_query($con,"select shipping_firstname from `client_shipping_address` where id='".$ordersLine2['shipping_address_id']."'");
                            $shippingAddLine2=mysqli_fetch_assoc($shippingAddSql2);
                          ?>
                          <tr class="first odd">
                            <td><?php echo $ordersLine2['id'];?></td>
                            <td>
                              <span class="nobr">
                                <?php echo date('d-M-Y',strtotime($ordersLine2['post_date']));?>
                              </span>
                            </td>
                            <td>
                              <?php echo ucwords($shippingAddLine2['shipping_firstname']);?>
                            </td>
                            <td>
                              <span class="price">
                                <i class="fa fa-inr"></i>
                                <?php echo number_format($ordersLine2['finalAmount'],2); ?>
                              </span>
                            </td>
                            <td>
                              <?php
                              $orderStatus2=$ordersLine2['orderStatus'];
                              for($yt=0;$yt<count($orderStatusArray);$yt++){
                              
                              if($yt==$orderStatus2){ 
                              ?>
                                <?php if($yt==1){ echo "Pending"; } else {?>
                                <em><?php echo $orderStatusArray[$yt];?></em>
                              <?php } } }?>
                            </td>
                            <td class="a-center last">
                              <span class="nobr"> 
                                
                                <a href="javascript:void(0)" title="Expand" onclick="_expand_order_dtls2(<?php echo $ordersLine2['id'];?>)">
                                  View Order
                                </a>

                              </span>
                            </td>
                          </tr>

                          <tr id="order_dtls2_<?php echo $ordersLine2['id']?>" style="display: none;">
                            <td colspan="6">
                              <table class="data-table table-striped" id="my-orders-table">
                                <colgroup>
                                  <col width="">
                                  <col width="">
                                  <col>
                                  <col width="1">
                                  <col width="1">
                                  <col width="20%">
                                </colgroup>
                                <thead>
                                  <tr class="first last">
                                    <th class="product_thumb">No.</th>
                                    <th class="product_thumb">Image</th>
                                    <th class="product_name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product_quantity">Quantity</th>
                                    <th class="product_total">Total</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php
                                  $hh=1;
                                  $cartSql=mysqli_query($con, "SELECT * from `tbl_cart` where orderID='".$ordersLine2['id']."'");
                                  
                                    $cartSubtotal=0;
                                    while($cartLine=mysqli_fetch_array($cartSql)) {

                                      $prodCart_Sql=mysqli_query($con, "SELECT * from `tbl_product` where cid='".$cartLine['productID']."'");
                                      $prodCart_Line=mysqli_fetch_array($prodCart_Sql);
                                  ?>
                                  <tr class="first odd">
                                    <td><?php echo $hh; $hh++;?></td>
                                    <td>
                                      <img class="header_cart" src="admin/control/images/<?php echo $prodCart_Line['primaryImage'];?>" alt="<?php echo $prodCart_Line['title'];?>" style="height: 50px;">
                                    </td>
                                    <td>
                                      <?php echo $prodCart_Line['title'];?>
                                    </td>
                                    <td>
                                      <span class="price">
                                        <i class="fa fa-inr"></i> <?php echo number_format($cartLine['rate'],2);?>
                                      </span>
                                    </td>
                                    <td>
                                      <?php echo $cartLine['qnt'];?>
                                    </td>
                                    <td class="a-center last">
                                      <i class="fa fa-inr"></i>  <?php echo number_format($cartLine['amount'],2);?>
                                    </td>
                                  </tr>

                          <?php } ?>
                        </tbody>
                      </table>
                            </td>
                          </tr>

                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                    <!--table-responsive-->                 
                  </div>
                  <!--recent-orders-->
                  <div class="box-account" id="cnt">
                    <div class="page-title">
                      <h2>Account Information</h2>

                      <?php if(isset($_SESSION['sess_msg']) && $_SESSION['sess_msg']!=''){?>
                      <div class="alert alert-success text-center" role="alert">
                          <?php echo $_SESSION['sess_msg']; $_SESSION['sess_msg']='';?>
                      </div>
                      <?php } ?>
                      <?php if(isset($_SESSION['sess_msg_err']) && $_SESSION['sess_msg_err']!=''){?>
                      <div class="alert alert-danger text-center" role="alert">
                          <?php echo $_SESSION['sess_msg_err']; $_SESSION['sess_msg_err']='';?>
                      </div>
                      <?php } ?>

                    </div>
                    <div class="col2-set">
                      <div class="col-1">
                        <div class="box">
                          <div class="box-title">
                            <h5>Contact Information</h5>
                            <a href="javascript:void(0)" onclick="_edit_contact_info()">Edit</a> 
                          </div>
                            <!--box-title-->
                            <div class="box-content">
                              <p> <?php echo ucwords($clientContactLine['fname']);?><br>
                                <?php echo $clientContactLine['email'];?><br>
                                <a href="javascript:void(0)" onclick="_change_password()">Change Password</a> </p>
                              </div>
                              <!--box-content--> 
                            </div>
                            <!--box--> 
                          </div>

                          <div class="col-2" style="display: none;" id="edit_cont_div">
                            <div class="box">
                              <div class="box-title">
                                <h5>Edit Contact Information</h5>
                              </div>
                                <!--box-title-->
                                <form method="post" action="edit-client-info.php" onsubmit="return _validateBillingFrm()">
                                  <div class="box-content">
                                    <div class="col-sm-6">
                                      <label>Full Name</label>
                                      <input type="text" name="billing_firstname" id="billing_firstname" value="<?php echo ucwords($clientContactLine['fname']);?>" maxlength="50" onkeypress="return _isAlphabetKey(event)">
                                      <span id="billing_firstnameError" class="redClr"></span>
                                    </div>

                                    <div class="col-sm-6">
                                      <label>Mobile No.</label>
                                      <input type="text" name="billing_telephone" id="billing_telephone" value="<?php echo $clientContactLine['phone'];?>" maxlength="10" onkeypress="return _isNumberKey(event)">
                                      <span id="billing_telephoneError" class="redClr"></span>
                                    </div>

                                    <div style="clear: both; height: 10px;"></div>

                                    <div class="col-sm-6">
                                      <label>Company</label>
                                      <input type="text" name="billing_company" id="billing_company" value="<?php echo ucwords($clientContactLine['billing_company']);?>">
                                    </div>

                                    <div class="col-sm-6">
                                      <label>Address</label>
                                      <input type="text" name="billing_street" id="billing_street" value="<?php echo ucwords($clientContactLine['billing_street']);?>">
                                      <span id="billing_streetError" class="redClr"></span>
                                    </div>

                                    <div style="clear: both; height: 10px;"></div>

                                    <div class="col-sm-6">
                                      <label>State</label>
                                      <select id="billing_state_id" name="billing_state_id" title="State/Province" onchange="_shippig_city_ajax(this.value)" style="width: 100%;">
                                          <option value="">
                                            -- Select State --
                                          </option>
                                          <?php 
                                          $stateSql=mysqli_query($con, "select * from states where country_id='105' order by name asc");
                                          while ($stateLine=mysqli_fetch_assoc($stateSql)) {
                                          ?>
                                          <option value="<?php echo $stateLine['id'];?>" <?php if($stateLine['id']==$clientContactLine['billing_state_id']){ echo "selected"; }?>>
                                            <?php echo $stateLine['name'];?>
                                          </option>
                                          <?php } ?>
                                        </select>
                                        <span id="billing_state_idError" class="redClr"></span>
                                    </div>

                                    <div class="col-sm-6">
                                      <label>City</label>
                                      <select id="billing_city_id" name="billing_city_id" title="State/Province"  style="width: 100%;">
                                          <option value="">
                                            -- Select City --
                                          </option>
                                          <?php 
                                          $citySql=mysqli_query($con, "select * from cities where state_id='".$clientContactLine['billing_state_id']."' order by city asc");
                                          while ($cityLine=mysqli_fetch_assoc($citySql)) {
                                          ?>
                                          <option value="<?php echo $cityLine['id'];?>" <?php if($cityLine['id']==$clientContactLine['billing_city_id']){ echo "selected"; }?>>
                                            <?php echo $cityLine['city'];?>
                                          </option>
                                          <?php } ?>
                                        </select>
                                        <span id="billing_city_idError" class="redClr"></span>
                                    </div>

                                    <div style="clear: both; height: 10px;"></div>
                                    
                                    <div class="col-sm-6">
                                      <label>Post/ZIP Code</label>
                                      <input type="text" name="billing_postcode" id="billing_postcode" value="<?php echo $clientContactLine['billing_postcode']?>" maxlength="6" onkeypress="return _isNumberKey(event)">
                                      <span id="billing_postcodeError" class="redClr"></span>
                                    </div>

                                    <div class="col-sm-6">

                                      <button type="submit" class="button login" title="Login" name="edit" style="margin-top: 14px;"><span>Update</span></button>
                                    </div>

                                  </div>
                                </form>
                                <!--box-content-->
                              </div>
                              <!--box-->
                            </div>

                            <div class="col-2" style="display: none;" id="change_password_div">
                            <div class="box">
                              <div class="box-title">
                                <h5>Change Password</h5>
                              </div>
                                <!--box-title-->
                                <form method="post" action="change-password-myaccount.php" onsubmit="return _validatePasswordFrm()">
                                  <div class="box-content">
                                    <div class="col-sm-6">
                                      <label>Current Password</label>
                                      <input type="password" name="current_password" id="current_password" value="" maxlength="20">
                                      <span id="current_passwordError" class="redClr"></span>
                                    </div>

                                    <div style="clear: both; height: 10px;"></div>

                                    <div class="col-sm-6">
                                      <label>New Password</label>
                                      <input type="password" name="new_password" id="new_password" value="" maxlength="20">
                                      <span id="new_passwordError" class="redClr"></span>
                                    </div>

                                    <div style="clear: both; height: 10px;"></div>

                                    <div class="col-sm-6">
                                      <label>Confirm Password</label>
                                      <input type="password" name="confirm_password" id="confirm_password" value="">
                                      <span id="confirm_passwordError" class="redClr"></span>
                                    </div>

                                    <div style="clear: both; height: 10px;"></div>

                                    <div class="col-sm-12">

                                      <button type="submit" class="button login" title="Login" name="update_password" style="margin-top: 14px;"><span>Change Password</span></button>
                                    </div>

                                  </div>
                                </form>
                                <!--box-content-->
                              </div>
                              <!--box-->
                            </div>

                          </div>
                          <div class="col2-set">
                            <div class="box">
                              <div class="box-title">
                                <h4>Address Book</h4>
                                <!-- <a href="#">Manage Addresses</a> --> </div>
                                <!--box-title-->
                                
                                <div class="box-content">
                                  <div class="col-1">
                                    <h5>Default Billing Address</h5>
                                    <address>
                                      <?php echo ucwords($clientContactLine['fname']);?><br>
                                      <?php echo ucwords($clientContactLine['billing_street']);?><br>
                                      <?php echo $cityName=_cityName($clientContactLine['billing_city_id']);?>, <?php echo $stateName=_stateName($clientContactLine['billing_state_id']);?>, <?php echo $clientContactLine['billing_postcode'];?><br>
                                      <!-- United States<br> -->
                                      T: <?php echo $clientContactLine['phone'];?> <br>
                                      <!-- <a href="#">Edit Address</a> -->
                                    </address>
                                  </div>
                                  <?php
                                  $shippingAddressSql=mysqli_query($con, "select * from `client_shipping_address` where client_id='".$_SESSION['sess_clientId']."'");
                                  $shippingAddressLine=mysqli_fetch_assoc($shippingAddressSql);
                                  ?>
                                  <div class="col-2">
                                    <h5>Default Shipping Address</h5>
                                    <address>
                                      <?php echo ucwords($shippingAddressLine['shipping_firstname']);?><br>
                                      <?php echo ucwords($shippingAddressLine['shipping_street']);?><br>
                                      <?php echo ucwords($shippingAddressLine['shipping_city_name']);?>,  <?php echo ucwords($shippingAddressLine['shipping_state_name']);?>, <?php echo ucwords($shippingAddressLine['shipping_postcode']);?><br>
                                      T: <?php echo ucwords($shippingAddressLine['shipping_telephone']);?> <br>
                                      <!-- <a href="#">Edit Address</a> -->
                                    </address>
                                  </div>
                                </div>
                                <!--box-content--> 
                              </div>
                              <!--box--> 
                            </div>
                          </div>
                        </div>
                      </div>
                    </section>
                    <!--col-main col-sm-9 wow bounceInUp animated-->
                    <aside class="col-right sidebar col-sm-3 col-xs-12 wow bounceInUp animated animated" style="visibility: visible;">
                      <div class="custom-slider">
                        <div>
                          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                              <?php
                              $listingSliderSidebarSql=mysqli_query($con, "select * from listing_sidebar_slider where status=1 order by priority");
                              $listingSliderSidebarNum=mysqli_num_rows($listingSliderSidebarSql);
                              
                              for($n=0;$n<$listingSliderSidebarNum;$n++){
                              ?>
                                <li <?php if($n==0){?>class="active"<?php } ?> data-target="#carousel-example-generic" data-slide-to="<?php echo $n; ?>"></li>
                              <?php } ?>
                            </ol>
                            <div class="carousel-inner">
                              <?php 
                              $m=0;
                              while ($listingSliderSidbarLine=mysqli_fetch_assoc($listingSliderSidebarSql)) {
                                $m++;
                              ?>
                              <div class="item <?php if($m==1){?>active<?php } ?>">
                                <img src="admin/control/<?php echo $listingSliderSidbarLine['image'];?>" alt="slide<?php echo $m; ?>">
                              </div>
                              <?php } ?>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev"> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#carousel-example-generic" data-slide="next"> <span class="sr-only">Next</span> </a></div>
                          </div>
                        </div>
                      </aside>
                      <!--col-right sidebar col-sm-3 wow bounceInUp animated--> 
                    </div>
                    <!--row--> 
                  </div>
                  <!--main container--> 
                </section>

              <?php include "feature_box.php"; ?>

            </div>
          </div>

        </div>


        <!-- For version 1,2,3,4,6 -->
        <?php include ('footer.php'); ?>

        <!-- End For version 1,2,3,4,6 --> 

      </div>
      <!--page--> 
      <!-- Mobile Menu-->
     <?php include ('mobilemenu.php'); ?>


<!-- JavaScript --> 
<script src="js/jquery.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/parallax.js"></script> 
<script src="js/revslider.js"></script> 
<script src="js/common.js"></script> 
<script src="js/jquery.bxslider.min.js"></script> 
<script src="js/owl.carousel.min.js"></script> 
<script src="js/jquery.mobile-menu.min.js"></script> 
<script src="js/countdown.js"></script> 
<script>
  jQuery(document).ready(function(){
    jQuery('#thm-rev-slider').show().revolution({
      dottedOverlay: 'none',
      delay: 5000,
      startwidth: 0,
      startheight:750,

      hideThumbs: 200,
      thumbWidth: 200,
      thumbHeight: 50,
      thumbAmount: 2,

      navigationType: 'thumb',
      navigationArrows: 'solo',
      navigationStyle: 'round',

      touchenabled: 'on',
      onHoverStop: 'on',

      swipe_velocity: 0.7,
      swipe_min_touches: 1,
      swipe_max_touches: 1,
      drag_block_vertical: false,

      spinner: 'spinner0',
      keyboardNavigation: 'off',

      navigationHAlign: 'center',
      navigationVAlign: 'bottom',
      navigationHOffset: 0,
      navigationVOffset: 20,

      soloArrowLeftHalign: 'left',
      soloArrowLeftValign: 'center',
      soloArrowLeftHOffset: 20,
      soloArrowLeftVOffset: 0,

      soloArrowRightHalign: 'right',
      soloArrowRightValign: 'center',
      soloArrowRightHOffset: 20,
      soloArrowRightVOffset: 0,

      shadow: 0,
      fullWidth: 'on',
      fullScreen: 'on',

      stopLoop: 'off',
      stopAfterLoops: -1,
      stopAtSlide: -1,

      shuffle: 'off',

      autoHeight: 'on',
      forceFullWidth: 'off',
      fullScreenAlignForce: 'off',
      minFullScreenHeight: 0,
      hideNavDelayOnMobile: 1500,

      hideThumbsOnMobile: 'off',
      hideBulletsOnMobile: 'off',
      hideArrowsOnMobile: 'off',
      hideThumbsUnderResolution: 0,

      hideSliderAtLimit: 0,
      hideCaptionAtLimit: 0,
      hideAllCaptionAtLilmit: 0,
      startWithSlide: 0,
      fullScreenOffsetContainer: ''
    });
  });
</script> 
<script>
  function HideMe()
  {
    jQuery('.popup1').hide();
    jQuery('#fade').hide();
  }
</script> 
<!-- Hot Deals Timer 1-->

<script>
  function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
  }

  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }
</script>

<script>
  var dthen1 = new Date("12/25/17 11:59:00 PM");
  start = "08/04/15 03:02:11 AM";
  start_date = Date.parse(start);
  var dnow1 = new Date(start_date);
  if (CountStepper > 0)
    ddiff = new Date((dnow1) - (dthen1));
  else
    ddiff = new Date((dthen1) - (dnow1));
  gsecs1 = Math.floor(ddiff.valueOf() / 1000);

  var iid1 = "countbox_1";
  CountBack_slider(gsecs1, "countbox_1", 1);

  /*view less order details, start here*/
  function _expand_order_dtls(tdl) {
      $('#order_dtls_'+tdl).toggle();
  }
  /*view less order details, end here*/

  /*view all order details, start here*/
  function _expand_order_dtls2(tdl2) {
      $('#order_dtls2_'+tdl2).toggle();
  }
  /*view all order details, end here*/

  /*show all or less orders, start here*/
  function show_all_orders(vl){
    if(vl==1){
      $('#viewLessDiv').hide();
      $('#viewAllDiv').show();
      $('#viewAllBtn').hide();
      $('#viewLessBtn').show();
    } else if(vl==2){
      $('#viewLessDiv').show();
      $('#viewAllDiv').hide();
      $('#viewAllBtn').show();
      $('#viewLessBtn').hide();
    }
  }
  /*show all or less orders, end here*/

  /*show/hide edit contact info, start here*/
  function _edit_contact_info(){
    $('#edit_cont_div').toggle();
  }
  /*show/hide edit contact info, end here*/


  /*show/hide edit change password, start here*/
  function _change_password(){
    $('#change_password_div').toggle();
  }
  /*show/hide edit change password, end here*/


  /*for select billing city, start here*/
  function _shippig_city_ajax(stt_id){
    var stt_id=stt_id;

    $.ajax({
        method: 'POST',
        url: 'shipping-city-ajax.php',
        data: 'stt_id='+stt_id,
        success : function(data_del) {
          $('#billing_city_id').html(data_del);
        }
    });

  }
  /*for select billing city, end here*/

  /*validate edit contact info form, start here*/
  function _validateBillingFrm(){

    var billing_firstname=document.getElementById('billing_firstname').value;
    var number=document.getElementById('billing_telephone').value;
    var billing_street=document.getElementById('billing_street').value;
    var billing_state_id=document.getElementById('billing_state_id').value;
    var billing_city_id=document.getElementById('billing_city_id').value;
    var billing_postcode=document.getElementById('billing_postcode').value;

    billing_firstname=billing_firstname.trim();
    number=number.trim();
    billing_street=billing_street.trim();
    billing_state_id=billing_state_id.trim();
    billing_city_id=billing_city_id.trim();
    billing_postcode=billing_postcode.trim();

    if(billing_firstname == "" || billing_firstname == null) {
      document.getElementById("billing_firstname").style.borderColor = "red";
      document.getElementById("billing_firstnameError").innerHTML = "*Full name required.";
    }  else {
      document.getElementById("billing_firstname").style.borderColor = "green";
      document.getElementById("billing_firstnameError").innerHTML = "";
    }
    
    var numLn=number.length;

    if(number == "" || number == null) {
      document.getElementById("billing_telephone").style.borderColor = "red";
      document.getElementById("billing_telephoneError").innerHTML = "*Mobile number is required.";
    }  else {
      if(numLn!=10){
        document.getElementById("billing_telephone").style.borderColor = "red";
        document.getElementById("billing_telephoneError").innerHTML = "*Invalid mobile number";
      } else {
        document.getElementById("billing_telephone").style.borderColor = "green";
        document.getElementById("billing_telephoneError").innerHTML = "";
      }
    }

    if(billing_street == "" || billing_street == null) {
      document.getElementById("billing_street").style.borderColor = "red";
      document.getElementById("billing_streetError").innerHTML = "*Address required.";
    }  else {
      document.getElementById("billing_street").style.borderColor = "green";
      document.getElementById("billing_streetError").innerHTML = "";
    }

    if(billing_state_id == "" || billing_state_id == null) {
      document.getElementById("billing_state_id").style.borderColor = "red";
      document.getElementById("billing_state_idError").innerHTML = "*State name required.";
    }  else {
      document.getElementById("billing_state_id").style.borderColor = "green";
      document.getElementById("billing_state_idError").innerHTML = "";
    }

    if(billing_city_id == "" || billing_city_id == null) {
      document.getElementById("billing_city_id").style.borderColor = "red";
      document.getElementById("billing_city_idError").innerHTML = "*City name required.";
    }  else {
      document.getElementById("billing_city_id").style.borderColor = "green";
      document.getElementById("billing_city_idError").innerHTML = "";
    }

    if(billing_postcode == "" || billing_postcode == null) {
      document.getElementById("billing_postcode").style.borderColor = "red";
      document.getElementById("billing_postcodeError").innerHTML = "*Post Code required.";
    }  else {
      document.getElementById("billing_postcode").style.borderColor = "green";
      document.getElementById("billing_postcodeError").innerHTML = "";
    }


 if(billing_firstname == "" || billing_firstname == null || numLn!=10 || number == "" || number == null || billing_street == "" || billing_street == null || billing_state_id == "" || billing_state_id == null || billing_city_id == "" || billing_city_id == null || billing_postcode == "" || billing_postcode == null) {
          return false;
    }
    
  }
  /*validate edit contact info form, end here*/

  /*validate change password form, start here*/
  function _validatePasswordFrm(){

    var current_password=document.getElementById('current_password').value;
    var new_password=document.getElementById('new_password').value;
    var confirm_password=document.getElementById('confirm_password').value;

    current_password=current_password.trim();
    new_password=new_password.trim();
    confirm_password=confirm_password.trim();

    if(current_password == "" || current_password == null) {
      document.getElementById("current_password").style.borderColor = "red";
      document.getElementById("current_passwordError").innerHTML = "*Current Password required.";
    }  else {
      document.getElementById("current_password").style.borderColor = "green";
      document.getElementById("current_passwordError").innerHTML = "";
    }
    
    var passLn=new_password.length;

    if(new_password == "" || new_password == null) {
        document.getElementById("new_password").style.borderColor = "red";
        document.getElementById("new_passwordError").innerHTML = "*Password is required.";
    }  else {
      if(passLn<8){
        document.getElementById("new_password").style.borderColor = "red";
        document.getElementById("new_passwordError").innerHTML = "*Password has minimum 8 character";
      } else {
        document.getElementById("new_password").style.borderColor = "green";
        document.getElementById("new_passwordError").innerHTML = "";
      }
    }

    if(new_password != confirm_password) {
        document.getElementById("confirm_password").style.borderColor = "red";
        document.getElementById("confirm_passwordError").innerHTML = "*Password is not match..";
    } else {
      document.getElementById("confirm_password").style.borderColor = "green";
        document.getElementById("confirm_passwordError").innerHTML = "";
    }


 if(current_password == "" || current_password == null || new_password == "" || passLn<8 || new_password == null || new_password != confirm_password) {
          return false;
    }
    
  }
  /*validate change password form, end here*/
</script>
</body>
</html>
