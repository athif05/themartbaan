<?php
session_start();
require_once 'admin/core/core.php';
require_once 'admin/core/other-script.php';
@extract($_REQUEST);

if($pro_id){
  
  $productSql=mysqli_query($con, "select * from tbl_product where md5(cid)='$pro_id'");
  $productLine=mysqli_fetch_assoc($productSql);

  $productPolicySql=mysqli_query($con, "select * from product_policy");
  $productPolicyLine=mysqli_fetch_assoc($productPolicySql);

  $inventorySql=mysqli_query($con, "select attributeNameId, discountPrice, sum(inventory) as stock from tbl_product_inventory where prod_id='".$productLine['cid']."' order by discountPrice asc");
  $inventoryLine=mysqli_fetch_assoc($inventorySql);

  $weightSql=mysqli_query($con, "select attr_value from tbl_attribute where cid='".$inventoryLine['attributeNameId']."'");
  $weightLine=mysqli_fetch_assoc($weightSql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title><?php echo SITE_TITLE ?> || Product Details</title>
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
      <div class="main-container col1-layout wow bounceInUp animated">
        <div class="main">
          <div class="col-main no-margin">
            <!-- Endif Next Previous Product -->
            <div class="product-view wow bounceInUp animated" itemscope="" itemtype="" itemid="#product_base">
              <div id="messages_product_view"></div>
              <!--product-next-prev-->
              <div class="product-essential container">
                <div class="row">

                  <form action="#" method="post" id="product_addtocart_form">
                    <!--End For version 1, 2, 6 -->
                    <!-- For version 3 -->
                    <div class="product-img-box col-lg-6 col-sm-6 col-xs-12">
                      <div class="product-image">
                        <div class="product-full"> 
                          <img id="product-zoom" src="admin/control/images/<?php echo $productLine['primaryImage'];?>" data-zoom-image="admin/control/images/<?php echo $productLine['primaryImage'];?>" alt="<?php echo $productLine['title'];?>"/> </div>
                        <div class="more-views">
                          <div class="slider-items-products">
                            <div id="gallery_01" class="product-flexslider hidden-buttons product-img-thumb">
                              <div class="slider-items slider-width-col4 block-content">

                                <?php if($productLine['primaryImage']){?>
                                <div class="more-views-items"> 
                                  <a href="#" data-image="admin/control/images/<?php echo $productLine['primaryImage'];?>" data-zoom-image="admin/control/images/<?php echo $productLine['primaryImage'];?>"> 
                                    <img id="product-zoom0"  src="admin/control/images/<?php echo $productLine['primaryImage'];?>" alt="product-image"/> 
                                  </a>
                                </div>
                                <?php } ?>

                                <?php if($productLine['image1']){?>
                                <div class="more-views-items"> 
                                  <a href="#" data-image="admin/control/images/<?php echo $productLine['image1'];?>" data-zoom-image="admin/control/images/<?php echo $productLine['image1'];?>"> 
                                    <img id="product-zoom1"  src="admin/control/images/<?php echo $productLine['image1'];?>" alt="product-image"/> 
                                  </a>
                                </div>
                                <?php } ?>

                                <?php if($productLine['image2']){?>
                                <div class="more-views-items"> 
                                  <a href="#" data-image="admin/control/images/<?php echo $productLine['image2'];?>" data-zoom-image="admin/control/images/<?php echo $productLine['image2'];?>"> 
                                    <img id="product-zoom2"  src="admin/control/images/<?php echo $productLine['image2'];?>" alt="product-image"/> 
                                  </a>
                                </div>
                                <?php } ?>

                                <?php if($productLine['image3']){?>
                                <div class="more-views-items"> 
                                  <a href="#" data-image="admin/control/images/<?php echo $productLine['image3'];?>" data-zoom-image="admin/control/images/<?php echo $productLine['image3'];?>"> 
                                    <img id="product-zoom3" src="admin/control/images/<?php echo $productLine['image3'];?>" alt="product-image"/> 
                                  </a> 
                                </div>
                                <?php } ?>

                                <!-- <div class="more-views-items"> 
                                  <a href="#" data-image="products-images/p3.jpg" data-zoom-image="products-images/p6.jpg"> 
                                    <img id="product-zoom4"  src="products-images/p3.jpg" alt="product-image" /> 
                                  </a>
                                </div> -->

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- end: more-images --> 
                    </div>
                    <!--End For version 1,2,6-->
                    <!-- For version 3 -->
                    <div class="product-shop col-lg- col-sm-6 col-xs-12">

                      <div class="product-name">
                        <h1><?php echo ucwords($productLine['title']);?> (<?php echo strtolower($weightLine['attr_value']);?>) </h1>
                      </div>
                      <div class="price-block">
                        <div class="price-box">
                          <?php if($inventoryLine['stock']>0){?>
                          <p class="availability in-stock"><span>In Stock</span></p>
                          <?php } else {?>
                            <p class="availability out-stock"><span>Out of Stock</span></p>
                          <?php } ?>
                          <p class="special-price"> <span class="price-label">Special Price</span> <span id="product-price-48" class="price"><i class="fa fa-inr"></i> <?php echo number_format($inventoryLine['discountPrice'],2,".",",");?> </span> </p>

                        </div>
                      </div>
                      <div class="add-to-box">
                        <div class="add-to-cart">
                          <div class="pull-left">
                            <div class="custom pull-left">
                              <button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty > 0 ) result.value--;return false;" class="reduced items-count" type="button"><i class="fa fa-minus">&nbsp;</i></button>
                              <input type="text" class="input-text qty" title="Qty" value="1" maxlength="12" id="qty" name="qty">
                              <button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="increase items-count" type="button"><i class="fa fa-plus">&nbsp;</i></button>
                            </div>
                          </div>
                          <button onclick="productAddToCartForm.submit(this)" class="button btn-cart" title="Add to Cart" type="button">Add to Cart</button>
                        </div>

                        <!-- Material unchecked -->
                        <div class="funkyradio">
                          <?php
                          $c=1;
                          $inventoryLoopSql=mysqli_query($con, "select attributeNameId, discountPrice from tbl_product_inventory where prod_id='".$productLine['cid']."' order by discountPrice asc");
                          while($inventoryLoopLine=mysqli_fetch_assoc($inventoryLoopSql)){

                          $weightLoopSql=mysqli_query($con, "select attr_value from tbl_attribute where cid='".$inventoryLoopLine['attributeNameId']."'");
                          $weightLoopLine=mysqli_fetch_assoc($weightLoopSql);
                          ?>
                          <div class="funkyradio-primary">
                            <input type="checkbox" name="checkbox" id="checkbox<?php echo $c;?>" unchecked/>
                            <label for="checkbox<?php echo $c;?>"><?php echo strtolower($weightLoopLine['attr_value']);?>. Pickle Rs.<?php echo number_format($inventoryLoopLine['discountPrice'],2,".",",");?></label>
                          </div>
                          <?php $c++; } ?>
                          
                        </div>

                      </div>
                      <div class="short-description">
                        <?php echo substr($productLine['description'],0,300);?>
                      </div>

                      <?php echo $productPolicyLine['description'];?>                      

                    </div>
                    <!--product-shop-->
                    <!--Detail page static block for version 3-->
                  </form>
                </div>
              </div>
              <!--product-essential-->
              <div class="product-collateral">
                <div class="pro-tabs">
                  <div class="container">
                    <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
                      <li class="active"> <a href="#product_tabs_description" data-toggle="tab"> Product Description </a> </li>
                      <li><a href="#product_tabs_tags" data-toggle="tab">Ingredients</a></li>
                      <li> <a href="#reviews_tabs" data-toggle="tab">Reviews</a> </li>
                    </ul>
                  </div>
                </div>
                <div class="container">
                  <div id="productTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="product_tabs_description">
                      <div class="std">

                        <?php echo $productLine['description'];?> 
                        <!-- <img alt="" src="images/custom-img2.jpg" style="float:right">-->
                      </div>
                    </div>
                    <div class="tab-pane fade" id="product_tabs_tags">
                      <div class="box-collateral box-tags">
                       
                        <?php echo $productLine['ingredients'];?>

                      </div>
                    </div>
                    <div class="tab-pane fade in" id="reviews_tabs">
                      <div class="woocommerce-Reviews">
                        <?php
                        $reviewSql=mysqli_query($con, "select * from `product_review` where product_id='".$productLine['cid']."' order by id desc");
                        $reviewNum=mysqli_num_rows($reviewSql);
                        
                        ?>
                        <div>
                          <h2 class="woocommerce-Reviews-title"><?php echo $reviewNum;?> reviews for <span><?php echo ucwords($productLine['title']);?></span></h2>
                          <ol class="commentlist">
                            <?php 
                            if($reviewNum>0){
                              while ($reviewLine=mysqli_fetch_assoc($reviewSql)) {

                                $fullStar=$reviewLine['review_star'];
                                $blankStar=5-$fullStar;
                            ?>
                            <li class="comment">
                              <div>
                                <div class="comment-text">
                                  <div class="ratings">
                                    <!-- <div class="rating-box">
                                      <div style="width:100%" class="rating"></div>
                                    </div> -->
                                    <?php for($f=0;$f<$fullStar;$f++){ ?>
                                    <img src="images/yellow_star.png" style="height: 13px;">
                                    <?php } ?>

                                    <?php for($b=0;$b<$blankStar;$b++){ ?>
                                    <img src="images/blank_star.png" style="height: 12px;">
                                    <?php } ?>
                                  </div>
                                  <p class="meta">
                                    <strong><?php echo ucwords($reviewLine['author']);?></strong> 
                                    <span>–</span> <?php echo date('M d, Y',strtotime($reviewLine['post_date']));?>
                                  </p>
                                  <div class="description">
                                    <p><?php echo ucfirst($reviewLine['comment']);?></p>
                                  </div>
                                </div>
                              </div>
                            </li><!-- #comment-## -->
                            <?php } } else {?>
                            <li class="comment">
                              <div>
                                <div class="comment-text">
                                  
                                  <p class="meta">
                                    No review....
                                  </p>
                                  
                                </div>
                              </div>
                            </li><!-- #comment-## -->
                            <?php } ?>
                          </ol>
                        </div>
                        <div>
                          <div>
                            <div class="comment-respond">

                              <?php if(isset($_SESSION['sess_msg']) && $_SESSION['sess_msg']!=''){?>
                              <div class="alert alert-success text-center" role="alert">
                                  <?php echo $_SESSION['sess_msg']; $_SESSION['sess_msg']='';?>
                              </div>
                              <?php } ?>

                              <span class="comment-reply-title">Add a review </span>      
                              <form action="product-review-code.php" method="post" class="comment-form" onsubmit="return _validateReviewFrm()">
                                <input type="hidden" name="client_id" id="client_id" value="<?php if(isset($_SESSION['sess_clientId']) && $_SESSION['sess_clientId']!=''){ echo $_SESSION['sess_clientId'];} else { echo "0"; }?>">
                                <input type="hidden" name="product_id" id="product_id" value="<?php echo $productLine['cid'];?>">
                                <input type="hidden" name="review_star" id="review_star" value="0">
                                <div class="comment-form-rating">
                                  <label id="rating">Your rating</label>
                                  <p class="stars">
                                    <span>
                                      <a class="star-1" id="str1" href="Javascript:void(0)" onmouseover="_starRat(1)">1</a>
                                      <a class="star-2" id="str2" href="Javascript:void(0)" onmouseover="_starRat(2)">2</a>
                                      <a class="star-3" id="str3" href="Javascript:void(0)" onmouseover="_starRat(3)">3</a>
                                      <a class="star-4" id="str4" href="Javascript:void(0)" onmouseover="_starRat(4)">4</a>
                                      <a class="star-5" id="str5" href="Javascript:void(0)" onmouseover="_starRat(5)">5</a>
                                    </span>
                                  </p>
                                </div>
                                <p class="comment-form-comment">
                                  <label>Your review <span class="required">*</span></label>
                                  <textarea id="comment" name="comment" cols="45" rows="8"></textarea>
                                  <span id="commentError" class="redClr"></span>
                                </p>
                                <p class="comment-form-author">
                                  <label for="author">Name <span class="required">*</span></label> 
                                  <input id="author" name="author" type="text" value="" maxlength="50" onkeypress="return _isAlphabetKey(event)">
                                  <span id="authorError" class="redClr"></span>
                                </p>
                                  <p class="comment-form-email">
                                    <label for="email">Email <span class="required">*</span></label> 
                                    <input id="email" name="email" type="text" value="" maxlength="30">
                                    <span id="emailError" class="redClr"></span>
                                  </p>
                                    <p class="form-submit">
                                      <input name="submit" type="submit" id="submit" class="submit" value="Submit"> 
                                    </p>
                                  </form>
                                </div><!-- #respond -->
                              </div>
                            </div>
                            <div class="clear"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--box-additional-->
                <!--product-view-->
              </div>
            </div>
            <!--col-main-->
          </div>
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
<script src="js/cloud-zoom.js"></script>
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

  function _starRat(rt){
    $('#review_star').val(rt);
    for(var t=1;t<=5;t++){
      $('#str'+t).css('color','#cccccc');
    }
    $('#str'+rt).css('color','#f8b333');
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

  function _validateReviewFrm(){

    var comment=document.getElementById('comment').value;
    var author=document.getElementById('author').value;
    var email=document.getElementById('email').value;

    comment=comment.trim();
    author=author.trim();
    maill=email.trim();

    if(comment == "" || comment == null) {
      document.getElementById("comment").style.borderColor = "red";
      document.getElementById("commentError").innerHTML = "*Comment required.";
    }  else {
      document.getElementById("comment").style.borderColor = "green";
      document.getElementById("commentError").innerHTML = "";
    }

    if(author == "" || author == null) {
        document.getElementById("author").style.borderColor = "red";
        document.getElementById("authorError").innerHTML = "*Name required.";
    }  else {      
      document.getElementById("author").style.borderColor = "green";
      document.getElementById("authorError").innerHTML = "";
    }

    if(maill) {
      var ml=_mail_validate(maill);

      if(ml==2){
        document.getElementById("email").style.borderColor = "red";
        document.getElementById("emailError").innerHTML = "*Invalid E-mail address.";
      } else {
        document.getElementById("email").style.borderColor = "green";
        document.getElementById("email").placeholder = "";
        document.getElementById("emailError").innerHTML = "";
      }
    } else {
      document.getElementById("email").style.borderColor = "red";
      document.getElementById("emailError").innerHTML = "*E-mail is required.";
    }


    if(comment == "" || comment == null || author == "" || author == null  || maill == "" || maill == null || ml==2) {
          return false;
    }
    
  }
  /*validate edit contact info form, end here*/
</script>
</body>
</html>
