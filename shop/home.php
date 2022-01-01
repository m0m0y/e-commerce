<?php 
require "assets/common/header.php"; 
if (isset($_SESSION["firstname"])) {
    $firstname = $_SESSION["firstname"];
}
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
                    <img src="http://localhost/test/shop/assets/images/banners/banner-1.jpg" class="w-100" height="500">
                </div>

                <div class="item">
                    <img src="http://localhost/test/shop/assets/images/banners/banner-2.jpg" class="w-100" height="500">
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Product Content  -->
    <section class="mt-5 container">
        <h4 class="mb-4">Featured Products</h4>
        <div class="row">
            <div class="col-sm-12 col-md-3">
                <div class="card">
                    <!-- <img src="..." class="card-img-top" alt="..."> -->
                    <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">View Product</a>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-12 col-md-3">
                <div class="card">
                    <!-- <img src="..." class="card-img-top" alt="..."> -->
                    <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">View Product</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-3">
                <div class="card">
                    <!-- <img src="..." class="card-img-top" alt="..."> -->
                    <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">View Product</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-3">
                <div class="card">
                    <!-- <img src="..." class="card-img-top" alt="..."> -->
                    <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">View Product</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require "assets/common/footer.php"; ?>

    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                items: 1,
                margin: 10,
                autoHeight: true,
                autoplay: true,
                loop: true
            });
        })
    </script>
    
</body>
</html>

