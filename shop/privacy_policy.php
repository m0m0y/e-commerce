<?php 
require "controller/header.controller.php";
require "assets/common/header.php";
$info_title = "Privacy Policy";
?>

<body> 
    <!-- Navbar -->
    <?php require "assets/common/navbar.php"; ?>

    <section class="mt-5 container"> 
        <div class="mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="margin: 0;">
                    <li class="breadcrumb-item active"><i class="fa fa-home" aria-hidden="true"></i></li>
                    <li class="breadcrumb-item">Privacy Policy</li>
                </ol>
            </nav>
        </div>

        <div class="mb-5">
            <h4><?= $class->get_info("info_title", "information_id='8' AND info_status='1'"); ?></h4>
            </br>
            <?= $class->get_info("info_description", "information_id='8' AND info_status='1'"); ?>
        </div>
        
    </section>

    <!-- Footer -->
    <?php require "assets/common/footer.php"; ?>
</body>