<?php
require "controller/header.controller.php";
require "assets/common/header.php";
?>

<body>
    <!-- Navbar -->
    <?php require "assets/common/navbar.php"; ?>

    <section class="mt-5 container"> 
        <div class="row"> 
            <div class="col-sm-12 col-md-8 login-form"> 
                <div class="form container"> 
                    <h3 class="title mb-3">Login Form</h3>

                    <div id="alert" role="alert"></div>

                    <div class="mb-3">
                        <label for="customer_email" class="form-label">E-mail Address: *</label>
                        <input type="text" class="form-control" id="customer_email" placeholder="E-mail Address">
                    </div>

                    <div class="mb-3">
                        <label for="customer_password" class="form-label">Password: *</label>
                        <input type="password" class="form-control" id="customer_password" placeholder="Password">
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
        $('#submit').on("click", function(){
            var customer_email = $('#customer_email').val();
            var customer_password = $('#customer_password').val();

            if(customer_email == "" || customer_password == "") {
                alert_message = "No match for Email Address and Password";
                $('#alert').text(alert_message).addClass("alert alert-danger mb-3");
            } else {
                $.ajax({
                    url: 'controller/login.controller.php?get_customer',
                    method: 'POST',
                    data: {
                        customer_email:customer_email,
                        customer_password:customer_password
                    },
                    success: function(response) {
                        if (response == "success") {
                            window.location.replace("myaccount");
                        } else if (response == "invalid") {
                            alert_message = "No match for Email Address and Password";
                            $('#alert').text(alert_message).addClass("alert alert-danger mb-3");
                        } else {
                            alert_message = "No match for Email Address and Password";
                            $('.alert').text(alert_message);
                        }
                    }
                });
            }
        });
    });
    </script>
</body>