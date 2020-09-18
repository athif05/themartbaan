<?php
$offerSql=mysqli_query($con, "select * from home_offer");
$offerLine=mysqli_fetch_assoc($offerSql);

$logoSql=mysqli_query($con, "select * from logo");
$logoLine=mysqli_fetch_assoc($logoSql);

$contactSql=mysqli_query($con, "select * from contact");
$contactLine=mysqli_fetch_assoc($contactSql);
?>
<header>
  
      <div class="container-fluid">
        <div class="row">
          <div class="container-fluid">
            <div class="row">
              <div class="header-banner">
                <div class="assetBlock">
                  <div id="slideshow">
                    <p>Special Offers! - Get <span><?php echo $offerLine['offer'];?></span> <?php echo $offerLine['offer2'];?></p>
                    <p>Order Now <span>Order Now</span> Order Now</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="header">
        <div class="container">
          <div class="header-container row">
            <div class="logo"> <a href="index.php" title="index">
              <div><img class="logo_img" src="admin/control/<?php echo $logoLine['image'];?>" alt="logo"></div>
            </a> </div>
            <div class="fl-nav-menu">
              <nav>
                <div class="mm-toggle-wrap">
                  <div class="mm-toggle"><i class="icon-align-justify"></i><span class="mm-label">Menu</span> </div>
                </div>
                <div class="nav-inner"> 
                  <!-- BEGIN NAV -->
                  <ul id="nav" class="hidden-xs">

                    <li> <a class="level-top" href="index.php"><span>Home</span></a></li>
                    <li class="mega-menu"> <a class="level-top" href="aboutus.php"><span>About Us</span></a> </li>
                    <li class="mega-menu"> <a class="level-top" href="listing.php"><span>Flavours of Pickle</span></a> </li>

                    <li class="level1"><a href="contactus.php"><span>Contact us</span></a> </li>
                  </ul>
              <!--nav--> 
            </div>
          </nav>
        </div>

        <!--row-->

        <div class="fl-header-right">
          <div class="fl-links">
            <div class="no-js"> 
              <a title="Company" class="clicker" onclick="openNav()"></a>
            </div>
          </div>

          
          <div class="fl-cart-contain" id="show_cart_in_header">

            <?php
            if(!isset($_SESSION['sess_clientId'])){
              $_SESSION['sess_clientId']='';
            }

            $cartHeaderTempSql=mysqli_query($con, "SELECT * from `tbl_temp` where ((sessionID = '".session_id()."')||((clientID='".$_SESSION['sess_clientId']."') && (clientID!=0)))");
            $cartHeaderTempNum=mysqli_num_rows($cartHeaderTempSql);
            $_SESSION['sess_cartHeaderTempNum']=$cartHeaderTempNum;
            ?>

            <div class="mini-cart">
              <div class="basket"> 
                <a href="<?php if($cartHeaderTempNum>0){?>cart.php<?php } else {?>javascript:void(0)<?php } ?>"><span> <?php echo $cartHeaderTempNum;?> </span></a> 
              </div>
              <div class="fl-mini-cart-content" style="display: none;">
                <div class="block-subtitle">
                  
                  <div class="top-subtotal">
                    <?php echo $cartHeaderTempNum;?> items, 
                    <span class="price">
                      <i class="fa fa-inr"></i>
                      <?php 
                      $total_cart_amount=_totalCartAmount(); 
                      echo number_format($total_cart_amount,2);
                      ?>
                    </span> 
                  </div>
                  <!--top-subtotal--> 

                  <!--pull-right--> 
                </div>
                <!--block-subtitle-->
                <ul class="mini-products-list" id="cart-sidebar" style="height: 300px; overflow-y:scroll;">
                  
                  <?php 
                  if($cartHeaderTempNum>0) {

                      while($cartHeaderTempLine=mysqli_fetch_array($cartHeaderTempSql)) {

                      $prodCartSql=mysqli_query($con, "SELECT * from `tbl_product` where cid='".$cartHeaderTempLine['productID']."'");
                      $prodCartLine=mysqli_fetch_array($prodCartSql);
                  ?>

                  <li class="item">
                    <div class="item-inner">
                      <a class="product-image" title="<?php echo $prodCartLine['title'];?>" href="product-detail.php?pro_id=<?php echo md5($prodCartLine['cid']);?>">
                        <?php
                          if(!empty($prodCartLine['primaryImage'])) {
                        ?>
                        <img alt="<?php echo $prodCartLine['title'];?>" src="admin/control/images/<?php echo $prodCartLine['primaryImage'];?>" style="max-height: 60px;">
                        <?php } ?>
                      </a>
                      <div class="product-details">
                        <div class="access">
                          <a class="btn-remove1" title="Remove This Item" href="javascript:void(0)" onclick="_deleteFromCart(<?php echo $cartHeaderTempLine['id'];?>)">
                            Remove
                          </a> 
                        </div>
                        <!--access--> 
                        <strong><?php echo $cartHeaderTempLine['qnt'];?></strong> 
                        x
                        <span class="price">
                          <i class="fa fa-inr"></i><?php echo number_format($cartHeaderTempLine['rate'],2);?>
                        </span>
                        <p class="product-name">
                          <a href="product-detail.php?pro_id=<?php echo md5($prodCartLine['cid']);?>">
                            <?php echo ucwords($prodCartLine['title']);?>
                          </a>
                        </p>
                      </div>
                    </div>
                  </li>
                  <?php } ?>

                </ul>
                <div class="actions">
                  <button class="btn-checkout" title="Checkout" type="button" onclick="location.href='checkout.php'"><span>Checkout</span></button>
                </div>
                <!--actions--> 
                <?php } else {?>
                  <li class="item">
                    <div class="item-inner">
                      <div class="product-details">
                        <div class="access">
                          No item in cart....
                        </div>
                        <!--access--> 
                        
                      </div>
                    </div>
                  </li>
                <?php } ?>
              </div>
              <!--fl-mini-cart-content--> 
            </div>
          </div>
          <!--mini-cart-->

          </div>
        </div>
      </div>
    </div>
    
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&rarr;</a>

    <ul class="links">
      <?php if(isset($_SESSION['sess_clientId']) && ($_SESSION['sess_clientId']!='')){?>
        <li><a href="myaccount.php" title="My Account">My Account</a></li>
        <li><a href="checkout.php" title="Checkout">Checkout</a></li>
        <li class="last"><a href="logout.php" title="Logout"><span>Logout</span></a></li>
      <?php } else {?>
        <li><a href="checkout.php" title="Checkout">Checkout</a></li>
        <li class="last"><a href="login.php" title="Login"><span>Login</span></a></li>
      <?php } ?>
    </ul>
  </div>

</header>