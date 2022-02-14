<?php 
require "controller/header.controller.php";
require "assets/common/header.php";
?>

<body>
    <!-- Navbar -->
    <?php require "assets/common/navbar.php"; ?>

    <!-- Slides -->
    <section class="mt-5 container">
        <div class="row">
            <div class="medium-12 columns">
            <div class="owl-carousel owl-theme">
                <div class="item">
                    <img src="assets/images/banners/banner-1.jpg" class="w-100" height="500">
                </div>

                <div class="item">
                    <img src="assets/images/banners/banner-2.jpg" class="w-100" height="500">
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Product Content  -->
    <section class="mt-5 container">
        <h4 class="mb-4">Featured Products</h4>
        <hr></hr> </br>
        <div class="row">
            <?php $class->get_featuredProducts(); ?>
        </div>
    </section>

    <!-- New Product Content  -->
    <section class="mt-5 container">
        <h4 class="mb-4">Newest Products</h4>
        <hr></hr> </br>
        <div class="row">
            <?php $class->get_newProducts(); ?>
        </div>

        <!-- Alert modal for wishlist -->
        <div class="modal fade modal-alert" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Alert message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="alert" role="alert"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require "assets/common/footer.php"; ?>

    <script src="script/home.js"></script>
    
</body>