<?php
session_start();
require_once 'admin/core/core.php';
require_once 'admin/core/other-script.php';

if(isset($clnt_id)) {
    $clnt_id=base64_decode($clnt_id);
    mysqli_query($con,"UPDATE `clients` set status=1 where cid='$clnt_id'");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title><?php echo SITE_TITLE ?> || Verify Account</title>
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
          <h2>Verify Account</h2>
        </div>
      </div>
      <!-- BEGIN Main Container -->  
      <div class="main-container col1-layout wow bounceInUp animated animated" style="visibility: visible;">     

       <div class="main">                     
        <div class="account-login container">
          <!--page-title-->
            <fieldset class="col2-set text-center" style="border: 1px solid #ccc; border-radius: 10px; padding: 10px;">
              <div class="col-12 new-users"> 
                <strong>New Customers</strong>    
                <div class="content">

                  <div class="col-sm-12">
                      <p><img src="images/right_tick.png" style="width: 80px;"></p>
                      <h2>Congratulations</h2>    
                      <p>
                          <h3>You have successfully verified your account.</h3>
                      </p>
                      <p>
                        <h4><a href="login.php" style="color: blue;">Click here</a> for login</h4>
                      </p>
                  </div> 

                </div>
              </div>
              
        </fieldset> <!--col2-set-->
   
        <div style="clear: both; height: 50px;"></div> 

    </div> <!--account-login-->

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

</body>
</html>
