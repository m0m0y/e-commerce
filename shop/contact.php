<?php
require "controller/header.controller.php";
require "assets/common/header.php";

if(isset($_SESSION["customer_id"])){
    $full_name = $_SESSION["customer_firstname"] ." ". $_SESSION["customer_lastname"];
}
?>
<body>

    <!-- Navbar -->
    <?php require "assets/common/navbar.php"; ?>
  
    <section class="mt-5 container">
        <div class="mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="margin: 0;">
                    <li class="breadcrumb-item active"><i class="fa fa-home" aria-hidden="true"></i></li>
                    <li class="breadcrumb-item">Contact Us</li>
                </ol>
            </nav>
        </div>
        
        <h1 class="title">Contact Us</h1>
        <div class="row mt-5"> 
            <div class="col-sm-12 col-md-4 location-info">
                <div class="info container"> 
                    <h4 class="title mb-5">Our Location</h4>

                    <div class="address">
                        <h5><?= $class->get_info("info_title", "information_id='10' AND info_status='1'"); ?></h5>
                        <?= $class->get_info("info_description", "information_id='10' AND info_status='1'"); ?>
                    </div>

                    <div class="email">
                        <h5><?= $class->get_info("info_title", "information_id='11' AND info_status='1'"); ?></h5>
                        <?= $class->get_info("info_description", "information_id='11' AND info_status='1'"); ?>
                    </div>

                    <div class="telephone">
                        <h5><?= $class->get_info("info_title", "information_id='12' AND info_status='1'"); ?></h5>
                        <?= $class->get_info("info_description", "information_id='12' AND info_status='1'"); ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-8" style="padding: 1%;">
                <div class="form container"> 
                    <h4 class="title">Contact Form</h4>

                    <div id="alert" role="alert"></div>

                    <div class="mb-3">
                        <label for="customer_name" class="form-label">Full Name: *</label>
                        <input type="text" class="form-control" id="customer_name" value="<?= isset($full_name) ? $full_name : ""?>" placeholder="Please type your full name">
                    </div>

                    <div class="mb-3">
                        <label for="customer_number" class="form-label">Contact Number: *</label>
                        <input type="number" class="form-control" id="customer_number" value="<?= isset($_SESSION["customer_telephone"]) ? $_SESSION["customer_telephone"] : ""?>" placeholder="Contact number">
                    </div>

                    <div class="mb-3">
                        <label for="customer_email" class="form-label">Email address: *</label>
                        <input type="email" class="form-control" id="customer_email" value="<?= isset($_SESSION["customer_email"]) ? $_SESSION["customer_email"] : ""?>" placeholder="your@email.com">
                    </div>

                    <div class="mb-3">
                        <label for="confirm_email" class="form-label">Confirm Email address: *</label>
                        <input type="email" class="form-control" id="confirm_email" placeholder="your@email.com">
                    </div>

                    <div class="mb-3">
                        <label for="customer_message" class="form-label">Message: *</label>
                        <textarea class="form-control" id="customer_message" rows="3" placeholder="Type Here..."></textarea>
                        <div class="form-text">Input your Inqury here.</div>
                    </div>
                
                    <button type="submit" class="btn btn-md btn-primary" id="submit">Submit</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require "assets/common/footer.php"; ?>

    <script src="script/contact.js"></script>
</body>