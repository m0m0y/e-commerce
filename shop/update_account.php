<?php 
require "controller/header.controller.php";
require "assets/common/header.php";
if(isset($_SESSION["customer_id"])){
$customer_id = $_SESSION["customer_id"];
$firstname = $_SESSION["firstname"];
$lastname = $_SESSION["lastname"];
$email = $_SESSION["email"];
$telephone = $_SESSION["telephone"];
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
                        <li class="breadcrumb-item">Update Information</li>
                    </ol>
                </nav>
            </div>

            <div class="col-sm-12 col-md-8"> 
                <h3 class="mt-3">My Account Information</h3>
                <h5>Your Personal Details</h5>
                
                <hr></hr>
                
                <div id="alert" role="alert"></div>

                <input type="hidden" id="customer_id" class="form-control" value="<?= $customer_id ?>" readonly>

                <div class="row mb-4">
                    <label for="customer_firstname" class="col-sm-3 col-form-label text-right">* Firstname:</label>
                    <div class="col-sm-9">
                        <input type="text" id="customer_firstname" class="form-control" value="<?= $firstname ?>" placeholder="Firstname">
                    </div>
                </div>

                <div class="row mb-4">
                    <label for="customer_lastname" class="col-sm-3 col-form-label text-right">* Lastname:</label>
                    <div class="col-sm-9">
                        <input type="text" id="customer_lastname" class="form-control" value="<?= $lastname ?>" placeholder="Lastname">
                    </div>
                </div>

                <div class="row mb-4">
                    <label for="customer_email" class="col-sm-3 col-form-label text-right">* Email:</label>
                    <div class="col-sm-9">
                        <input type="email" id="customer_email" class="form-control" value="<?= $email ?>" placeholder="Email">
                    </div>
                </div>

                <div class="row mb-4">
                    <label for="customer_telephone" class="col-sm-3 col-form-label text-right">* Telephone:</label>
                    <div class="col-sm-9">
                        <input type="text" id="customer_telephone" class="form-control" value="<?= $telephone ?>" placeholder="Telephone">
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
                var firstname = $('#customer_firstname').val();
                var lastname = $('#customer_lastname').val();
                var email = $('#customer_email').val();
                var telephone = $('#customer_telephone').val();

                if (customer_id == "" || firstname == "" || lastname == "" || email == "" || telephone == "") {
                    alert_message = "Invalid data: Please check the required fields!";
                    $('#alert').text(alert_message).addClass("alert alert-danger mb-3");
                } else {
                    $.ajax({
                        url: 'controller/update_account.controller.php?update_customer',
                        method: 'POST',
                        data: {
                            customer_id:customer_id,
                            firstname:firstname,
                            lastname:lastname,
                            email:email,
                            telephone:telephone
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
    // Redirect to login page if there's a no session
    echo '<script>window.location.replace("login");</script>';
} 
?>