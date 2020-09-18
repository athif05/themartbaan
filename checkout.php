<?php
session_start();
require_once 'admin/core/core.php';
require_once 'admin/core/other-script.php';
@extract($_REQUEST);

if(empty($_SESSION['sess_clientId'])) {
    header('Location:login.php?chck=1');
} else {
    $clientDetailsSql=mysqli_query($con, "SELECT cid,fname,lname,email,phone from `clients` where cid='".$_SESSION['sess_clientId']."'");
    $clientDetailsLine=mysqli_fetch_array($clientDetailsSql);
    
    $fname=$clientDetailsLine['fname'];
    $clnEmail=$clientDetailsLine['email'];
    $clnPhone=$clientDetailsLine['phone'];
}

if($_SESSION['sess_cartHeaderTempNum']==0){
    header('Location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title><?php echo SITE_TITLE ?> || Check Out</title>
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
          <h2>Cart</h2>
        </div>
      </div>
      <!-- BEGIN Main Container -->  

      <!-- BEGIN Main Container col2-right --> 
      <div class="main-container col2-right-layout">  
        
        <div class="main container">
          <div class="row">

            <form id="co-billing-form" method="post" action="checkout-code.php" onsubmit="return _validateBillingFrm()">

            <section class="col-main col-sm-7 wow bounceInUp animated animated">
              <ol class="one-page-checkout" id="checkoutSteps">
                <li id="opc-billing" class="section allow active">
                  <div class="step-title" onClick="show_step_toggle(1)"> 
                    <span class="number">1</span>          
                    <h3 class="one_page_heading">  Billing Information</h3>
                  </div>
                  <div id="checkout-step-billing" class="step a-item" style="display: block;">
                    
                    
                      
                      <fieldset class="group-select">
                        <ul class="">
                            <li id="billing-new-address-form">
                              <fieldset>
                                <input type="hidden" name="billing[address_id]" value="27006" id="billing:address_id">
                                <ul>

                                  <li class="fields">
                                    <div class="customer-name">
                                      <div class="input-box name-firstname">
                                        <label for="billing:firstname">Full Name<span class="required">*</span></label>
                                        <div class="input-box1">
                                          <input type="text" id="billing_firstname" name="billing_firstname" value="<?php if(isset($fname)){ echo $fname;}?>" title="First Name"  maxlength="50" onkeypress="return _isAlphabetKey(event)" class="input-text required-entry">
                                          <span id="billing_firstnameError" class="redClr"></span>
                                        </div>
                                      </div>

                                      <div class="input-box name-firstname">
                                        <label for="billing:firstname">Email<span class="required">*</span></label>
                                        <div class="input-box1">
                                          <input type="text" id="billing_email" name="billing_email" value="<?php if(isset($clnEmail)){ echo $clnEmail;}?>" title="E-mail" maxlength="30" class="input-text required-entry">
                                          <span id="billing_emailError" class="redClr"></span>
                                        </div>
                                      </div>
                                      
                                    </div>
                                  </li>
                                  <li class="fields">
                                    <div class="input-box">
                                      <label for="billing:company">Company</label>
                                      <input type="text" id="billing_company" name="billing_company" value="" title="Company" class="input-text ">
                                    </div>

                                    <div class="input-box">
                                        <label for="billing:telephone">Mobile Number<em class="required">*</em></label>
                                        <input type="text" name="billing_telephone" value="<?php if(isset($clnPhone)){ echo $clnPhone;}?>" title="Telephone" class="input-text  required-entry" id="billing_telephone" maxlength="10" onkeypress="return _isNumberKey(event)">
                                        <span id="billing_telephoneError" class="redClr"></span>
                                    </div>

                                  </li>
                                  <li class="wide">
                                    <label for="billing:street1">Address<em class="required">*</em></label><br>
                                    
                                    <input type="text" title="Street Address" name="billing_street" id="billing_street" value="" class="input-text  required-entry">
                                    <span id="billing_streetError" class="redClr"></span>
                                  </li>
                                  
                                  <li class="fields">
                                    <div class="input-box">
                                      <label for="billing:city">State<em class="required">*</em></label>
                                      
                                      <select id="billing_state_id" name="billing_state_id" title="State/Province" class="validate-select required-entry" onchange="_billing_city_ajax(this.value)">
                                          <option value="">
                                            Please select region, state or province
                                          </option>
                                          <?php 
                                          $stateSql=mysqli_query($con, "select * from states where country_id='105' order by name asc");
                                          while ($stateLine=mysqli_fetch_assoc($stateSql)) {
                                          ?>
                                          <option value="<?php echo $stateLine['id'];?>">
                                            <?php echo $stateLine['name'];?>
                                          </option>
                                          <?php } ?>
                                        </select>
                                        <span id="billing_state_idError" class="redClr"></span>
                                    </div>
                                    <div class="field">
                                      <label for="billing:city_id">City<em class="required">*</em></label><br>
                                      <div class="input-box" id="billing_cityAjax">

                                        <select id="billing_city_id" name="billing_city_id" title="State/Province" class="validate-select required-entry">
                                          <option value="">
                                            Please select city
                                          </option>
                                        </select>
                                        <span id="billing_city_idError" class="redClr"></span>
                                        </div>
                                      </div>
                                    </li>
                                    <li class="fields">
                                      <div class="input-box">
                                        <label for="billing:postcode">Zip/Postal Code<em class="required">*</em></label>
                                        
                                        <input type="text" title="Zip/Postal Code" name="billing_postcode" id="billing_postcode" value="" class="input-text validate-zip-international  required-entry"maxlength="6" onkeypress="return _isNumberKey(event)">
                                        <span id="billing_postcodeError" class="redClr"></span>
                                      </div>
                                    </li>
                                   
                                    <!-- <li class="">
                                      <input type="checkbox" name="billing_save_in_address_book" value="1" title="Save in address book" id="billing_save_in_address_book" class="checkbox"><label for="billing:save_in_address_book">Save in address book</label>
                                    </li> -->
                                  </ul>
                                </fieldset>
                              </li>
                              <li class="">
                                <input type="radio" name="billing_use_for_shipping" value="1" title="Ship to this address" class="radio billing_shippingClass"> <label for="billing:use_for_shipping_yes">Ship to this address</label>
                                
                                <input type="radio" name="billing_use_for_shipping" value="0" checked="checked" title="Ship to different address" class="radio billing_shippingClass"> <label for="billing:use_for_shipping_no">Ship to different address</label>
                              </li>
                            </ul>
                            <div class="buttons-set" id="billing-buttons-container">
                              <p class="required">* Required Fields</p>
                              <button type="button" title="Continue" name="billing_submit" class="button continue" onclick="show_step(1)"><span>Continue</span></button>
                              
                              </div>
                            </fieldset>
                          
                        </div>
                      </li>

                      <li id="opc-shipping" class="section">
                        <div class="step-title" onClick="show_step_toggle(2)"> 
                          <span class="number">2</span>          
                          <h3 class="one_page_heading">  Shipping Information</h3>
                        </div>
                        <div id="checkout-step-shipping" class="step a-item" style="display:block;">

                            <input type="hidden" name="cartSubTotal_save" id="cartSubTotal_save">
                            <input type="hidden" name="gstTotal_save" id="gstTotal_save">
                            <input type="hidden" name="shippingTotal_save" id="shippingTotal_save">
                            <input type="hidden" name="orderTotal_save" id="orderTotal_save">
                            

                            <ul class="">
                             <li class="wide">
                               <label for="shipping-address-select">Select a shipping address from your address book or enter a new address.</label><br>
                               
                               <select name="shipping_address_id" id="shipping-address-select" class="address-select" title="" onChange="_selecShippingAddress(this.value)">
                                <?php
                                $shippingAddSql=mysqli_query($con,"select * from client_shipping_address where client_id='".$_SESSION['sess_clientId']."' order by shipping_firstname asc");
                                while($shippingAddLine=mysqli_fetch_assoc($shippingAddSql)){
                                ?>
                                <option value="<?php echo $shippingAddLine['id']?>">
                                  <?php echo $shippingAddLine['shipping_firstname']?>, 
                                  <?php echo $shippingAddLine['shipping_street']?>, 
                                  <?php echo $shippingAddLine['shipping_city_name'];?>
                                  - <?php echo $shippingAddLine['shipping_postcode']?>
                                </option>
                                <?php } ?>
                                <option value="999999">New Address</option>
                               </select>

                             </li>
                             <li id="shipping-new-address-form" style="display: none;">
                              <fieldset class="group-select">
                                <ul>
                                  <li class="fields">
                                    <div class="customer-name">
                                      <div class="input-box name-firstname">
                                        <label for="shipping:firstname">Full Name<span class="required">*</span></label>
                                        <div class="input-box1">
                                          <input type="text" id="shipping_firstname" name="shipping_firstname" value="" title="First Name" maxlength="50" onkeypress="return _isAlphabetKey(event)" class="input-text required-entry">
                                          <span id="shipping_firstnameError" class="redClr"></span>

                                        </div>
                                      </div>
                                      <div class="input-box">
                                        <label for="shipping:email">Email<span class="required">*</span></label>
                                        <div class="input-box1">
                                          <input type="text" id="shipping_email" name="shipping_email" value="" title="Email" class="input-text" maxlength="30">
                                          <span id="shipping_emailError" class="redClr"></span>
                                        </div>
                                      </div>
                                    </div>
                                  </li>
                                  <li class="fields">
                                    <div class="input-box">
                                      <label for="shipping:company">Company</label>
                                      
                                      <input type="text" id="shipping_company" name="shipping_company" value="" title="Company" class="input-text">
                                      
                                    </div>

                                    <div class="input-box">
                                      <label for="shipping:telephone">Mobile<em class="required">*</em></label>
                                        
                                      <input type="text" name="shipping_telephone" value="" title="Telephone" class="input-text  required-entry" id="shipping_telephone" maxlength="10" onkeypress="return _isNumberKey(event)">
                                      <span id="shipping_telephoneError" class="redClr"></span>
                                    </div>

                                  </li>
                                  <li class="wide">
                                    <label for="shipping:street1">Address<em class="required">*</em></label><br>
                                    
                                    <input type="text" title="Street Address" name="shipping_street" id="shipping_street" value="Street road" class="input-text  required-entry">
                                    <span id="shipping_streetError" class="redClr"></span>
                                  </li>
                                  
                                  <li class="fields">
                                    <div class="input-box">
                                      <label for="shipping:city">State<em class="required">*</em></label>
                                      
                                      <select id="shipping_state_id" name="shipping_state_id" title="State/Province" class="validate-select required-entry" onchange="_shippig_city_ajax(this.value)">
                                          <option value="">
                                            Please select region, state or province
                                          </option>
                                          <?php 
                                          $shippingStateSql=mysqli_query($con, "select * from states where country_id='105' order by name asc");
                                          while ($shippingStateLine=mysqli_fetch_assoc($shippingStateSql)) {
                                          ?>
                                          <option value="<?php echo $shippingStateLine['id'];?>">
                                            <?php echo $shippingStateLine['name'];?>
                                          </option>
                                          <?php } ?>
                                      </select>
                                      <span id="shipping_state_idError" class="redClr"></span>
                                    </div>
                                    <div class="input-box">
                                      <label for="shipping:city">City<em class="required">*</em></label>
                                      
                                      <select id="shipping_city_id" name="shipping_city_id" title="City" class="validate-select required-entry">
                                        <?php 
                                        $shippingCitySql=mysqli_query($con, "select * from cities order by city asc");
                                        while ($shippingCityLine=mysqli_fetch_assoc($shippingCitySql)) {
                                        ?>
                                        <option value="<?php echo $shippingCityLine['id'];?>">
                                          <?php echo $shippingCityLine['city'];?>
                                        </option>
                                        <?php } ?>
                                      </select>
                                      <span id="shipping_city_idError" class="redClr"></span>
                                      </div>
                                    </li>
                                    <li class="fields">
                                      <div class="input-box">
                                        <label for="shipping:postcode">Zip/Postal Code<em class="required">*</em></label>
                                        
                                        <input type="text" title="Zip/Postal Code" name="shipping_postcode" id="shipping_postcode" value="" class="input-text validate-zip-international  required-entry"maxlength="6" onkeypress="return _isNumberKey(event)">
                                        <span id="shipping_postcodeError" class="redClr"></span>
                                      </div>

                                    </li>
                                    <!-- <li class="">
                                      <input type="checkbox" name="shipping_save_in_address_book" value="1" title="Save in address book" id="shipping_save_in_address_book" class="checkbox"><label for="shipping:save_in_address_book">Save in address book</label></li> -->
                                    </ul>
                                  </fieldset>
                                </li>
                              </ul>
                              <div class="buttons-set" id="shipping-buttons-container">
                                <p class="required">* Required Fields</p>
                                
                                <button type="submit" name="finalSubmitBtn" id="finalSubmitBtn" class="button continue" title="Continue"><span>Continue</span></button>
                                
                                <a href="javascript:void(0)" onClick="show_step(2)"><small>« </small>Back</a>
                                </div>
                              

                            </div>
                          </li>
                          
                          </ol>

                          
                        </section>
                        </form>

                        <aside class="col-right sidebar col-sm-5  wow bounceInUp animated animated">      
                          <div id="checkout-progress-wrapper"><div class="block block-progress">
                            <div class="block-title">
                            Your Orders    </div>
                            <div class="block-content">
                              
              <fieldset>
                <table id="shopping-cart-table" class="data-table cart-table table-striped">
                  
                  <thead>
                    <tr class="first last">
                      <th rowspan="1">#</th>
                      <th rowspan="1"><span class="nobr">Product</span></th>
                      <th rowspan="1" class="a-center">Total</th>
                    </tr>
                  </thead>
                  <?php
                  $n=0;
                    $cartHeaderSubtotal=0;
                    if(!isset($_SESSION['sess_clientId'])){
                      $_SESSION['sess_clientId']='';
                    }

                    $cartHeaderTempSql=mysqli_query($con, "SELECT * from `tbl_temp` where ((sessionID = '".session_id()."')||((clientID='".$_SESSION['sess_clientId']."') && (clientID!=0)))");
                    $cartHeaderTempNum=mysqli_num_rows($cartHeaderTempSql);
                  ?>
           
                  <tbody>
                    <?php
                    if($cartHeaderTempNum>0) {
                      while($cartHeaderTempLine=mysqli_fetch_array($cartHeaderTempSql)) {

                      $prodCartSql=mysqli_query($con, "SELECT * from `tbl_product` where cid='".$cartHeaderTempLine['productID']."'");
                      $prodCartLine=mysqli_fetch_array($prodCartSql);

                      $cartHeaderSubtotal=$cartHeaderSubtotal+$cartHeaderTempLine['amount'];

                    ?>
                    <tr class="first last odd">
                      
                      <td class="image hidden-table">
                        <?php $n++; echo $n;?>.
                      </td>

                      <td>
                        <h2 class="product-name">
                          <?php echo ucwords($prodCartLine['title']);?> X <?php echo $cartHeaderTempLine['qnt'];?>
                        </h2>
                      </td>
                    
                      <td class="a-center movewishlist">
                        <span class="cart-price">
                          <span class="price">
                            <i class="fa fa-inr"></i>
                            <?php echo number_format($cartHeaderTempLine['amount'],2);?>
                          </span>                            
                        </span>
                      </td>

                     </tr> 
                    <?php } } else {?>
                      <tr class="first last odd">
                      
                        <td class="image hidden-table">
                          No item in cart...
                        </td>

                       </tr>
                    <?php } ?>
                      </tbody>
                   </table>

                 </fieldset>
               

               <table id="shopping-cart-totals-table" class="table shopping-cart-table-total">
                        <colgroup><col>
                          <col width="1">
                        </colgroup><tfoot>
                          <?php 
                          $calcul_gst=_calculate_gst($product_gst,$cartHeaderSubtotal); 
                          list($gstAmnt, $withGst)=$calcul_gst;
                          $shipping_charge=100;
                          $withGst=$withGst+$shipping_charge;
                          ?>
                          <tr>
                            <td style="" class="a-left" colspan="1">
                              <strong>Grand Total</strong>
                            </td>
                            <td style="" class="a-right">
                              <strong>
                                <span class="price">
                                  <input type="hidden" name="grandTotalAmount" id="grandTotalAmount" value="<?php echo $withGst;?>">
                                  <i class="fa fa-inr"></i>
                                  <?php echo number_format($withGst,2);?>
                                </span>
                              </strong>
                            </td>
                          </tr>
                        </tfoot>
                        <tbody>
                          <tr>
                            <td style="" class="a-left" colspan="1">
                            Subtotal    </td>
                            <td style="" class="a-right">
                              <span class="price">
                                <input type="hidden" name="subTotalAmount" id="subTotalAmount" value="<?php echo $cartHeaderSubtotal;?>">
                                <i class="fa fa-inr"></i>
                                <?php echo number_format($cartHeaderSubtotal,2);?>
                              </span>    
                            </td>
                            </tr>
                          </tbody>
                          <tbody>
                          <tr>
                            <td style="" class="a-left" colspan="1">
                            GST(<?php echo $product_gst;?>%)
                            </td>
                            <td style="" class="a-right">
                              <span class="price">
                                <input type="hidden" name="gstAmount" id="gstAmount" value="<?php echo $gstAmnt;?>">
                                <i class="fa fa-inr"></i>
                                <?php echo number_format($gstAmnt,2);?>
                              </span>    
                            </td>
                            </tr>

                            <tr>
                              <td style="" class="a-left" colspan="1">
                              Shipping Charge
                              </td>
                              <td style="" class="a-right">
                                <span class="price">
                                  <input type="hidden" name="shippingCharge" id="shippingCharge" value="<?php echo $shipping_charge;?>">
                                  <i class="fa fa-inr"></i>
                                  <?php echo number_format($shipping_charge,2);?>
                                </span>    
                              </td>
                            </tr>

                          </tbody>
                        </table>

                            </div>
                          </div></div>                 
                        </aside> <!--col-right sidebar-->           
                      </div><!--row-->   
                    </div><!--main-container-inner-->
                  </div> <!--main-container col2-left-layout-->      


                  <?php include "feature_box.php"; ?>

                <!-- For version 1,2,3,4,6 -->


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
</script>

<script type="text/javascript">

  /*for select billing city, start here*/
  function _billing_city_ajax(st_id){
    var st_id=st_id;

    $.ajax({
        method: 'POST',
        url: 'billing-city-ajax.php',
        data: 'st_id='+st_id,
        success : function(data_del) {
          $('#billing_cityAjax').html(data_del);
        }
    });

  }
  /*for select billing city, end here*/

  /*for select shipping city, start here*/
  function _shippig_city_ajax(stt_id){
    var stt_id=stt_id;

    $.ajax({
        method: 'POST',
        url: 'shipping-city-ajax.php',
        data: 'stt_id='+stt_id,
        success : function(data_del) {
          $('#shipping_city_id').html(data_del);
        }
    });

  }
  /*for select shipping city, end here*/

  /*show step 1 or 2 onclick, start here*/
  function show_step(val){
    
    if(val==1){
      
      $('#checkout-step-billing').hide();
      $('#checkout-step-shipping').show();
      $('#opc-billing').removeClass("active");
      $('#opc-shipping').addClass("active");

    } else if(val==2){
      
      $('#checkout-step-billing').show();
      $('#checkout-step-shipping').hide();
      $('#opc-billing').addClass("active");
      $('#opc-shipping').removeClass("active");

    }

  }
  /*show step 1 or 2 onclick, end here*/

  /*toggle step 1 or 2 onclick, start here*/
  function show_step_toggle(tg_vl){
    if(tg_vl==1) {
      $('#checkout-step-billing').toggle();
    } else if(tg_vl==2) {
      $('#checkout-step-shipping').toggle();
    }
  }
  /*toggle step 1 or 2 onclick, end here*/


  /*select shiiping address from dropdown, start here*/
  function _selecShippingAddress(ids){
    if(ids==999999){
      $('#shipping-new-address-form').show();
    } else {
      $('#shipping-new-address-form').hide();
    }
  }
  /*select shiiping address from dropdown, end here*/

  $('document').ready( function(){

    //save total amount at time of submit, start here
    $('#finalSubmitBtn').click(function(){
      $('#cartSubTotal_save').val($('#subTotalAmount').val());
      $('#orderTotal_save').val($('#grandTotalAmount').val());
      $('#gstTotal_save').val($('#gstAmount').val());
      $('#shippingTotal_save').val($('#shippingCharge').val());
    });
    //save total amount at time of submit, end here

    //save billing addressin shipping address, if both are same, start here
    $('.billing_shippingClass').click(function(){
      var add_val = $(this).val();

      if(add_val==1){

        $('#shipping_firstname').val($('#billing_firstname').val());
        $('#shipping_email').val($('#billing_email').val());
        $('#shipping_company').val($('#billing_company').val());
        $('#shipping_telephone').val($('#billing_telephone').val());
        $('#shipping_street').val($('#billing_street').val());
        $('#shipping_state_id').val($('#billing_state_id').val());
        $('#shipping_city_id').val($('#billing_city_id').val());
        $('#shipping_postcode').val($('#billing_postcode').val());

      } else if(add_val==0){

        $('#shipping_firstname').val('');
        $('#shipping_email').val('');
        $('#shipping_company').val('');
        $('#shipping_telephone').val('');
        $('#shipping_street').val('');
        $('#shipping_state_id').val('');
        $('#shipping_city_id').val('');
        $('#shipping_postcode').val('');
      }

    });
    //save billing addressin shipping address, if both are same, end here

  });

  function _validateBillingFrm(){

    var billing_firstname=document.getElementById('billing_firstname').value;
    var maill=document.getElementById('billing_email').value;
    var number=document.getElementById('billing_telephone').value;
    var billing_street=document.getElementById('billing_street').value;
    var billing_state_id=document.getElementById('billing_state_id').value;
    var billing_city_id=document.getElementById('billing_city_id').value;
    var billing_postcode=document.getElementById('billing_postcode').value;

    billing_firstname=billing_firstname.trim();
    maill=maill.trim();
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

    if(maill) {
      var ml=_mail_validate(maill);

      if(ml==2){
        document.getElementById("billing_email").style.borderColor = "red";
        document.getElementById("billing_emailError").innerHTML = "*Invalid E-mail address.";
      } else {
        document.getElementById("billing_email").style.borderColor = "green";
        document.getElementById("billing_email").placeholder = "";
        document.getElementById("billing_emailError").innerHTML = "";
      }
    } else {
      document.getElementById("billing_email").style.borderColor = "red";
      document.getElementById("billing_emailError").innerHTML = "*E-mail is required.";
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

    var ele = document.getElementsByName('billing_use_for_shipping');          
    for(i = 0; i < ele.length; i++) { 
        if(ele[i].checked) 
        var iddss=ele[i].value; 
    } 

    if(iddss==0){
      
      var shipping_address_select=document.getElementById('shipping-address-select').value;
      shipping_address_select=shipping_address_select.trim();

      if(shipping_address_select==999999){

        var shipping_firstname=document.getElementById('shipping_firstname').value;
        var shipping_email=document.getElementById('shipping_email').value;
        var shipping_telephone=document.getElementById('shipping_telephone').value;
        var shipping_street=document.getElementById('shipping_street').value;
        var shipping_state_id=document.getElementById('shipping_state_id').value;
        var shipping_city_id=document.getElementById('shipping_city_id').value;
        var shipping_postcode=document.getElementById('shipping_postcode').value;

        shipping_firstname=shipping_firstname.trim();
        shipping_email=shipping_email.trim();
        shipping_telephone=shipping_telephone.trim();
        shipping_street=shipping_street.trim();
        shipping_state_id=shipping_state_id.trim();
        shipping_city_id=shipping_city_id.trim();
        shipping_postcode=shipping_postcode.trim();

        if(shipping_firstname == "" || shipping_firstname == null) {
          document.getElementById("shipping_firstname").style.borderColor = "red";
          document.getElementById("shipping_firstnameError").innerHTML = "*Full name required.";
        }  else {
          document.getElementById("shipping_firstname").style.borderColor = "green";
          document.getElementById("shipping_firstnameError").innerHTML = "";
        }

        if(shipping_email) {
          var mll=_mail_validate(shipping_email);

          if(mll==2){
            document.getElementById("shipping_email").style.borderColor = "red";
            document.getElementById("shipping_emailError").innerHTML = "*Invalid E-mail address.";
          } else {
            document.getElementById("shipping_email").style.borderColor = "green";
            document.getElementById("shipping_email").placeholder = "";
            document.getElementById("shipping_emailError").innerHTML = "";
          }
        } else {
          document.getElementById("shipping_email").style.borderColor = "red";
          document.getElementById("shipping_emailError").innerHTML = "*E-mail is required.";
        }

        var numLnn=shipping_telephone.length;

        if(shipping_telephone == "" || shipping_telephone == null) {
          document.getElementById("shipping_telephone").style.borderColor = "red";
          document.getElementById("shipping_telephoneError").innerHTML = "*Mobile number is required.";
        }  else {
          if(numLnn!=10){
            document.getElementById("shipping_telephone").style.borderColor = "red";
            document.getElementById("shipping_telephoneError").innerHTML = "*Invalid mobile number";
          } else {
            document.getElementById("shipping_telephone").style.borderColor = "green";
            document.getElementById("shipping_telephoneError").innerHTML = "";
          }
        }

        if(shipping_street == "" || shipping_street == null) {
          document.getElementById("shipping_street").style.borderColor = "red";
          document.getElementById("shipping_streetError").innerHTML = "*Address required.";
        }  else {
          document.getElementById("shipping_street").style.borderColor = "green";
          document.getElementById("shipping_streetError").innerHTML = "";
        }

        if(shipping_state_id == "" || shipping_state_id == null) {
          document.getElementById("shipping_state_id").style.borderColor = "red";
          document.getElementById("shipping_state_idError").innerHTML = "*State name required.";
        }  else {
          document.getElementById("shipping_state_id").style.borderColor = "green";
          document.getElementById("shipping_state_idError").innerHTML = "";
        }

        if(shipping_city_id == "" || shipping_city_id == null) {
          document.getElementById("shipping_city_id").style.borderColor = "red";
          document.getElementById("shipping_city_idError").innerHTML = "*City name required.";
        }  else {
          document.getElementById("shipping_city_id").style.borderColor = "green";
          document.getElementById("shipping_city_idError").innerHTML = "";
        }

        if(shipping_postcode == "" || shipping_postcode == null) {
          document.getElementById("shipping_postcode").style.borderColor = "red";
          document.getElementById("shipping_postcodeError").innerHTML = "*Post Code required.";
        }  else {
          document.getElementById("shipping_postcode").style.borderColor = "green";
          document.getElementById("shipping_postcodeError").innerHTML = "";
        }
      }   

    } 

    if(iddss==0 && shipping_address_select==999999){
      
        if(billing_firstname == "" || billing_firstname == null || maill == "" || maill == null || ml==2 || numLn!=10 || number == "" || number == null || billing_street == "" || billing_street == null || billing_state_id == "" || billing_state_id == null || billing_city_id == "" || billing_city_id == null || billing_postcode == "" || billing_postcode == null || shipping_firstname == "" || shipping_firstname == null || shipping_email == "" || shipping_email == null || mll==2 || numLnn!=10 || shipping_telephone == "" || shipping_telephone == null || shipping_street == "" || shipping_street == null || shipping_state_id == "" || shipping_state_id == null || shipping_city_id == "" || shipping_city_id == null || shipping_postcode == "" || shipping_postcode == null) {
          return false;
        }
      
    } else if(billing_firstname == "" || billing_firstname == null || maill == "" || maill == null || ml==2 || numLn!=10 || number == "" || number == null || billing_street == "" || billing_street == null || billing_state_id == "" || billing_state_id == null || billing_city_id == "" || billing_city_id == null || billing_postcode == "" || billing_postcode == null) {
          return false;
    }
    
  }
</script>
</body>
</html>
