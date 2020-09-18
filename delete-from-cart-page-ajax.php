<?php
session_start();
require_once 'admin/core/core.php';
require_once 'admin/core/other-script.php';
@extract($_REQUEST);

if(!isset($_SESSION['sess_clientId'])){
	$_SESSION['sess_clientId']='';
}

if(isset($_POST["delProd_id"])){ 
    $delProd_id = $_POST["delProd_id"];
}

mysqli_query($con, "DELETE from `tbl_temp` where id='$delProd_id'");
?>

<div class="cart wow bounceInUp animated">

          <div class="table-responsive shopping-cart-tbl  container">
            <form action="cart.php" method="post">
              <input name="form_key" type="hidden" value="EPYwQxF6xoWcjLUr">
              <fieldset>
                <table id="shopping-cart-table" class="data-table cart-table table-striped">
                  <colgroup><col width="1">
                    <col>
                    <col width="1">
                    <col width="1">
                    <col width="1">
                    <col width="1">
                    <col width="1">

                  </colgroup><thead>
                    <tr class="first last">
                      <th rowspan="1">#</th>
                      <th rowspan="1">Image</th>
                      <th rowspan="1"><span class="nobr">Product Name</span></th>
                      <th class="a-center" colspan="1"><span class="nobr">Unit Price</span></th>
                      <th rowspan="1" class="a-center">Qty</th>
                      <th class="a-center" colspan="1">Subtotal</th>
                      <th rowspan="1" class="a-center">Delete</th>
                    </tr>
                  </thead>
                  <?php
                  $n=0;
                    $cartHeaderSubtotal=0;
                    if(!isset($_SESSION['sess_clientId'])){
                      $_SESSION['sess_clientId']='';
                    }

                    $cartHeaderTempSql=mysqli_query($con, "SELECT * from `tbl_temp` where ((sessionID = '".session_id()."')||((clientID='".$_SESSION['sess_clientId']."') && (clientID!=0)))");
                    $cartHeaderTempNum=mysqli_num_rows($cartHeaderTempSql);
                  ?>
                  <tfoot>
                    <tr class="first last">
                      <td colspan="50" class="a-right last">

                        <button type="button" title="Continue Shopping" class="button btn-continue" onclick="location.href='listing.php'">
                          <span><span>Continue Shopping</span></span>
                        </button>
                        
                        <?php if($cartHeaderTempNum>0){?>
                          <button type="submit" name="update_cart_action" value="update_qty" title="Update Cart" class="button btn-update">
                            <span><span>Update Cart</span></span>
                          </button>

                          <button type="submit" name="clear_cart_action" value="empty_cart" title="Clear Cart" class="button btn-empty" id="empty_cart_button">
                            <span><span>Clear Cart</span></span>
                          </button>
                        <?php } ?>
                      </td>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                    if($cartHeaderTempNum>0) {
                      while($cartHeaderTempLine=mysqli_fetch_array($cartHeaderTempSql)) {

                      $prodCartSql=mysqli_query($con, "SELECT * from `tbl_product` where cid='".$cartHeaderTempLine['productID']."'");
                      $prodCartLine=mysqli_fetch_array($prodCartSql);

                      $cartHeaderSubtotal=$cartHeaderSubtotal+$cartHeaderTempLine['amount'];

                    ?>
                    <tr class="first last odd">
                      
                      <td class="image hidden-table">
                        <?php $n++; echo $n;?>.
                        <input type="hidden" name="id_del[]" value="<?php echo $cartHeaderTempLine['id'];?>">
                      </td>

                      <td class="image hidden-table">
                        <a href="product-detail.php?pro_id=<?php echo md5($prodCartLine['cid']);?>" title="<?php echo $prodCartLine['title'];?>" class="product-image">
                          <img src="admin/control/images/<?php echo $prodCartLine['primaryImage'];?>" width="75" alt="<?php echo $prodCartLine['title'];?>" style="max-height: 70px; max-width: 50px;">
                        </a>
                      </td>

                      <td>
                        <h2 class="product-name">
                          <input type="hidden" name="product_id[]" value="<?php echo $prodCartLine['cid'];?>">
                          <a href="product-detail.php?pro_id=<?php echo md5($prodCartLine['cid']);?>">
                            <?php echo ucwords($prodCartLine['title']);?>
                          </a>
                        </h2>
                      </td>
                    
                      <td class="a-center hidden-table">
                        <span class="cart-price">
                          <span class="price">
                            <input type="hidden" name="rate[]" value="<?php echo $cartHeaderTempLine['rate'];?>">
                            <i class="fa fa-inr"></i>
                            <?php echo number_format($cartHeaderTempLine['rate'],2);?>
                          </span>                
                        </span>
                      </td>

                      <td class="a-center movewishlist">
                        <input type="text" name="qnt[]" value="<?php echo $cartHeaderTempLine['qnt'];?>" size="4" title="Qty" class="input-text qty" maxlength="3">
                      </td>

                      <td class="a-center movewishlist">
                        <span class="cart-price">
                          <span class="price">
                            <i class="fa fa-inr"></i>
                            <?php echo number_format($cartHeaderTempLine['amount'],2);?>
                          </span>                            
                        </span>
                      </td>

                      <td class="a-center last">
                       <a href="javascript:void(0)" onclick="_deleteItemFromCartPage(<?php echo $cartHeaderTempLine['id'];?>)" title="Remove item" class="button remove-item">
                        <span><span>Remove item</span></span>
                       </a>
                     </td>

                     </tr> 
                    <?php } } else {?>
                      <tr class="first last odd">
                      
                        <td class="image hidden-table">
                          No item in cart...
                        </td>

                       </tr>
                    <?php } ?>
                      </tbody>
                   </table>

                 </fieldset>
               </form>
             </div>

             <!-- BEGIN CART COLLATERALS -->


             <div class="cart-collaterals container"> 
              <!-- BEGIN COL2 SEL COL 1 -->
              <div class="row">

                <!-- BEGIN TOTALS COL 2 -->
                  <div class="col-sm-4">    

                    <div class="discount">
                      <h3>Discount Codes</h3>
                      <form id="discount-coupon-form" action="#" method="post">                       
                        <label for="coupon_code">Enter your coupon code if you have one.</label>
                        <input type="hidden" name="remove" id="remove-coupone" value="0">                          
                        <input class="input-text fullwidth" type="text" id="coupon_code" name="coupon_code" value="">                                                      
                        <button type="button" title="Apply Coupon" class="button coupon " onClick="discountForm.submit(false)" value="Apply Coupon"><span>Apply Coupon</span></button>                

                      </form>

                    </div> <!--discount--> 
                  </div> <!--col-sm-4-->

                  <div class="col-sm-4">&nbsp;</div>

                  <div class="col-sm-4">
                   <div class="totals">
                    <h3>Shopping Cart Total</h3>
                    <div class="inner">

                      <table id="shopping-cart-totals-table" class="table shopping-cart-table-total">
                        <colgroup><col>
                          <col width="1">
                        </colgroup><tfoot>
                          <tr>
                            <td style="" class="a-left" colspan="1">
                              <strong>Grand Total</strong>
                            </td>
                            <td style="" class="a-right">
                              <strong>
                                <span class="price">
                                  <input type="hidden" name="grandTotalAmount" id="grandTotalAmount" value="<?php echo $cartHeaderSubtotal;?>">
                                  <i class="fa fa-inr"></i>
                                  <?php echo number_format($cartHeaderSubtotal,2);?>
                                </span>
                              </strong>
                            </td>
                          </tr>
                        </tfoot>
                        <tbody>
                          <tr>
                            <td style="" class="a-left" colspan="1">
                            Subtotal    </td>
                            <td style="" class="a-right">
                              <span class="price">
                                <input type="hidden" name="subTotalAmount" id="subTotalAmount" value="<?php echo $cartHeaderSubtotal;?>">
                                <i class="fa fa-inr"></i>
                                <?php echo number_format($cartHeaderSubtotal,2);?>
                              </span>    
                            </td>
                            </tr>
                          </tbody>
                        </table>

                        <ul class="checkout">           
                          <li>
                            <button type="button" title="Proceed to Checkout" class="button btn-proceed-checkout" onClick=""><span>Proceed to Checkout</span></button>
                          </li><br>
                        </ul>                
                      </div><!--inner-->
                    </div><!--totals-->
                  </div> <!--col-sm-4-->


                </div> <!--cart-collaterals-->


              </div>
            </div>