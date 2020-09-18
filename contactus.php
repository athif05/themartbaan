<?php
session_start();
require_once 'admin/core/core.php';
require_once 'admin/core/other-script.php';

$mapSql=mysqli_query($con,"SELECT * FROM  map");
$mapLine=mysqli_fetch_array($mapSql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title><?php echo SITE_TITLE ?> || Contact Us</title>
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

    <div class="page-heading">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <div class="page-title">
              <h2>Contact Us</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="main-container col1-layout wow bounceInUp animated animated" style="visibility: visible;">     

     <div class="main container text-center mtrbl_45"> 
       <div class="row">                    
        <h1>Address</h1>
        <h4><i class="fa fa-map-marker"></i> <?php echo $contactLine['add1']; ?><?php echo $contactLine['add2']; ?><?php echo $contactLine['add3']; ?></h4>
        <h4><i class="fa fa-phone"></i><a href="tel:<?php echo str_replace('+91','',$contactLine['phone']); ?>"> <?php echo $contactLine['phone']; ?></a></h4>
        <h4><i class="fa fa-envelope"></i><a href="mailto:<?php echo $contactLine['email']; ?>"> <?php echo $contactLine['email']; ?></a></h4>
      </div>         
    </div><!--main-container-->

    <div class="clearfix"></div>

    <div class="container-fluid" style="padding: 0px;">
      <?php echo $mapLine['map'];?>
     <!--  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14287.10962612759!2d80.24005552283705!3d26.462903142677934!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399c37d8ab279323%3A0x3afe1900c2bfb5d3!2sB%20Block%2C%20Panki%2C%20Kanpur%2C%20Uttar%20Pradesh%20208020!5e0!3m2!1sen!2sin!4v1597488125091!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> -->
   </div>

 </div> <!--col1-layout-->

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
