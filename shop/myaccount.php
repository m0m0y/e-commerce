<?php
require "controller/header.controller.php";
require "assets/common/header.php";
if(isset($_SESSION["customer_id"])){
?>

<!-- Content -->
<body>
    <!-- Navbar -->
    <?php require "assets/common/navbar.php"; ?>

    <section class="mt-5 container"> 
        <div class="row"> 
            <div class="col-sm-12 col-md-8"> 
                <h3 class="title mt-3">My Account</h3>
                <a href="#">Edit my account Information</a></br>
                <a href="#">Change your password</a></br>
                <a href="#">Modify your wish list</a></br>
                <h3 class="title mt-3">My Orders</h3>
                <a href="#">View your order history</a></br>
                <a href="#">Your Transaction</a></br>
            </div>

            <div class="col-sm-12 col-md-4 side-menu">
                <!-- Side Menu -->
                <?php require "assets/common/sidemenu.php"; ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require "assets/common/footer.php"; ?>
</body>
<!-- End -->

<?php
} else { 
?>
<!-- Redirect to login page if there's a no session -->
<script>window.location.replace("login");</script>
<?php 
} 
?>