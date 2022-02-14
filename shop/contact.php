<?php
require "controller/header.controller.php";
require "assets/common/header.php";

if(isset($_SESSION["customer_id"])){
    $firstname = $_SESSION["firstname"];
    $lastname = $_SESSION["lastname"];
    $full_name = $_SESSION["firstname"] ." ". $_SESSION["lastname"];
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
                        <input type="number" class="form-control" id="customer_number" value="<?= isset($_SESSION["telephone"]) ? $_SESSION["telephone"] : ""?>" placeholder="Contact number">
                    </div>

                    <div class="mb-3">
                        <label for="customer_email" class="form-label">Email address: *</label>
                        <input type="email" class="form-control" id="customer_email" value="<?= isset($_SESSION["email"]) ? $_SESSION["email"] : ""?>" placeholder="your@email.com">
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

    <script>
        $(document).ready(function(){
            $('#submit').on("click", function(){
                var customer_name = $('#customer_name').val();
                var customer_number = $('#customer_number').val();
                var customer_email = $('#customer_email').val();
                var confirm_email = $('#confirm_email').val();
                var customer_message = $('#customer_message').val();

                if (customer_email != confirm_email) {
                    alert_message = "Your email not match, please try again.";
                    $('#alert').text(alert_message).addClass("alert alert-danger mb-3");
                } else if (customer_name == "" || customer_number == "" || customer_email == "" || confirm_email == "" || customer_message =="") {
                    alert_message = "Please double check your input field";
                    $('#alert').text(alert_message).addClass("alert alert-danger mb-3");
                } else {
                    $.ajax({
                        url: 'controller/contact.controller.php',
                        method: 'POST',
                        data: {
                            customer_name:customer_name,
                            customer_number:customer_number,
                            customer_email:customer_email,
                            customer_message:customer_message
                        },
                        success: function() {
                            window.location.replace("thankyou");
                        }
                    });
                }
           });
        });
    </script>
</body>