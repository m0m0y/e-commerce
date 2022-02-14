<?php 
require "assets/common/header.php";
$get_order_id = $_GET["order_id"];

$order_id = $class->get_order_details("order_id", $get_order_id);
$invoice_no = $class->get_order_details("invoice_no", $get_order_id);
$customer_id = $class->get_order_details("customer_id", $get_order_id);
$customer_firstname = $class->get_order_details("firstname", $get_order_id);
$customer_lastname = $class->get_order_details("lastname", $get_order_id);
$customer_email = $class->get_order_details("email", $get_order_id);
$customer_telephone = $class->get_order_details("telephone", $get_order_id);
$comment = $class->get_order_details("comment", $get_order_id);
$payment_method = $class->get_order_details("payment_method", $get_order_id);
$payment_code = $class->get_order_details("payment_code", $get_order_id);
$total = $class->get_order_details("total", $get_order_id);
$ip = $class->get_order_details("ip", $get_order_id);
$pick_up_date = $class->get_order_details("pick_up_date", $get_order_id);
$date_added = $class->get_order_details("date_added", $get_order_id);

$invoice_no = $class->get_orders_table("invoice_no", "order_product", "order_id='$order_id'");
$product_id = $class->get_orders_table("product_id", "order_product", "order_id='$order_id'");
$quantity = $class->get_orders_table("quantity", "order_product", "order_id='$order_id'");
$price = $class->get_orders_table("price", "order_product", "order_id='$order_id'");
$total = $class->get_orders_table("total", "order_product", "order_id='$order_id'");

$order_status_id = $class->get_order_details("order_status_id", $get_order_id);

$status_name = $class->get_order_status_id("name", $order_status_id);
if($get_order_id != $order_id) {
    echo '<script>window.location.replace("404.php");</script>';
}
?>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php require "assets/common/sidenav.php"; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                <?php require "assets/common/top-navbar.php"; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Update Order Information</h1>
                    </div>

                    <div class="col-lg-12 mb-4">
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-pencil-alt"></i> Update Order Information</h6>
                            </div>
                            <div class="card-body">

                                <div class="mb-3" id="alertMessage"></div>

                                <!-- Tabs -->
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <button class="nav-link tab_button active" onclick="openTabs(event, 'customer_details')">1. Customer Details</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link tab_button" onclick="openTabs(event, 'payment_details')">2. Payment Details</button>
                                    </li>
                                </ul>

                                <div id="customer_details" class="tabcontent" style="display: flex; flex-direction: column;">
                                    <div class="row mt-4">
                                        <label for="firstname" class="col-sm-3 col-form-label text-right"><span class="required">*</span> First Name:</label>
                                        <div class="col-sm-9">
                                            <input type="hidden" id="ses_email" class="form-control" value="<?= $email ?>" readonly/>
                                            <input type="hidden" id="ses_group_id" class="form-control" value="<?= $user_group ?>" readonly/>
                                            <input type="hidden" id="order_id" class="form-control" value="<?= $order_id ?>" readonly/>
                                            <input type="text" id="firstname" class="form-control" value="<?= $customer_firstname ?>" placeholder="First Name">
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <label for="lastname" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Last Name:</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="lastname" class="form-control" value="<?= $customer_lastname ?>" placeholder="Last Name">
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <label for="email" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Email:</label>
                                        <div class="col-sm-9">
                                            <input type="email" id="email" class="form-control" value="<?= $customer_email ?>" placeholder="Email">
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <label for="telephone" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Telephone:</label>
                                        <div class="col-sm-9">
                                            <input type="number" id="telephone" class="form-control" value="<?= $customer_telephone ?>" placeholder="Telephone">
                                        </div>
                                    </div>
                                </div>

                                <div id="payment_details" class="tabcontent">
                                    <div class="row mt-4">
                                        <label class="col-sm-3 col-form-label text-right">Current Payment Method:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="<?= $payment_method ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <label for="payment_option" class="col-sm-3 col-form-label text-right"> Payment options:</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="payment_option" required>
                                                <option value="" disabled selected>Choose Payment Method</option>
                                                <option value="cash">Cash</option>
                                                <option value="gcash">Gcash</option>
                                                <option value="bank_transfer">Bank Transfer</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-5 d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="button" class="btn btn-secondary" id="back"><i class="fas fa-arrow-left"></i> Back</button>
                                    <button type="button" class="btn btn-primary" id="save"><i class="fas fa-save"></i> Save</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div id="preloader" style="display: none;"></div>
                    <?php require "assets/common/footer.php"; ?>
                </div>
            </div>
        </div>
    </div>
    
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="assets/js/admin.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/demo/datatables-demo.js"></script>

    <script src="script/update_orders.js"></script>
</body>