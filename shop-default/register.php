<?php 
require "assets/common/header.php";
?>

<body> 
    <!-- Navbar -->
    <?php require "assets/common/navbar.php"; ?>

    <section class="mt-5 container"> 
        <div class="row"> 
            <div class="col-sm-12 col-md-8 register-form"> 
                <div class="form container"> 
                    <h3 class="title mb-3">Register Account</h3>
                    <p>If you already have an account with us, please login at the login page.</p>

                    <div class="alert alert-danger mb-3" role="alert"></div>

                    <h5>Your Personal Details</h5>
                    <hr>
                    <div class="row mb-4">
                        <label for="customer_firstname" class="col-sm-3 col-form-label text-right">* Firstname:</label>
                        <div class="col-sm-9">
                            <input type="text" id="customer_firstname" class="form-control" placeholder="First Name">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="customer_lastname" class="col-sm-3 col-form-label text-right">* Lastname:</label>
                        <div class="col-sm-9">
                            <input type="text" id="customer_lastname" class="form-control" placeholder="Last Name">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="customer_email" class="col-sm-3 col-form-label text-right">* Email:</label>
                        <div class="col-sm-9">
                            <input type="email" id="customer_email" class="form-control" placeholder="Email">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="customer_telophone" class="col-sm-3 col-form-label text-right">* Telephone:</label>
                        <div class="col-sm-9">
                            <input type="number" id="customer_telophone" class="form-control" placeholder="Telephone">
                        </div>
                    </div>

                    <h5>Your Address</h5>
                    <hr>
                    <div class="row mb-4">
                        <label for="address_1" class="col-sm-3 col-form-label text-right">* Primary Address:</label>
                        <div class="col-sm-9">
                            <input type="text" id="address_1" class="form-control" placeholder="Primary Address">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="address_2" class="col-sm-3 col-form-label text-right">Secondary Address: <small>(Optional)</small></label>
                        <div class="col-sm-9">
                            <input type="text" id="address_2" class="form-control" placeholder="Secondary Address">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="city" class="col-sm-3 col-form-label text-right">* City:</label>
                        <div class="col-sm-9">
                            <input type="text" id="city" class="form-control" placeholder="City">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="postcode" class="col-sm-3 col-form-label text-right">* Postal Code:</label>
                        <div class="col-sm-9">
                            <input type="number" id="postcode" class="form-control" placeholder="Postal Code">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="region" class="col-sm-3 col-form-label text-right">* Region:</label>
                        <div class="col-sm-9">
                            <input type="text" id="region" class="form-control" placeholder="Region">
                        </div>
                    </div>

                    <h5>Your Password</h5>
                    <hr>
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
            $('.alert').hide();

            $('#submit').on("click", function(){
                var customer_firstname = $('#customer_firstname').val();
                var customer_lastname = $('#customer_lastname').val();
                var customer_email = $('#customer_email').val();
                var customer_telophone = $('#customer_telophone').val();
                var customer_password = $('#customer_password').val();
                var confirm_password = $('#confirm_password').val();

                var address_1 = $('#address_1').val();
                var address_2 = $('#address_2').val();
                var city = $('#city').val();
                var postcode = $('#postcode').val();
                var region = $('#region').val();

                if (customer_password != confirm_password){
                    $('.alert').show();
                    alert_message = "Your Password did not match!";
                    $('.alert').text(alert_message);
                } else if(customer_firstname == "" || customer_lastname == "" || customer_email == "" || customer_telophone == "" || customer_password == "" || confirm_password == "" || address_1 == "" || city == "" || postcode == "" || region == "") {
                    $('.alert').show();
                    alert_message = "Please double check the fields";
                    $('.alert').text(alert_message);
                } else {
                    $('.alert').hide();
                    $.ajax({
                        url: 'shop/controller/register.controller.php?registration',
                        method: 'POST',
                        data: {
                            customer_firstname:customer_firstname,
                            customer_lastname:customer_lastname,
                            customer_email:customer_email,
                            customer_telophone:customer_telophone,
                            customer_password:customer_password,
                            address_1:address_1,
                            address_2:address_2,
                            city:city,
                            postcode:postcode,
                            region:region
                        },
                        success: function() {
                            alert("You are now registered, you may login now!");
                            window.location.reload();
                        }
                    });
                }
            });
        });
    </script>
</body>