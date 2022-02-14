<?php 
require "controller/header.controller.php";
require "assets/common/header.php";
if (isset($_SESSION["customer_id"])) {
    $customer_id = $_SESSION["customer_id"];
} else {
    $customer_id = "";
}

$customer_firstname = $_POST["customer_firstname"];
$customer_lastname = $_POST["customer_lastname"];
$customer_email = $_POST["customer_email"];
$customer_telephone = $_POST["customer_telephone"];
$address_1 = $_POST["address_1"];
$address_2 = $_POST["address_2"];
$city = $_POST["city"];
$postcode = $_POST["postcode"];
$region = $_POST["region"];
$pick_up_date = $_POST["pick_up_date"];
$payment_option = $_POST["payment_option"];
$comment = $_POST["comment"];
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
                    <li class="breadcrumb-item">Confirm Order</li>
                </ol>
            </nav>
        </div>

        <div class="mb-5 container"> 
            <h3>Confirm Order</h3>
            <input type="hidden" id="customer_id" class="form-control" value="<?= $customer_id ?>" readonly>
            <input type="hidden" id="customer_firstname" class="form-control" value="<?= $customer_firstname ?>" readonly>
            <input type="hidden" id="customer_lastname" class="form-control" value="<?= $customer_lastname ?>" readonly>
            <input type="hidden" id="customer_email" class="form-control" value="<?= $customer_email ?>" readonly>
            <input type="hidden" id="customer_telephone" class="form-control" value="<?= $customer_telephone ?>" readonly>

            <input type="hidden" id="address_1" class="form-control" value="<?= $address_1 ?>" readonly>
            <input type="hidden" id="address_2" class="form-control" value="<?= $address_2 ?>" readonly>
            <input type="hidden" id="city" class="form-control" value="<?= $city ?>" readonly>
            <input type="hidden" id="postcode" class="form-control" value="<?= $postcode ?>" readonly>
            <input type="hidden" id="region" class="form-control" value="<?= $region ?>" readonly>

            <input type="hidden" id="pick_up_date" class="form-control" value="<?= $pick_up_date ?>" readonly>
            <input type="hidden" id="payment_option" class="form-control" value="<?= $payment_option ?>" readonly>
            <input type="hidden" id="comment" class="form-control" value="<?= $comment ?>" readonly>

            <input type="hidden" id="subtotal" class="form-control" readonly>
            <input type="hidden" id="tax" class="form-control" readonly>
            <input type="hidden" id="total" class="form-control" readonly>

            <div class="table-responsive">
                <?php $class->get_cart_to_confirm($customer_id) ?>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-md btn-secondary" id="back">Back</button>
                <button type="submit" class="btn btn-primary" id="confirm_order">Confirm Order</button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require "assets/common/footer.php"; ?>

    <script src="script/confirm_order.js"></script>
</body>
