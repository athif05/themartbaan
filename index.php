<?php
session_start();
require_once 'admin/core/core.php';
require_once 'admin/core/other-script.php';
@extract($_REQUEST);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title><?php echo SITE_TITLE ?> || Home</title>
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
  <link rel="stylesheet" href="../../../use.typekit.net/hxi4fbo.css">
  <link href="https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,500,600,700" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:700,600,800,400' rel='stylesheet' type='text/css'>
  <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i,900" rel="stylesheet">
</head>
<body>
  <div id="page">
    <?php include ('header.php'); ?>
<!--container-->

<div class="content">
  <div id="thmg-slider-slideshow" class="thmg-slider-slideshow">
    <div class="container">
      <div id='thm_slider_wrapper' class='thm_slider_wrapper fullwidthbanner-container' >
        <div id='thm-rev-slider' class='rev_slider fullwidthabanner'>
          <ul>
            <?php
            $sliderSql=mysqli_query($con,"select * from slider order by priority asc");
            while($sliderLine=mysqli_fetch_assoc($sliderSql)){
            ?>
            <li data-transition='random' data-slotamount='7' data-masterspeed='1000' data-thumb='admin/control/<?php echo $sliderLine['image'];?>'>
              <img src='admin/control/<?php echo $sliderLine['image'];?>'  data-bgposition='left top'  data-bgfit='cover' data-bgrepeat='no-repeat' alt="admin/control/<?php echo $sliderLine['image'];?>" />
              <div class="info">
                <div class='tp-caption ExtraLargeTitle sft  tp-resizeme ' data-x='0'  data-y='180'  data-endspeed='500'  data-speed='500' data-start='1100' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:2; white-space:nowrap;'><span><?php echo $sliderLine['text1'];?></span></div>
                <div class='tp-caption LargeTitle sfl  tp-resizeme ' data-x='0'  data-y='240'  data-endspeed='500'  data-speed='500' data-start='1300' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:3; white-space:nowrap;'><span><?php echo $sliderLine['text2'];?></span></div>
                <div class='tp-caption sfb  tp-resizeme ' data-x='0'  data-y='470'  data-endspeed='500'  data-speed='500' data-start='1500' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4; white-space:nowrap;'><a href='listing.php' class="buy-btn">Order Now</a></div>
                <div    class='tp-caption Title sft  tp-resizeme ' data-x='0'  data-y='360'  data-endspeed='500'  data-speed='500' data-start='1500' data-easing='Power2.easeInOut' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4; white-space:nowrap;'><?php echo $sliderLine['text3'];?></div>
              </div>
            </li>
            <?php }  ?>

          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- best Pro Slider -->
  <section class="best-sell">
    <div class="best-pro slider-items-products container">
      <div class="new_title">
       <h4>Good Taste</h4>
       <h2>Magical Flavours</h2>
       <p>Purani Yaad aur Wahi Lajawaab swad !!</p>
     </div>
     <div id="best-seller" class="product-flexslider hidden-buttons">
      <div class="slider-items slider-width-col3 products-grid">

        <?php
        $productSql=mysqli_query($con, "select cid, primaryImage, title from tbl_product as pr order by cid asc");
        while($productLine=mysqli_fetch_assoc($productSql)){

          $inventorySql=mysqli_query($con, "select attributeNameId, discountPrice from tbl_product_inventory where prod_id='".$productLine['cid']."'");
          $inventoryLine=mysqli_fetch_assoc($inventorySql);

          $weightSql=mysqli_query($con, "select attr_value from tbl_attribute where cid='".$inventoryLine['attributeNameId']."'");
          $weightLine=mysqli_fetch_assoc($weightSql);

          $itemWghtId=$inventoryLine['attributeNameId'];
        ?>
        <div class="item">
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
                <!-- onclick="location.href='product-detail.php?pro_id=<?php //echo md5($productLine['cid']);?>'" -->
              </div>
            </div>
            <div class="item-info">
              <div class="info-inner">
                <div class="item-title">
                  <a href="product-detail.php?pro_id=<?php echo md5($productLine['cid']);?>" title="<?php echo ucwords($productLine['title']);?>">
                    <?php echo ucwords($productLine['title']);?> <?php echo strtolower($weightLine['attr_value']);?>.
                  </a> 
                </div>
                <div class="item-content">
                  <div class="item-price">
                    <div class="price-box">
                      <span class="regular-price" >
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
        </div>
        <?php } ?>

      </div>
    </div>
  </div>
</section>



<div id="top">
  <div class="container">
    <div class="row">
      <?php 
      $bannerSql=mysqli_query($con, "select * from banner where status=1 order by priority asc");
      while($bannerLine=mysqli_fetch_assoc($bannerSql)){
      ?>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="figure banner-with-effects effect-sadie1 banner-width  with-button" style="background-color:#ffffff"><img src="admin/control/<?php echo $bannerLine['image'];?>" alt="promotion-banner1">
          <div class="figcaption">
            <div class="banner-content left top"><span class="small-title"><?php echo $bannerLine['text1'];?></span><br>
              <span class="big-title"><?php echo $bannerLine['text2'];?></span>
              <a href="listing.php" class="btn_type_1" rel="nofollow">Order Now</a>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>

    </div>
  </div>
</div>

<div class="hot-section">
  <div class="container">

    <div class="row">
      <h3>Happy Customers</h3>
    </div>

    <div class="row">
      <div class="testimonials-section slider-items-products">
        <div  id="testimonials" class="offer-slider parallax parallax-2">
          <div class="slider-items slider-width-col6">
            
            <?php
            $testimonialsSql=mysqli_query($con, "select * from testimonial where status=1");
            while($testimonialsLine=mysqli_fetch_assoc($testimonialsSql)){
            ?>
            <div class="item">
              <div class="testimonials"><?php echo $testimonialsLine['description']; ?></div>
              <div class="clients_author"> <?php echo $testimonialsLine['heading']; ?> </div>
            </div>
            <?php } ?>

          </div>
        </div>
      </div>
    </div>

  </div>
</div>

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
