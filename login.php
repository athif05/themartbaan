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
  <title><?php echo SITE_TITLE ?> || Login</title>
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
          <h2>Login Or Create An Account</h2>
        </div>
      </div>
      <!-- BEGIN Main Container -->  
      <div class="main-container col1-layout wow bounceInUp animated animated" style="visibility: visible;">     

       <div class="main">                     
        <div class="account-login container">
          <!--page-title-->

          <form action="login-form.php" method="post" id="login-form" onsubmit="return _validateLoginFrm()">
            <input type="hidden" name="chck" value="<?php if(isset($chck)){ echo $chck; }?>">
            <fieldset class="col2-set">
              <div class="col-1 new-users"> 
                <strong>New Customers</strong>    
                <div class="content">

                  <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                  <br>
                  <div class="buttons-set">
                    <button type="button" title="Create an Account" class="button create-account" onclick="location.href='register.php'"><span><span>Create an Account</span></span></button>
                  </div>
                </div>
              </div>
              <div class="col-2 registered-users">
               <strong>Registered Customers</strong>             
               <div class="content">

                <p>If you have an account with us, please log in.</p>

                <?php if(isset($_SESSION['sess_msg_err']) && $_SESSION['sess_msg_err']!=''){?>
                <div class="alert alert-danger text-center" role="alert">
                    <?php echo $_SESSION['sess_msg_err']; $_SESSION['sess_msg_err']='';?>
                </div>
                <?php } ?>

                <ul class="form-list">
                  <li>
                   <label for="email">Email Address<em class="required">*</em></label>
                   <div class="input-box">
                    <input type="text" name="email" value="" id="email" class="input-text required-entry validate-email" title="Email Address">
                    <span id="emailError" class="redClr"></span>
                  </div>
                </li>
                <li>
                  <label for="pass">Password<em class="required">*</em></label>
                  <div class="input-box">
                    <input type="password" name="password" class="input-text required-entry validate-password" id="password" title="Password">
                    <span id="passwordError" class="redClr"></span>
                  </div>
                </li>
              </ul>

              <p class="required">* Required Fields</p>

              <div class="buttons-set">

                <button type="submit" class="button login" title="Login" name="send" id="send2"><span>Login</span></button>

                <a href="forgotpassword.php" class="forgot-word">Forgot Your Password?</a>
              </div> <!--buttons-set-->
            </div> <!--content-->                               
          </div> <!--col-2 registered-users-->
        </fieldset> <!--col2-set-->
      </form>

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
    
    function _validateLoginFrm() {
      
      var maill=document.getElementById('email').value;
      var password=document.getElementById('password').value;
      
      maill=maill.trim();
      password=password.trim();
      
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

      if(password == "" || password == null) {
          document.getElementById("password").style.borderColor = "red";
          document.getElementById("passwordError").innerHTML = "*Password is required.";
      }  else {
        document.getElementById("password").style.borderColor = "green";
        document.getElementById("passwordError").innerHTML = "";
      }

      if(maill == "" || maill == null || ml==2 || password == "" || password == null) {
          return false;
      }
    }
  </script>

</body>
</html>
