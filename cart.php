<?php
session_start();
require_once 'admin/core/core.php';
require_once 'admin/core/other-script.php';
@extract($_REQUEST);

if(isset($_POST['clear_cart_action'])){
  
  if(isset($_POST['id_del'])){
    $id_dels=$_POST['id_del'];
    $id_dels=implode(',',$id_dels);
  }
  
  mysqli_query($con, "delete from tbl_temp where id in ($id_dels)");

  header("location:cart.php");
}

if(isset($_POST['update_cart_action'])){
  
  if(isset($_POST['id_del'])){
    $id_dels=$_POST['id_del'];
    $lnt=count($id_dels);
  }

  if(isset($_POST['rate'])){
    $rate=$_POST['rate'];
  }

  if(isset($_POST['qnt'])){
    $qnt=$_POST['qnt'];
  }

  for($n=0; $n<$lnt; $n++){
    $amount=0;
    $amount=$rate[$n]*$qnt[$n];
    mysqli_query($con, "update tbl_temp set qnt='".$qnt[$n]."', amount='$amount' where id='".$id_dels[$n]."' and sessionID='".session_id()."'");
  }
  header("location:cart.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title><?php echo SITE_TITLE ?> || Cart</title>
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

      <div class="main-container col1-layout wow bounceInUp animated">     

       <div class="main" id="show_cart_in_page">                     
        <div class="cart wow bounceInUp animated">

          <div class="table-responsive shopping-cart-tbl  container">
            <form action="cart.php" method="post">
              <input name="form_key" type="hidden" value="EPYwQxF6xoWcjLUr">
              <fieldset>
                <table id="shopping-cart-table" class="data-table cart-table table-striped">
                  <colgroup><col width="1">
                    <col>
                    <col width="1">
                    <col width="1">
                    <col width="1">
                    <col width="1">
                    <col width="1">

                  </colgroup><thead>
                    <tr class="first last">
                      <th rowspan="1">#</th>
                      <th rowspan="1">Image</th>
                      <th rowspan="1"><span class="nobr">Product Name</span></th>
                      <th class="a-center" colspan="1"><span class="nobr">Unit Price</span></th>
                      <th rowspan="1" class="a-center">Qty</th>
                      <th class="a-center" colspan="1">Subtotal</th>
                      <th rowspan="1" class="a-center">Delete</th>
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
                  <tfoot>
                    <tr class="first last">
                      <td colspan="50" class="a-right last">

                        <button type="button" title="Continue Shopping" class="button btn-continue" onclick="location.href='listing.php'">
                          <span><span>Continue Shopping</span></span>
                        </button>
                        
                        <?php if($cartHeaderTempNum>0){?>
                          <button type="submit" name="update_cart_action" value="update_qty" title="Update Cart" class="button btn-update">
                            <span><span>Update Cart</span></span>
                          </button>

                          <button type="submit" name="clear_cart_action" value="empty_cart" title="Clear Cart" class="button btn-empty" id="empty_cart_button">
                            <span><span>Clear Cart</span></span>
                          </button>
                        <?php } ?>
                      </td>
                    </tr>
                  </tfoot>
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
                        <input type="hidden" name="id_del[]" value="<?php echo $cartHeaderTempLine['id'];?>">
                      </td>

                      <td class="image hidden-table">
                        <a href="product-detail.php?pro_id=<?php echo md5($prodCartLine['cid']);?>" title="<?php echo $prodCartLine['title'];?>" class="product-image">
                          <img src="admin/control/images/<?php echo $prodCartLine['primaryImage'];?>" width="75" alt="<?php echo $prodCartLine['title'];?>" style="max-height: 70px; max-width: 50px;">
                        </a>
                      </td>

                      <td>
                        <h2 class="product-name">
                          <input type="hidden" name="product_id[]" value="<?php echo $prodCartLine['cid'];?>">
                          <a href="product-detail.php?pro_id=<?php echo md5($prodCartLine['cid']);?>">
                            <?php echo ucwords($prodCartLine['title']);?>
                          </a>
                        </h2>
                      </td>
                    
                      <td class="a-center hidden-table">
                        <span class="cart-price">
                          <span class="price">
                            <input type="hidden" name="rate[]" value="<?php echo $cartHeaderTempLine['rate'];?>">
                            <i class="fa fa-inr"></i>
                            <?php echo number_format($cartHeaderTempLine['rate'],2);?>
                          </span>                
                        </span>
                      </td>

                      <td class="a-center movewishlist">
                        <input type="text" name="qnt[]" value="<?php echo $cartHeaderTempLine['qnt'];?>" size="4" title="Qty" class="input-text qty" maxlength="3">
                      </td>

                      <td class="a-center movewishlist">
                        <span class="cart-price">
                          <span class="price">
                            <i class="fa fa-inr"></i>
                            <?php echo number_format($cartHeaderTempLine['amount'],2);?>
                          </span>                            
                        </span>
                      </td>

                      <td class="a-center last">
                       <a href="javascript:void(0)" onclick="_deleteItemFromCartPage(<?php echo $cartHeaderTempLine['id'];?>)" title="Remove item" class="button remove-item">
                        <span><span>Remove item</span></span>
                       </a>
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
               </form>
             </div>

             <!-- BEGIN CART COLLATERALS -->


             <div class="cart-collaterals container"> 
              <!-- BEGIN COL2 SEL COL 1 -->
              <div class="row">

                <!-- BEGIN TOTALS COL 2 -->
                  <!-- <div class="col-sm-4">    

                    <div class="discount">
                      <h3>Discount Codes</h3>
                      <form id="discount-coupon-form" action="#" method="post">                       
                        <label for="coupon_code">Enter your coupon code if you have one.</label>
                        <input type="hidden" name="remove" id="remove-coupone" value="0">                          
                        <input class="input-text fullwidth" type="text" id="coupon_code" name="coupon_code" value="">                                                      
                        <button type="button" title="Apply Coupon" class="button coupon " onClick="discountForm.submit(false)" value="Apply Coupon"><span>Apply Coupon</span></button>                

                      </form>

                    </div> !--discount--
                  </div> --> <!--col-sm-4-->

                  <div class="col-sm-8">&nbsp;</div>

                  <div class="col-sm-4 text">
                   <div class="totals">
                    <h3>Shopping Cart Total</h3>
                    <div class="inner">
                      <?php 
                      $calcul_gst=_calculate_gst($product_gst,$cartHeaderSubtotal); 
                      list($gstAmnt, $withGst)=$calcul_gst;
                      ?> 
                      <table id="shopping-cart-totals-table" class="table shopping-cart-table-total">
                        <colgroup><col>
                          <col width="1">
                        </colgroup><tfoot>
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

                            <tr>
                            <td style="" class="a-left" colspan="1">
                            GST(<?php echo $product_gst;?>%)    </td>
                            <td style="" class="a-right">
                              <span class="price">
                                <input type="hidden" name="gstAmount" id="gstAmount" value="<?php echo $gstAmnt;?>">
                                <i class="fa fa-inr"></i>
                                <?php echo number_format($gstAmnt,2);?>
                              </span>    
                            </td>
                            </tr>

                          </tbody>
                        </table>

                        <ul class="checkout">           
                          <li>
                            <button type="button" title="Proceed to Checkout" class="button btn-proceed-checkout" onclick="location.href='checkout.php'"><span>Proceed to Checkout</span></button>
                          </li><br>
                        </ul>                
                      </div><!--inner-->
                    </div><!--totals-->
                  </div> <!--col-sm-4-->


                </div> <!--cart-collaterals-->


              </div>
            </div>  <!--cart-->

          </div><!--main-container-->
          
        </div> <!--col1-layout-->


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
</body>
</html>
