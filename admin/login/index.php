<?php
session_start();
$_SESSION['sess_msg']="";
require_once '../core/core.php';
$check=1;

if(isset($_POST['but'])) {
  $uname	=	mysqli_real_escape_string($con,$_POST['username']);
  $password	= mysqli_real_escape_string($con,$_POST['password']);

  $sql="SELECT * FROM `login` where username='$uname' AND password='$password'";
  $qry=mysqli_query($con,$sql);
  $sess=mysqli_fetch_array($qry);

  $count=mysqli_num_rows($qry);
  if($count==0) {
    $_SESSION['sess_msg']="Wrong UserId/Password";
  } else {
    $_SESSION['login_id']= $sess['1'];
    header("location:../index.php");
  }
}
ob_flush(); 
?>

<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  html, body {
    height: 100%;
    background: url(im.jpg);
    font-family: cursive;
    color: white;
    background-repeat: no-repeat;
    background-size: 100% 700px;
  }
  .preload{
    position:relative;
  }

</style>

<html>
  <head>
    <title><?php echo ADMIN_TITLE ?> || Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="css/style.css" rel="stylesheet" type="text/css"> 
    <link href="font-awesome.min.css" rel="stylesheet" type="text/css"> 
    <link href="font-awesome.css" rel="stylesheet" type="text/css">     
    <link rel="stylesheet" href="flipclock.css">
    <!-- App Favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.png">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="flipclock.js"></script>
    <link href="assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" /><!-- Modernizr js -->
    <script src="assets/js/modernizr.min.js"></script> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  </head>
  <body>
    <div style="height:100px"></div>
    <div class='preload'>
      <div class="clock" style="position:absolute"></div>
      <div style="height:100px"></div>

      <div class="full" style="position:relative">
        <div class="full50" style="left:30%; position:absolute">
          <div class="full80 lgn_div">
            <div class="full txt_center black24 bdr_btm50">Login Details</div>
            <div class="mauto60">
            <div class="clearfix10"></div>

              <form class="form" method="POST">  

                <div class="full">
                <?php if($_SESSION['sess_msg']){?>
                  <div class="full txt_center red_war16" style="color:red">*<?php echo $_SESSION['sess_msg'];?>
                    <?php $_SESSION['sess_msg']='';?>
                  </div>
                  <div class="clearfix20"></div>
                <?php }?>

                  <div class="clearfix20"></div>

                  <div class="full">
                    <div class="full20 font_icon_blk"><i class="fa fa-user" aria-hidden="true"></i></div>
                    <div class="full80"><input autofocus type="text" name="username" value="" required placeholder="Username" class="txt_box"></div>
                  </div>
                  <div class="clearfix20"></div>
                  <div class="full">
                    <div class="full20 font_icon_blk"><i class="fa fa-unlock-alt" aria-hidden="true"></i></div>
                    <div class="full80"><input type="password" name="password" value="" required placeholder="Password" class="txt_box"></div>
                  </div>
                  <div class="clearfix20"></div>
                  <div class="full txt_center">
                    <input type="submit" name="but" value="Login" class="login_btn">
                  </div>
                  <div class="clearfix20"></div>
                </div>
              </form>
              <div class="clearfix30"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </body>
</html>
<script type="text/javascript">
var clock;

$(document).ready(function() {
clock = $('.clock').FlipClock({
clockFace: 'TwentyFourHourClock'
});
});
</script>
<script>
(function () {
$(function () {
$('.login--container').removeClass('preload');
this.timer = window.setTimeout(function (_this) {
return function () {
return $('.login--container').toggleClass('login--active');
};
}(this), 2000);
return $('.js-toggle-login').click(function (_this) {
return function () {
window.clearTimeout(_this.timer);
$('.login--container').toggleClass('login--active');
return $('.login--username-container input').focus();
};
}(this));
});
}.call(this));
</script>