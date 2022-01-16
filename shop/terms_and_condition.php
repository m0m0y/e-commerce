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
                    <li class="breadcrumb-item">Terms & Condition</li>
                </ol>
            </nav>
        </div>

        <?php $class->get_terms_and_condition() ?>
        
    </section>

    <!-- Footer -->
    <?php require "assets/common/footer.php"; ?>
</body>