<?php
session_start();
require_once 'admin/core/core.php';
require_once 'admin/core/other-script.php';
@extract($_REQUEST);

if(!isset($_SESSION['sess_clientId'])){
	$_SESSION['sess_clientId']='';
}

if(isset($_POST["del_lst_crt_id"])){ 
    $del_lst_crt_id = $_POST["del_lst_crt_id"];
}

mysqli_query($con, "DELETE from `tbl_temp` where id='$del_lst_crt_id'");
?>
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
      <p class="subtotal"> <span class="label">Cart Subtotal:</span> <span class="price"><i class="fa fa-inr"></i><?php $total_cart_amount=_totalCartAmount();  echo number_format($total_cart_amount,2); ?></span> </p>
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
~
<?php
$cartHeaderTempSql9=mysqli_query($con, "SELECT * from `tbl_temp` where ((sessionID = '".session_id()."')||(clientID='".$_SESSION['sess_clientId']."'))");
$cartHeaderTempNum9=mysqli_num_rows($cartHeaderTempSql9);
?>
<div class="mini-cart">
  <div class="basket"> 
    <a href="<?php if($cartHeaderTempNum9>0){?>cart.php<?php } else {?>javascript:void(0)<?php } ?>"><span> <?php echo $cartHeaderTempNum9;?> </span></a> 
  </div>
  <div class="fl-mini-cart-content" style="display: none;">
    <div class="block-subtitle">
      
      <div class="top-subtotal">
        <?php echo $cartHeaderTempNum9;?> items, 
        <span class="price">
          <i class="fa fa-inr"></i>
          <?php 
          $total_cart_amount9=_totalCartAmount(); 
          echo number_format($total_cart_amount9,2);
          ?>
        </span> 
      </div>
      <!--top-subtotal--> 

      <!--pull-right--> 
    </div>
    <!--block-subtitle-->
    <ul class="mini-products-list" id="cart-sidebar" style="height: 300px; overflow-y:scroll;">
      
      <?php 
      if($cartHeaderTempNum9>0) {

          while($cartHeaderTempLine9=mysqli_fetch_array($cartHeaderTempSql9)) {

          $prodCartSql9=mysqli_query($con, "SELECT * from `tbl_product` where cid='".$cartHeaderTempLine9['productID']."'");
          $prodCartLine9=mysqli_fetch_array($prodCartSql9);
      ?>

      <li class="item">
        <div class="item-inner">
          <a class="product-image" title="<?php echo $prodCartLine9['title'];?>" href="product-detail.php?pro_id=<?php echo md5($prodCartLine9['cid']);?>">
            <?php
              if(!empty($prodCartLine9['primaryImage'])) {
            ?>
            <img alt="<?php echo $prodCartLine9['title'];?>" src="admin/control/images/<?php echo $prodCartLine9['primaryImage'];?>" style="max-height: 60px;">
            <?php } ?>
          </a>
          <div class="product-details">
            <div class="access">
              <a class="btn-remove1" title="Remove This Item" href="javascript:void(0)" onclick="_deleteFromCart(<?php echo $cartHeaderTempLine9['id'];?>)">
                Remove
              </a> 
            </div>
            <!--access--> 
            <strong><?php echo $cartHeaderTempLine9['qnt'];?></strong> 
            x
            <span class="price">
              <i class="fa fa-inr"></i><?php echo number_format($cartHeaderTempLine9['rate'],2);?>
            </span>
            <p class="product-name">
              <a href="product-detail.php?pro_id=<?php echo md5($prodCartLine9['cid']);?>">
                <?php echo ucwords($prodCartLine9['title']);?>
              </a>
            </p>
          </div>
        </div>
      </li>
      <?php } ?>

    </ul>
    <div class="actions">
      <button class="btn-checkout" title="Checkout" type="button" onClick="window.location=checkout.html"><span>Checkout</span></button>
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