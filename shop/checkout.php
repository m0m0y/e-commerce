<?php
require "controller/header.controller.php";
require "assets/common/header.php";
if(isset($_SESSION["customer_id"])){

$customer_id = $_SESSION["customer_id"];
$firstname = $_SESSION["firstname"];
$lastname = $_SESSION["lastname"];
$email = $_SESSION["email"];
$telephone = $_SESSION["telephone"];

$address_1 = $class->get_customer_address("address_1", $customer_id);
$address_2 = $class->get_customer_address("address_2", $customer_id);
$city = $class->get_customer_address("city", $customer_id);
$postcode = $class->get_customer_address("postcode", $customer_id);
$region = $class->get_customer_address("region", $customer_id);

$check_cart = $class->get_cart_rows($customer_id);

if ($check_cart == 0) {
?>
<!-- Redirect to shopping cart if the cart is empty -->
<script>window.location.replace("cart");</script>
<?php
}
?>

<body>
    <!-- Navbar -->
    <?php require "assets/common/navbar.php"; ?>

    <section class="mt-5 container"> 
        <div class="mb-4 container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="margin: 0;">
                    <li class="breadcrumb-item active"><i class="fa fa-home" aria-hidden="true"></i></li>
                    <li class="breadcrumb-item">Shopping Cart</li>
                    <li class="breadcrumb-item">Checkout</li>
                </ol>
            </nav>
        </div>

        <div class="mb-5 container"> 
            <h3>Checkout</h3>

            <div class="row mt-5">
                <div class="col-sm-12 col-md-12">

                    <div class="accordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                            <button class="accordion-button" type="button">
                                Step 2: Billing Details
                            </button>
                            </h2>

                            <div class="accordion-collapse collapse show">
                                <form method="post" action="confirm_order">
                                    <div class="accordion-body row">

                                        <div class="col-sm-12 col-md-6"> 
                                            <div class="form container"> 
                                                <h4 class="title">Your Personal Details</h4>
                                                <hr></hr>
                                                
                                                <input type="hidden" name="customer_id" class="form-control" value="<?= $customer_id ?>" readonly>

                                                <div class="row mb-4">
                                                    <label for="customer_firstname" class="col-sm-3 col-form-label text-right">* Firstname:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="customer_firstname" class="form-control" value="<?= $firstname ?>" placeholder="Firstname" required>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="customer_lastname" class="col-sm-3 col-form-label text-right">* Lastname:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="customer_lastname" class="form-control" value="<?= $lastname ?>" placeholder="Lastname" required>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="customer_email" class="col-sm-3 col-form-label text-right">* Email:</label>
                                                    <div class="col-sm-9">
                                                        <input type="email" name="customer_email" class="form-control" value="<?= $email ?>" placeholder="Email" required>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="customer_telephone" class="col-sm-3 col-form-label text-right">* Telephone:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="customer_telephone" class="form-control" value="<?= $telephone ?>" placeholder="Telephone" required>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6">
                                            <div class="form container">
                                                <h4 class="title">Your Address</h4>
                                                <hr></hr>

                                                <div class="row mb-4">
                                                    <label for="address_1" class="col-sm-3 col-form-label text-right">* Address 1:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="address_1" class="form-control" value="<?= $address_1 ?>" placeholder="Address 1" required>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="address_2" class="col-sm-3 col-form-label text-right"> Address 2:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="address_2" class="form-control" value="<?= $address_2 ?>" placeholder="Address 2" required>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="city" class="col-sm-3 col-form-label text-right">* City:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="city" class="form-control" value="<?= $city ?>" placeholder="City" required>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="postcode" class="col-sm-3 col-form-label text-right">* Postal Code:</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" name="postcode" class="form-control" value="<?= $postcode ?>" placeholder="Telephone" required>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="region" class="col-sm-3 col-form-label text-right">* Region:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="region" class="form-control" value="<?= $region ?>" placeholder="Region" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12">
                                            <div class="form container">
                                                <h4 class="title">Payment Details</h4>
                                                <hr></hr>

                                                <div class="row mb-4">
                                                    <div class="alert alert-warning" role="alert">
                                                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i> <span class="fw-bold">In store pick up only!</span>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="pick_up_date" class="col-sm-3 col-form-label text-right">* Pick up date:</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" name="pick_up_date" class="form-control" id="pickup_date" placeholder="Pick up date" required>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="payment_option" class="col-sm-3 col-form-label text-right">* Payment options:</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="payment_option" required>
                                                            <option value="" disabled selected>Choose Payment Method</option>
                                                            <option value="cash">Cash</option>
                                                            <option value="gcash">Gcash</option>
                                                            <option value="bank_transfer">Bank Transfer</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="comment" class="col-sm-3 col-form-label text-right">Comment:</label>
                                                    <div class="col-sm-9">
                                                        <textarea name="comment" rows="4" cols="50" class="form-control" placeholder="Comment"></textarea>
                                                    </div>
                                                </div>

                                                <div class="row mb-4 d-grid gap-3">
                                                    <div class="gcash box p-4 bg-light border" style="display: none;">
                                                        <h5>Gcash Details:</h5>
                                                        <p>Bank Name: <?= $class->get_banks("bank_name", "Gcash") ?></p>
                                                        <p>Account Name: <?= $class->get_banks("account_name", "Gcash") ?></p>
                                                        <p>Account Number: <?= $class->get_banks("account_number", "Gcash") ?></p>
                                                        <small>Please transfer the total amount to the following gcash account.</small>
                                                    </div>

                                                    <div class="bank_transfer box p-4 bg-light border" style="display: none;">
                                                        <h3>Bank Transfer Instructions:</h3>
                                                        <p><small>Please transfer the total amount to the following bank account.</small></p>
                                                        <h5 class="fw-normal">Bank Details:</h5>
                                                        <p>Bank Name: <?= $class->get_banks("bank_name", "BDO") ?></p>
                                                        <p>Account Name: <?= $class->get_banks("account_name", "BDO") ?></p>
                                                        <p>Account Number: <?= $class->get_banks("account_number", "BDO") ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <button type="submit" name="submit" class="btn btn-primary">Checkout</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require "assets/common/footer.php"; ?>

    <script>
        $(document).ready(function(){
            $("select").change(function(){
                $(this).find("option:selected").each(function(){
                    var optionValue = $(this).attr("value");
                    if(optionValue){
                        $(".box").not("." + optionValue).hide();
                        $("." + optionValue).show();
                    }
                });
            }).change();

            var dtToday = new Date();
            
            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if(month < 10)
                month = '0' + month.toString();
            if(day < 10)
                day = '0' + day.toString();
            
            var maxDate = year + '-' + month + '-' + day;

            $('#pickup_date').attr('min', maxDate);

        });
    </script>
</body>

<?php
} else { 
$customer_id = "";
$check_cart = $class->get_cart_rows($customer_id);
if ($check_cart == 0) {
?>
<!-- Redirect to shopping cart if the cart is empty -->
<script>window.location.replace("cart");</script>
<?php
}
?>

<body>
    <!-- Navbar -->
    <?php require "assets/common/navbar.php"; ?>

    <section class="mt-5 container"> 
        <div class="mb-4 container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="margin: 0;">
                    <li class="breadcrumb-item active"><i class="fa fa-home" aria-hidden="true"></i></li>
                    <li class="breadcrumb-item">Shopping Cart</li>
                    <li class="breadcrumb-item">Checkout</li>
                </ol>
            </nav>
        </div>

        <div class="mb-5 container"> 
            <h3>Checkout</h3>

            <div class="row mt-5">
                <div class="col-sm-12 col-md-12">
                    
                    <div class="accordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button">
                                    Step 1: Checkout Options
                                </button>
                            </h2>

                            <div class="accordion-collapse collapse show">
                                <div class="accordion-body row">
                                    <div class="col-sm-12 col-md-6"> 
                                        <div class="form container"> 
                                            <h4 class="title">New Customer</h4>

                                            </br>

                                            <a class="text-decoration-none" href="<?= $BASE_URL ?>register">Register Account</a>

                                            <p class="text-xl-start mt-3">By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6"> 
                                        <div class="form container"> 
                                            <h3 class="title">Login your account</h3>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                window.location.replace("checkout");
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


<?php 
} 
?>