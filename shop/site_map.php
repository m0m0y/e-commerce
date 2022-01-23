<?php 
require "controller/header.controller.php";
require "assets/common/header.php"; 
?>

<body> 
    <!-- Navbar -->
    <?php require "assets/common/navbar.php"; ?>

    <section class="mt-5 container"> 
        <div class="mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="margin: 0;">
                    <li class="breadcrumb-item active"><i class="fa fa-home" aria-hidden="true"></i></li>
                    <li class="breadcrumb-item">Site Map</li>
                </ol>
            </nav>
        </div>

        <h3>Site Map</h3>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <ul>
                    <li><a href="#" class="text-decoration-none">Categories</a></li>
                    <ul>
                        <?php $class->site_map_categories(); ?>
                    </ul>
                </ul>  
            </div>

            <div class="col-sm-12 col-md-6"> 
                <ul>
                    <li><a href="myaccount" class="text-decoration-none">My Account</a></li>
                    <ul>
                        <li><a href="myaccount" class="text-decoration-none">Account Information</a></li>
                        <li><a href="myaccount" class="text-decoration-none">Change Password</a></li>
                        <li><a href="myaccount" class="text-decoration-none">Modify Wishlist</a></li>
                        <li><a href="myaccount" class="text-decoration-none">Modify Wishlist</a></li>
                        <li><a href="myaccount" class="text-decoration-none">Order History</a></li>
                    </ul> 
                    <li><a href="cart" class="text-decoration-none">Shopping Cart</a></li>
                    <li><a href="checkout" class="text-decoration-none">Checkout</a></li> 
                    <li><a href="#" class="text-decoration-none">Information</a></li>
                    <ul>
                        <li><a href="about" class="text-decoration-none">About Us</a></li>
                        <li><a href="#" class="text-decoration-none">Privacy Policy</a></li>
                        <li><a href="#" class="text-decoration-none">Terms & Condition</a></li>
                    </ul> 
                    <li><a href="contact" class="text-decoration-none">Contac Us</a></li>
                </ul>  
            <div>
        </div>
    </section>

    <!-- Footer -->
    <?php require "assets/common/footer.php"; ?>
</body>