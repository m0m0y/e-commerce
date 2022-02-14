<?php
require "controller/header.controller.php";
require "assets/common/header.php";
if (isset($_SESSION["customer_id"])) {
    $customer_id = $_SESSION["customer_id"];
} else {
    $customer_id = "";
}

$cart_numrows = $class->get_cart_rows($customer_id);
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
                </ol>
            </nav>
        </div>

        <div class="mb-5 container"> 
            <h3>Shopping Cart</h3>
            <hr></hr>
            
            <div class="table-responsive">
                <?php $class->get_customer_cart($customer_id); ?>
            </div>

            <div class="row mt-5">
                <div class="col-sm-12 col-md-8">
                </div>

                <div class="col-sm-12 col-md-4">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="text-end">Sub-total:</td>
                                <td class="text-end fw-normal" id="sub-total"></td>
                            </tr>

                            <tr>
                                <td class="text-end">VAT:</td>
                                <td class="text-end fw-normal" id="vat"></td>
                            </tr>

                            <tr>
                                <td class="text-end">Total:</td>
                                <td class="text-end fw-normal" id="total-price"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <input type="hidden" class="form-control" value="<?= $cart_numrows ?>" id="cart_numrows" readonly>
                <button type="submit" class="btn btn-md btn-secondary" id="continue-shopping">Continue Shopping</button>
                <button type="submit" class="btn btn-md btn-primary" id="checkout" style="display: none;">Checkout</button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require "assets/common/footer.php"; ?>

    <script>
        $(document).ready(function(){
            $('#dataTable').DataTable();
            
            var over_all_total = 0;

            $('td[data-id]').map(function() {
                over_all_total += parseFloat($(this).find('span').text());
            });
        
            var sub_total = $('#sub-total').html('₱ '+over_all_total+'.00');
            var vat = $('#vat').html('₱ 0.00');
            var total_price = $('#total-price').html('₱ '+over_all_total+'.00');
            
            var cart_numrows = $('#cart_numrows').val();

            $('#continue-shopping').on('click', function(){
                window.location.href="home";
            });

            if (cart_numrows != 0) {
                $('#checkout').css("display", "flex");

                $('#checkout').on('click', function(){
                    window.location.href="checkout";
                });
            }
        });

        function update_quantity(cart_id) {
            var quantity = $('#quantity'+cart_id).val();
            
            if (quantity <= 0) {
                $('#quantity'+cart_id).addClass("is-invalid");
            } else {
                $.ajax({
                    url: 'controller/cart.controller.php?update_cart_quantity',
                    method: 'POST',
                    data: {
                        cart_id:cart_id,
                        quantity:quantity
                    },
                    success:function() {
                        window.location.reload();
                    }
                });
            }
        }

        function remove_product(cart_id) {
            $.ajax({
                url: 'controller/cart.controller.php?delete_customer_cart',
                method: 'POST',
                data: {
                    cart_id:cart_id
                },
                success:function() {
                    window.location.reload();
                }
            });
        }
    </script>
</body>