<?php
session_start();
require_once 'admin/core/core.php';
require_once 'admin/core/other-script.php';
@extract($_REQUEST);

if(!isset($_SESSION['sess_clientId'])){
	$_SESSION['sess_clientId']='';
}

if(isset($_POST["delProd"])){ 
    $delProd = $_POST["delProd"];
}

mysqli_query($con, "DELETE from `tbl_temp` where id='$delProd'");
?>
<?php
$cartHeaderTempSql=mysqli_query($con, "SELECT * from `tbl_temp` where ((sessionID = '".session_id()."')||(clientID='".$_SESSION['sess_clientId']."'))");
$cartHeaderTempNum=mysqli_num_rows($cartHeaderTempSql);
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