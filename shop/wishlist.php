<?php
require "controller/header.controller.php";
require "assets/common/header.php";
?>

<body>
    <!-- Navbar -->
    <?php require "assets/common/navbar.php"; ?>

    <section class="mt-5 container">
        <div class="mb-4 container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="margin: 0;">
                    <li class="breadcrumb-item active"><i class="fa fa-home" aria-hidden="true"></i></li>
                    <li class="breadcrumb-item">Account</li>
                    <li class="breadcrumb-item">My Wishlist</li>
                </ol>
            </nav>
        </div>
        
        <div class="mb-5"> 
            <div class="row">
                <div class="col-sm-12 col-md-8 wishlist">
                    <h4>My Wishlist</h4>
                    <div class="table-responsive">
                        <?php $class->get_customer_wishlist($customer_id); ?>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 side-menu">
                    <!-- Side Menu -->
                    <?php require "assets/common/sidemenu.php"; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require "assets/common/footer.php"; ?>
    
    <script src="script/wishlist.js"></script>
</body>