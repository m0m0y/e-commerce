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
        <div class="container">
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

            <?php $class->get_cart_to_confirm($customer_id) ?>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-md btn-secondary" id="back">Back</button>
                <button type="submit" class="btn btn-primary" id="confirm_order">Confirm Order</button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require "assets/common/footer.php"; ?>

    <script> 
        $(document).ready(function(){
            var over_all_total = 0;
            $('td[data-id]').map(function() {
                over_all_total += parseFloat($(this).find('span').text());
            });

            var sub_total = $('#sub-total').html('₱ '+over_all_total+'.00');
            var vat = $('#vat').html('₱ 0.00');
            var total_price = $('#total-price').html('₱ '+over_all_total+'.00');

            $('#back').on('click', function(){
                window.location.href="checkout";
            });
            
            $('#confirm_order').on('click', function(){
                var customer_id = $('#customer_id').val();
                var customer_firstname = $('#customer_firstname').val();
                var customer_lastname = $('#customer_lastname').val();
                var customer_email = $('#customer_email').val();
                var customer_telephone = $('#customer_telephone').val();

                var address_1 = $('#address_1').val();
                var address_2 = $('#address_2').val();
                var city = $('#city').val();
                var postcode = $('#postcode').val();
                var region = $('#region').val();

                var pick_up_date = $('#pick_up_date').val();
                var payment_option = $('#payment_option').val();
                var comment = $('#comment').val();

                $.ajax({
                    url: 'controller/order.controller.php?add_order',
                    method: 'POST',
                    data: {
                        customer_id:customer_id,
                        customer_firstname:customer_firstname,
                        customer_lastname:customer_lastname,
                        customer_email:customer_email,
                        customer_telephone:customer_telephone,
                        address_1:address_1,
                        address_2:address_2,
                        city:city,
                        postcode:postcode,
                        region:region,
                        pick_up_date:pick_up_date,
                        payment_option:payment_option,
                        over_all_total:over_all_total,
                        comment:comment
                    },
                    success:function() {
                        // redirect to original receipt
                        window.location.replace("cart");
                    }
                });
            });
        });
    </script>
</body>
