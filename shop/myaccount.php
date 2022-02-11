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
            <div class="mb-3 container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="margin: 0;">
                        <li class="breadcrumb-item active"><i class="fa fa-home" aria-hidden="true"></i></li>
                        <li class="breadcrumb-item">My Account</li>
                    </ol>
                </nav>
            </div>

            <div class="col-sm-12 col-md-8 my-account"> 
                <h3 class="title mt-3">My Account</h3>
                <a href="update_account" class="text-decoration-none">Edit my account Information</a></br>
                <a href="update_password" class="text-decoration-none">Change your password</a></br>
                <a href="wishlist" class="text-decoration-none">Modify your wish list</a></br>
                <h3 class="title mt-3">My Orders</h3>
                <a href="#" class="text-decoration-none">View your order history</a></br>
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