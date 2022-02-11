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
                    <li class="breadcrumb-item">Manufacturer</li>
                </ol>
            </nav>
        </div>

        <h3>List of Manufacturer</h3>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <ol type="1">
                    <?php $class->manufacturer(); ?>
                </ol>  
            </div>

            <div class="col-sm-12 col-md-6">
                <!-- Side Menu -->
                <?php require "assets/common/sidemenu.php"; ?>
            <div>
        </div>
    </section>

    <!-- Footer -->
    <?php require "assets/common/footer.php"; ?>
</body>