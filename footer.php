<footer> 
  <!-- BEGIN INFORMATIVE FOOTER -->
  <div class="footer-inner">
    <div class="newsletter-row">
      <svg viewBox="0 0 70 8.75" preserveAspectRatio="xMinYMin meet"><g fill="#fafafa"><path d="M 0 0 L 70 0 L 54 3.00 C 45 4.70 34.6 6.00 35 5.64 C 35.17  8.75 0 0 0 Z"></path></g></svg>
      <div class="container">
        <div class="row"> 

          <!-- Footer Newsletter -->
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col1">
            <div class="newsletter-wrap">
              <h5>THE MARTBAAN</h5>
              <h4>DADI KA ACHAAR</h4>
              <p style="font-size: 34px;">"Purani yaad aur wahi lajawaab Swad"</p>
            </div>
            <!--newsletter-wrap--> 
          </div>
        </div>
      </div>
      <!--footer-column-last--> 
    </div>
    <div class="footer-middle">
      <div class="container">
        <div class="row">
          <div class="col-md-3 col-sm-6">
            <div class="footer-column">
              <h4>Quick Links</h4>
              <ul class="links">
                <li><a href="privacy_policy.php" title="Privacy Policy">Privacy Policy</a></li>
                <li><a href="#" title="Orders History">Orders History</a></li>
                <li><a href="#" title="Order Tracking">Order Tracking</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="footer-column">
              <h4>Information</h4>
              <ul class="links">
                <li><a href="aboutus.php" title="About Us">About Us</a></li>
                <li><a href="contactus.php" title="Contact Us">Contact Us</a></li>
                <li><a href="listing.php" title="Order Now">Order Now</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="footer-column">
              <h4>Social Media</h4>
              <div class="social">
                <p>You Can Connect with Us on <br /> 
                Social Media.</p>
                <?php
                $socialFBSql= mysqli_query($con,"SELECT * FROM `social_links` where status!=2 and cid=1");
                $socialFBLine= mysqli_fetch_array($socialFBSql);

                $socialWTSql= mysqli_query($con,"SELECT * FROM `social_links` where status!=2 and cid=6");
                $socialWTLine= mysqli_fetch_array($socialWTSql);

                $socialINSql= mysqli_query($con,"SELECT * FROM `social_links` where status!=2 and cid=7");
                $socialINLine= mysqli_fetch_array($socialINSql);
                ?>
                <ul>
                  <li class="fb"><a href="<?php echo $socialFBLine['address']; ?>" target="_blank"></a></li>
                  <li class="tw"><a href="<?php echo $socialWTLine['address']; ?>" target="_blank"></a></li>
                  <li class="youtube"><a href="<?php echo $socialINLine['address']; ?>" target="_blank"></a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="footer-column">
              <h4>Contact Us</h4>
              <div class="contacts-info">
                <address>
                  <i class="fa fa-map-marker"></i> The Martbaan Dadi ka Achaar<br>
                  <?php echo $contactLine['add2']; ?><?php echo $contactLine['add3']; ?><br>
                </address>
                <div class="phone-footer"><i class="fa fa-phone"></i> <?php echo $contactLine['phone']; ?> </div>
                <div class="email-footer"><i class="fa fa-envelope"></i><a href="mailto:<?php echo $contactLine['email']; ?>">  <?php echo $contactLine['email']; ?></a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--container--> 
  </div>
  <!--footer-inner--> 

  <!--footer-middle-->
  <div class="footer-top">
    <div class="container">
      <div class="row">
        <div class="col-sm-4 col-xs-12 coppyright"> © <?php echo $copy_right; ?> </div>
      </div>
    </div>
  </div>
  <!--footer-bottom--> 
  <!-- BEGIN SIMPLE FOOTER --> 
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>

<script type="text/javascript">

  /*add to header cart ajax, start here */
  function _add_to_cart(add_crt, qnt, attr){
  
      var pro_id=add_crt;

      $.ajax({

          method: 'POST',
          url: 'add-to-cart-ajax.php',
          data: 'pro_id='+pro_id+'&qnt='+qnt+'&attr='+attr,
          success : function(data) {

              $('#show_cart_in_header').html(data);
          }
      });
  }
  /*add to header cart ajax, end here */

  /*delete item from header cart ajax, start here */
  function _deleteFromCart(del_crt) {
      var del_crt=del_crt;

      $.ajax({
          method: 'POST',
          url: 'delete-from-cart-ajax.php',
          data: 'delProd='+del_crt,
          success : function(data_del) {
              alert('Deleted from cart');
              
              $('#show_cart_in_header').html(data_del);
          }
      });

  }
  /*delete item from header cart ajax, end here */

  /*delete item from header cart ajax, start here */
  function _deleteItemFromCartPage(del_crt_id) {
    var del_crt_id=del_crt_id;

    if(confirm('Are you sure to remove?')){
      $.ajax({
          method: 'POST',
          url: 'delete-from-cart-page-ajax.php',
          data: 'delProd_id='+del_crt_id,
          success : function(data_delete) {
              alert('Deleted from cart');
              
              $('#show_cart_in_page').html(data_delete);
          }
      });
    } 

  }
  /*delete item from header cart ajax, end here */

  /*delete item from header cart ajax, start here */
  function _deleteFromListingCart(del_lst_crt_id) {
    var del_lst_crt_id=del_lst_crt_id;

    if(confirm('Are you sure to remove?')){
      $.ajax({
          method: 'POST',
          url: 'delete-from-listing-page-ajax.php',
          data: 'del_lst_crt_id='+del_lst_crt_id,
          success : function(data_delete) {
              alert('Deleted from cart');
              
              var dt_del=data_delete.split('~');

              $('#listing_sidebar_cart').html(dt_del[0]);
              $('#show_cart_in_header').html(dt_del[1]);
          }
      });
    } 

  }
  /*delete item from header cart ajax, end here */
</script>