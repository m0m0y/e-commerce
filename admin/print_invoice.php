<?php
require "assets/common/header.php";
$get_order_id = $_GET["order_id"];

$order_id = $class->get_order_details("order_id", $get_order_id);
$invoice_no = $class->get_order_details("invoice_no", $get_order_id);
$customer_id = $class->get_order_details("customer_id", $get_order_id);
$firstname = $class->get_order_details("firstname", $get_order_id);
$lastname = $class->get_order_details("lastname", $get_order_id);
$email = $class->get_order_details("email", $get_order_id);
$telephone = $class->get_order_details("telephone", $get_order_id);
$comment = $class->get_order_details("comment", $get_order_id);
$payment_method = $class->get_order_details("payment_method", $get_order_id);
$payment_code = $class->get_order_details("payment_code", $get_order_id);
$total = $class->get_order_details("total", $get_order_id);
$ip = $class->get_order_details("ip", $get_order_id);
$pick_up_date = $class->get_order_details("pick_up_date", $get_order_id);
$date_added = $class->get_order_details("date_added", $get_order_id);

$address_1 = $class->get_customer_address("address_1", $customer_id);
$address_2 = $class->get_customer_address("address_2", $customer_id);
$city = $class->get_customer_address("city", $customer_id);
$region = $class->get_customer_address("region", $customer_id);
if($get_order_id != $order_id) {
?>
    <script>window.location.replace("404.php");</script>
<?php
}
?>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container mt-5">
                    <h2>Invoice #<?= $invoice_no ?></h2>
                    <table class="table table-bordered">
                        <thead> 
                            <tr>
                                <th colspan=2>
                                    Order details
                                </th>
                            </tr>
                        </thead>

                        <tbody> 
                            <tr>
                                <td>
                                    <p><b>Your Store</b> </br> Address 1</p>
                                    <p>
                                        <b>Telephone: </b> 091234567789 </br>
                                        <b>Email: </b> yourshop@email.com </br>
                                        <b>Website: </b> <a href="http://localhost/test/shop/home" target="blank">http://localhost/test/shop/home</a></br>
                                    </p>
                                </td>
                                <td>
                                    <p>
                                        <b>Date Added: </b> <?= $date_added ?> </br>
                                        <b>Invoice No.: </b> <?= $invoice_no ?> </br>
                                        <b>Order ID: </b> <?= $order_id ?> </br>
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
                                <th colspan=2>
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

                    <?php $class->get_orders_product($get_order_id); ?>

                    <span>Reports Generated: <?= "<b>" . date("m/d/Y") . ": " . date("l"); "</b>" ?></span>
                </div>
            </div>

        </div>
    </div>

    
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="assets/js/admin.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/demo/datatables-demo.js"></script>

    <script> 
        $(document).ready(function(){
            var over_all_total = 0;

            $('td[data-id]').map(function() {
                over_all_total += parseFloat($(this).find('span').text());
            });

            var sub_total = $('#sub-total').html('₱ '+over_all_total+'.00');
            var vat = $('#vat').html('₱ 0.00');
            var total_price = $('#total-price').html('₱ '+over_all_total+'.00');
        });
    </script>
</body>