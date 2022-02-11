<?php
// For displaying the page title only
function page_title() {
    $page_title = "Order Information";
    echo $page_title;
}
require "assets/common/header.php";

$order_id = $_GET["order_id"];
$customer_id = $_SESSION["customer_id"];

$firstname = $class->get_customer_address("firstname", $customer_id);
$lastname = $class->get_customer_address("lastname", $customer_id);
$address_1 = $class->get_customer_address("address_1", $customer_id);
$address_2 = $class->get_customer_address("address_2", $customer_id);
$city = $class->get_customer_address("city", $customer_id);
$postcode = $class->get_customer_address("postcode", $customer_id);
$region = $class->get_customer_address("region", $customer_id);

$invoice_no = $class->get_orders_tables("invoice_no", "orders", "order_id='$order_id'");
$date_added = $class->get_orders_tables("date_added", "orders", "order_id='$order_id'");
$payment_method = $class->get_orders_tables("payment_method", "orders", "order_id='$order_id'");
$invoice_no = $class->get_orders_tables("invoice_no", "orders", "order_id='$order_id'");

$history_order_status_id = $class->get_orders_history("order_status_id", "order_id='$order_id'");
$history_comment = $class->get_orders_history("comment", "order_id='$order_id'");
$history_date_added = $class->get_orders_history("date_added", "order_id='$order_id'");

$status_name = $class->get_orders_tables("name", "order_status", "order_status_id='$history_order_status_id'");
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
                        <li class="breadcrumb-item">Order History</li>
                        <li class="breadcrumb-item">Order Information</li>
                    </ol>
                </nav>
            </div>
        

            <div class="col-sm-12 col-md-8 order-info">
                <h3 class="mt-3">Order Information</h3>
                <table class="table table-bordered">
                    <thead> 
                        <tr>
                            <th colspan=2 class="fw-normal">
                                Order details
                            </th>
                        </tr>
                    </thead>

                    <tbody> 
                        <tr>
                            <td>
                                <p>
                                    <b>Invoice No.: </b> <?= $invoice_no ?> </br>
                                    <b>Order ID: </b> <?= $order_id ?> </br>
                                    <b>Date Added: </b> <?= $date_added ?> </br>
                                </p>
                            </td>
                            <td>
                                <p>
                                    <b>Payment Method: </b> <?= $payment_method ?> </br>
                                    <b>Shipping Method: </b> Pick up from Store </br>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered">
                    <thead> 
                        <tr>
                            <th colspan=2 class="fw-normal">
                                Customer Address
                            </th>
                        </tr>
                    </thead>

                    <tbody> 
                        <tr>
                            <td> 
                                <p>
                                    <?= $firstname.' '.$lastname ?> </br>
                                    <?= $address_1 ?> </br>
                                    <?= $address_2 ?> </br>
                                    <?= $city ?> </br>
                                    <?= $region ?> </br>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="table-responsive">
                    <?php $class->get_orders_product($order_id); ?> 
                </div>

                <h4 class="mt-3">Order History</h4>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Date Added</td>
                            <td>Status</td>
                            <td>Comment</td>
                        </tr>
                        <tr>
                            <td><?= $history_date_added ?></td>
                            <td><?= $status_name ?></td>
                            <td><?= $history_comment ?></td>
                        </tr>
                    </tbody>
                </table>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="order_history" class="btn btn-secondary">Continue</a>
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
        function add_to_cart(customer_id, product_id, quantity) {
            $.ajax({
                url: 'controller/cart.controller.php?add_cart',
                method: 'POST',
                data: {
                    customer_id:customer_id,
                    product_id:product_id,
                    quantity:quantity
                },
                success:function(){
<<<<<<< HEAD
                    window.location.href = 'cart'; 
=======
                    window.location.href="cart";
>>>>>>> e9687b951bb12d6a70f790f21a7896a294e742b0
                }
            });
        }
    </script>
</body>