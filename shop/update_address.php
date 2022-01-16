<?php 
require "controller/header.controller.php";
require "assets/common/header.php";
if(isset($_SESSION["customer_id"])){

$customer_id = $_SESSION["customer_id"];

$address_1 = $class->get_customer_address("address_1", $customer_id);
$address_2 = $class->get_customer_address("address_2", $customer_id);
$city = $class->get_customer_address("city", $customer_id);
$postcode = $class->get_customer_address("postcode", $customer_id);
$region = $class->get_customer_address("region", $customer_id);
?>


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
                        <li class="breadcrumb-item">Update Address</li>
                    </ol>
                </nav>
            </div>

            <div class="col-sm-12 col-md-8"> 
                <h3 class="mt-3">My Account Address</h3>
                <h5>Your existing address</h5>
                
                <hr></hr>
                
                <div id="alert" role="alert"></div>

                <input type="hidden" id="customer_id" class="form-control" value="<?= $customer_id ?>" readonly>

                <div class="row mb-4">
                    <label for="address_1" class="col-sm-3 col-form-label text-right">* Address 1:</label>
                    <div class="col-sm-9">
                        <input type="text" id="address_1" class="form-control" value="<?= $address_1 ?>" placeholder="Address 1">
                    </div>
                </div>

                <div class="row mb-4">
                    <label for="address_2" class="col-sm-3 col-form-label text-right"> Address 2:</label>
                    <div class="col-sm-9">
                        <input type="text" id="address_2" class="form-control" value="<?= $address_2 ?>" placeholder="Address 2">
                    </div>
                </div>

                <div class="row mb-4">
                    <label for="city" class="col-sm-3 col-form-label text-right">* City:</label>
                    <div class="col-sm-9">
                        <input type="text" id="city" class="form-control" value="<?= $city ?>" placeholder="City">
                    </div>
                </div>

                <div class="row mb-4">
                    <label for="postcode" class="col-sm-3 col-form-label text-right">* Postal Code:</label>
                    <div class="col-sm-9">
                        <input type="number" id="postcode" class="form-control" value="<?= $postcode ?>" placeholder="Telephone">
                    </div>
                </div>

                <div class="row mb-4">
                    <label for="region" class="col-sm-3 col-form-label text-right">* Region:</label>
                    <div class="col-sm-9">
                        <input type="text" id="region" class="form-control" value="<?= $region ?>" placeholder="Telephone">
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-md btn-secondary" id="back">Back</button>
                    <button type="submit" class="btn btn-md btn-primary" id="submit">Submit</button>
                </div>
            </div>

            <div class="col-sm-12 col-md-4 side-menu">
                <!-- Side Menu -->
                <?php require "assets/common/sidemenu.php"; ?>
            </div>

        </div>
    </section>

    <!-- Footer -->
    <?php require "assets/common/footer.php"; ?>
    <script>
        $(document).ready(function(){
            $('#back').on('click', function(){
                window.location.href="myaccount";
            });

            $('#submit').on('click', function(){
                var alert_message = $('#alert').val();
                var customer_id = $('#customer_id').val();
                var address_1 = $('#address_1').val();
                var address_2 = $('#address_2').val();
                var city = $('#city').val();
                var postcode = $('#postcode').val();
                var region = $('#region').val();
                
                if (address_1 == "" || city == "" || postcode == "" || region == "") {
                    alert_message = "Invalid data: Please check the required fields!";
                    $('#alert').text(alert_message).addClass("alert alert-danger mb-3");
                } else {
                    $.ajax({
                        url: 'controller/update_account.controller.php?update_customer_address',
                        method: 'POST',
                        data: {
                            customer_id:customer_id,
                            address_1:address_1,
                            address_2:address_2,
                            city:city,
                            postcode:postcode,
                            region:region
                        },
                        success:function(){
                            window.location.reload();
                        }
                    });
                }
            });
        });
    </script>
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