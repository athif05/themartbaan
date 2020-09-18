<?php
$base_pageName=basename($_SERVER['PHP_SELF']); //page name
?>
<div class="left side-menu">
    <div class="sidebar-inner" style="overflow-y: scroll;height:600px">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul>
                <!--<li class="text-muted menu-title">
                    <img src="images/logo.png" style="height:60px;width:auto">
                </li>-->
                <li class="text-muted menu-title">
                    <p></p>
                </li>

                <li class="has_sub" style="margin-top: 12px;">
                    <a href="index.php" class="waves-effect <?php if($base_pageName=='index.php'){?>active<?php } ?>"> 
                        <i class="zmdi zmdi-view-dashboard"></i><span> Dashboard </span> 
                    </a>
                </li>

                <li class="has_sub">
                    <a href="orders.php" class="waves-effect <?php if($base_pageName=='orders.php'){?>active<?php } ?>"> 
                        <i class="zmdi zmdi-shopping-cart"></i>
                        <span> Orders </span> 
                    </a>
                </li>

                <li class="has_sub">
                    <a href="payment.php" class="waves-effect <?php if($base_pageName=='payment.php'){?>active<?php } ?>"> 
                        <i class="zmdi zmdi-money"></i>
                        <span> Payments </span> 
                    </a>
                </li>

                <li class="has_sub">
                    <a href="clients.php" class="waves-effect <?php if($base_pageName=='clients.php'){?>active<?php } ?>"> 
                        <i class="zmdi zmdi-account"></i>
                        <span> Clients </span> 
                    </a>
                </li>
 
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect <?php if(($base_pageName=='product-list.php')||($base_pageName=='product.php')||($base_pageName=='category.php')||($base_pageName=='attribute.php')||($base_pageName=='listing-slider.php')||($base_pageName=='listing-sidebar-slider.php')||($base_pageName=='product-policy.php')){?>active<?php } ?>">
                        <i class="zmdi zmdi-chart"></i> 
                        <span> Manage Product</span> 
                        <span class="menu-arrow"></span>
                    </a>

                    <ul class="list-unstyled">
                        <li>
                            <a href="product-list.php">
                                <i class="zmdi zmdi-grid"></i>Add Product
                            </a>
                        </li>
                        <li>
                            <a href="product-policy.php">
                                <i class="zmdi zmdi-grid"></i>Product Policy
                            </a>
                        </li>
                        <li>
                            <a href="listing-slider.php">
                                <i class="zmdi zmdi-image-alt"></i>Listing Slider
                            </a>
                        </li>
                        <li>
                            <a href="listing-sidebar-slider.php">
                                <i class="zmdi zmdi-image-alt"></i>Listing Sidebar Slider
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect <?php if(($base_pageName=='stock-report.php')||($base_pageName=='order-report.php')||($base_pageName=='payment-report.php')||($base_pageName=='clients-report.php')){?>active<?php } ?>">
                        <i class="zmdi zmdi-chart"></i> 
                        <span> Manage Reports</span> 
                        <span class="menu-arrow"></span>
                    </a>

                    <ul class="list-unstyled">
                        <li>
                            <a href="stock-report.php">
                                <i class="fa fa-bar-chart"></i>Stock Report
                            </a>
                        </li>
                        <li>
                            <a href="order-report.php">
                                <i class="fa fa-bar-chart"></i>Order Report
                            </a>
                        </li>
                        <li>
                            <a href="payment-report.php">
                                <i class="fa fa-bar-chart"></i>Payment Report
                            </a>
                        </li>
                        <li>
                            <a href="clients-report.php">
                                <i class="fa fa-bar-chart"></i>Clients Report
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect <?php if(($base_pageName=='home_offer.php')||($base_pageName=='home_logo.php')||($base_pageName=='home_slider.php')||($base_pageName=='about.php')||($base_pageName=='banner.php')||($base_pageName=='menu-categories.php')||($base_pageName=='home_about.php')||($base_pageName=='term-condition.php')||($base_pageName=='privacy-policy.php')||($base_pageName=='home_testimonial.php')||($base_pageName=='socialmedia.php')){?>active<?php } ?>">
                        <i class="zmdi zmdi-globe"></i> <span> Website Setting</span> 
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled">
                        <li>
                            <a href="home_offer.php">
                                <i class="ion-earth"></i>Add Home Offer
                            </a>
                        </li>
                        <li>
                            <a href="home_logo.php">
                                <i class="zmdi zmdi-image-o"></i>Add-Logo
                            </a>
                        </li>
                        <li>
                            <a href="home_slider.php">
                                <i class="zmdi zmdi-image-alt"></i>Add-Slider
                            </a>
                        </li>
                        <li>
                            <a href="about.php">
                                <i class="ion-earth"></i>About us
                            </a>
                        </li>
                        <li>
                            <a href="banner.php">
                                <i class="zmdi zmdi-image-alt"></i>Add-Banner
                            </a>
                        </li>
                        
                        <li>
                            <a href="privacy_policy.php">
                                <i class="zmdi zmdi-mood"></i>Privacy & Policy
                            </a>
                        </li>
                        <li>
                            <a href="home_testimonial.php">
                                <i class="zmdi zmdi-mood"></i>Testimonial
                            </a>
                        </li> 
                        <li>
                            <a href="socialmedia.php">
                                <i class="zmdi zmdi-caret-right-circle"></i>Social Media
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect <?php if(($base_pageName=='contact.php')||($base_pageName=='map.php')||($base_pageName=='contactbanner.php')||($base_pageName=='resetpassword.php')){?>active<?php } ?>">
                        <i class="zmdi zmdi-settings"></i> 
                        <span> Other Setting</span> 
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled">
                        <li>
                            <a href="contact.php">
                                <i class="zmdi zmdi-caret-right-circle">
                                </i>Add-Contact
                            </a>
                        </li>
                        <li>
                            <a href="map.php">
                                <i class="zmdi zmdi-caret-right-circle"></i>Add-Map
                            </a>
                        </li>
                        <li>
                            <a href="resetpassword.php">
                                <i class="zmdi zmdi-caret-right-circle"></i>Reset Password
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="logout.php" class="waves-effect">
                        <i class="fa fa-power-off"></i> <span>LOGOUT</span>
                    </a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>
    </div>
</div>