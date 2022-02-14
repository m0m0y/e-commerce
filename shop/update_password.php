<?php 
require "controller/header.controller.php";
require "assets/common/header.php";
if(isset($_SESSION["customer_id"])){
$customer_id = $_SESSION["customer_id"];
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
                        <li class="breadcrumb-item">Update Password</li>
                    </ol>
                </nav>
            </div>

            <div class="col-sm-12 col-md-8">
                <h3 class="mt-3">Change Password</h3>
                <h5>Your Password</h5>

                <hr></hr>

                <div id="alert" role="alert"></div>

                <input type="hidden" id="customer_id" class="form-control" value="<?= $customer_id ?>" readonly>

                <div class="row mb-4">
                    <label for="customer_password" class="col-sm-3 col-form-label text-right">* Password:</label>
                    <div class="col-sm-9">
                        <input type="password" id="customer_password" class="form-control" placeholder="Password">
                    </div>
                </div>

                <div class="row mb-4">
                    <label for="confirm_password" class="col-sm-3 col-form-label text-right">* Confirm Password:</label>
                    <div class="col-sm-9">
                        <input type="password" id="confirm_password" class="form-control" placeholder="Confirm Password">
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
                var password = $('#customer_password').val();
                var confirm_pass = $('#confirm_password').val();

                if (customer_id == "" || password == "" || confirm_pass == "") {
                    alert_message = "Please check the required fields!";
                    $('#alert').text(alert_message).addClass("alert alert-danger mb-3");
                } else if (password != confirm_pass) {
                    alert_message = "Your Password did not match!";
                    $('#alert').text(alert_message).addClass("alert alert-danger mb-3");
                } else {
                    $.ajax({
                        url: 'controller/update_account.controller.php?update_customer_password',
                        method: 'POST',
                        data: {
                            customer_id:customer_id,
                            password:password
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
<?php
} else { 
    // Redirect to login page if there's a no session
    echo '<script>window.location.replace("login");</script>';
} 
?>