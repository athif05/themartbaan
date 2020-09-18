<?php
session_start();
require_once 'admin/core/core.php';
require_once 'admin/core/other-script.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title><?php echo SITE_TITLE ?> || Listing</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Default Description">
  <meta name="keywords" content="fashion, store, E-commerce">
  <meta name="robots" content="*">
  <link rel="icon" href="#" type="image/x-icon">
  <link rel="shortcut icon" href="admin/assets/images/favicon.png">

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
          <h2>Chatpate Flavours</h2>
        </div>
      </div>
      <section class="main-container col2-left-layout bounceInUp animated"> 
        <!-- For version 1, 2, 3, 8 --> 
        <!-- For version 1, 2, 3 -->
        <div class="container">
          <div class="row">
            <div class="col-main col-sm-9 col-sm-push-3 product-grid">
              <div class="pro-coloumn">
                <div class="category-description std">
                  <div class="slider-items-products">
                    <div id="category-desc-slider" class="product-flexslider hidden-buttons">
                      <div class="slider-items slider-width-col1 owl-carousel owl-theme"> 


                        <?php
                        $listingSliderSql=mysqli_query($con, "select * from listing_slider where status=1 order by priority");
                        while ($listingSliderLine=mysqli_fetch_assoc($listingSliderSql)) {
                        ?>
                        <div class="item"> 
                          <a href="#">
                            <img alt="" src="admin/control/<?php echo $listingSliderLine['image'];?>">
                          </a>
                        </div>
                        <?php } ?>

                        
                      </div>
                    </div>
                  </div>
                </div>

                <article>
                
                  <div class="category-products">
                    <ul class="products-grid">
                      <?php
                      $productSql=mysqli_query($con, "select cid, primaryImage, title from tbl_product as pr order by cid asc");
                      while($productLine=mysqli_fetch_assoc($productSql)){

                        $inventorySql=mysqli_query($con, "select attributeNameId, discountPrice from tbl_product_inventory where prod_id='".$productLine['cid']."'");
                        $inventoryLine=mysqli_fetch_assoc($inventorySql);

                        $weightSql=mysqli_query($con, "select attr_value from tbl_attribute where cid='".$inventoryLine['attributeNameId']."'");
                        $weightLine=mysqli_fetch_assoc($weightSql);

                        $itemWghtId=$inventoryLine['attributeNameId'];
          
                      ?>
                      <li class="item col-lg-4 col-md-3 col-sm-4 col-xs-6">
                       <div class="item-inner">
                        <div class="item-img">
                          <div class="item-img-info">
                            <a href="product-detail.php?pro_id=<?php echo md5($productLine['cid']);?>" title="<?php echo ucwords($productLine['title']);?>" class="product-image">
                              <img src="admin/control/images/<?php echo $productLine['primaryImage'];?>" alt="<?php echo ucwords($productLine['title']);?>" style="max-height: 280px;">
                            </a>
                          </div>
                          <div class="add_cart">
                            <button class="button btn-cart" type="button" onclick="_add_to_cart(<?php echo $productLine['cid'];?>,1,<?php echo $itemWghtId;?>)">
                              <span>Add to Cart</span>
                            </button>
                          </div>
                        </div>
                        <div class="item-info">
                          <div class="info-inner">
                            <div class="item-title">
                              <a href="product-detail.php?pro_id=<?php echo md5($productLine['cid']);?>" title="<?php echo ucwords($productLine['title']);?>">
                                <?php echo ucwords($productLine['title']);?> 
                              </a> 
                            </div>
                            <div class="item-content">
                              <div class="item-price">
                                <div class="price-box">
                                  <span class="regular-price">
                                    <span class="price">
                                      <i class="fa fa-inr"></i> 
                                      <?php echo number_format($inventoryLine['discountPrice'],2,".",",");?>
                                    </span> 
                                  </span> 
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <?php } ?>

                  </ul>
                </div>
                
              </article>
            </div>
            <!--  ///*///======    End article  ========= //*/// --> 
          </div>
          <aside class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9 wow bounceInUp animated"> 

            <div class="block block-list block-cart" id='listing_sidebar_cart'>
              <div class="block-title"> My Cart </div>
              <?php
              if(!isset($_SESSION['sess_clientId'])){
                $_SESSION['sess_clientId']='';
              }

              $cartHeaderTempSql2=mysqli_query($con, "SELECT * from `tbl_temp` where ((sessionID = '".session_id()."')||((clientID='".$_SESSION['sess_clientId']."') && (clientID!=0)))");
              $cartHeaderTempNum2=mysqli_num_rows($cartHeaderTempSql2);
              $_SESSION['sess_cartHeaderTempNum']=$cartHeaderTempNum2;
              ?>  
              <div class="block-content">
                <div class="summary">
                  <p class="amount">There is <a href="#"><?php echo $_SESSION['sess_cartHeaderTempNum']?> item</a> in your cart.</p>
                  <p class="subtotal"> <span class="label">Cart Subtotal:</span> <span class="price"><i class="fa fa-inr"></i><?php echo number_format($total_cart_amount,2); ?></span> </p>
                </div>
                <div class="ajax-checkout">
                  <button type="button" title="Checkout" class="button button-checkout" onclick="location.href='checkout.php'"> <span>Checkout</span> </button>
                </div>
                <p class="block-subtitle">Recently added item(s)</p>
                <ul id="cart-sidebar1" class="mini-products-list">

                  <?php 
                  if($cartHeaderTempNum2>0) {

                      while($cartHeaderTempLine2=mysqli_fetch_array($cartHeaderTempSql2)) {

                      $prodCartSql2=mysqli_query($con, "SELECT * from `tbl_product` where cid='".$cartHeaderTempLine2['productID']."'");
                      $prodCartLine2=mysqli_fetch_array($prodCartSql2);
                  ?>

                  <li class="item">
                    <div class="item-inner"> 
                      <a title="<?php echo $prodCartLine2['title'];?>" href="product-detail.php?pro_id=<?php echo md5($prodCartLine2['cid']);?>" class="product-image">
                        <?php
                          if(!empty($prodCartLine2['primaryImage'])) {
                        ?>
                        <img alt="<?php echo $prodCartLine2['title'];?>" src="admin/control/images/<?php echo $prodCartLine2['primaryImage'];?>" width="80" >
                        <?php } ?>
                      </a>
                      <div class="product-details">
                        <div class="access"> 
                          <a href="javascript:void(0)" onclick="_deleteFromListingCart(<?php echo $cartHeaderTempLine2['id'];?>)" class="btn-remove1">Remove</a> 
                          <!-- <a href="#" title="Edit item" class="btn-edit">
                            <i class="icon-pencil"></i><span class="hidden">Edit item</span>
                          </a> --> 
                        </div>
                            <!--access--> 

                            <strong><?php echo $cartHeaderTempLine2['qnt'];?></strong> x <span class="price"><i class="fa fa-inr"></i><?php echo number_format($cartHeaderTempLine2['rate'],2);?></span>
                            <p class="product-name">
                              <a href="product-detail.php?pro_id=<?php echo md5($prodCartLine2['cid']);?>">
                                <?php echo ucwords($prodCartLine2['title']);?>
                              </a>
                            </p>
                          </div>
                          <!--product-details-bottoms--> 
                        </div>
                      </li>
                      <?php } ?>
                      <?php } else {?>
                        <li class="item">
                          <div class="item-inner">
                            No item in cart....
                          </div>
                        </li>
                      <?php } ?>

                        </ul>
                      </div>
                    </div>

                    <!-- BEGIN SIDE-NAV-CATEGORY -->
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



                      <!--block block-list block-compare--> 




                    </aside>
                    <!--col-right sidebar--> 
                  </div>
                  <!--row--> 
                </div>
                <!--container--> 
              </section>
              <!--main-container col2-left-layout--> 

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
    </script>
  </body>
  </html>
