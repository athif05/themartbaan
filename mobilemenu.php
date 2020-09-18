<div id="mobile-menu">
  <ul>
    <li>
      <div>
        <a href="#">
          <img class="logo_img" src="admin/control/<?php echo $logoLine['image'];?>" />
        </a> 
      </div>
    </li>
    <li><div class="home"><a href="index.php">Home</a> </div></li>
    <li><a href="aboutus.php">About Us</a></li>
    <li><a href="listing.php">Flavours of Pickle</a></li>
    <li><a href="contactus.php">Contact Us</a></li>
  </ul>
  <div class="top-links">
    <ul class="links">
      
      <!-- <li class="last"><a title="Login" href="login.php">Login</a> </li> -->

      <?php if(isset($_SESSION['sess_clientId']) && ($_SESSION['sess_clientId']!='')){?>
        <li><a title="My Account" href="myaccount.php">My Account</a> </li>
        <li><a title="Checkout" href="checkout.php">Checkout</a> </li>
        <li class="last"><a href="logout.php" title="Logout"><span>Logout</span></a></li>
      <?php } else {?>
        <li><a title="Checkout" href="checkout.php">Checkout</a> </li>
        <li class="last"><a href="login.php" title="Login"><span>Login</span></a></li>
      <?php } ?>

    </ul>
  </div>
</div>