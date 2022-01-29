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

$history_comment = $class->get_customer_history("comment", $get_order_id);
$history_order_status = $class->get_customer_history("order_status_id", $get_order_id);

$status_name = $class->get_order_status_id("name", $history_order_status);
if($get_order_id != $order_id) {
?>
    <script>window.location.replace("404.php");</script>
<?php
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
                        <h1 class="h3 mb-0 text-gray-800">Order Summary</h1>
                        <div class="d-none d-sm-inline-block ">
                            <a href="print_invoice?order_id=<?= $order_id ?>" target="blank" class="btn btn-sm btn-info shadow-sm"><i class="fas fa-print"></i> Print Invoice</a>
                            <a href="update_orders?order_id=<?= $order_id ?>" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                            <a href="orders" class="btn btn-sm btn-secondary shadow-sm"><i class="fas fa-arrow-left"></i> Back</a>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-shopping-cart"></i> Order Details</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered"> 
                                        <tbody> 
                                            <tr>
                                                <td>
                                                    <div class="badge bg-info fs-6 fw-normal"><i class="fa fa-calendar-alt"></i> 
                                                    Date Added
                                                    </div> 
                                                </td>
                                                <td> 
                                                    <?= $date_added ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="badge bg-info fs-6 fw-normal"><i class="fa fa-credit-card"></i>
                                                        Payment Method
                                                    </div> 
                                                </td>
                                                <td> 
                                                    <?= $payment_method ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="badge bg-info fs-6 fw-normal"><i class="fa fa-credit-card"></i>
                                                    Shipping Method
                                                    </div> 
                                                </td>
                                                <td> 
                                                    Pick up from Store
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="badge bg-info fs-6 fw-normal"><i class="fa fa-calendar-alt"></i> 
                                                    Pick up Date
                                                    </div> 
                                                </td>
                                                <td> 
                                                    <?= $pick_up_date ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-4">
                            <div class="card shadow">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-user"></i> Customer Details</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered"> 
                                        <tbody> 
                                            <tr>
                                                <td>
                                                    <div class="badge bg-info fs-6 fw-normal"><i class="fa fa-users"></i> 
                                                    Customer
                                                    </div> 
                                                </td>
                                                <td> 
                                                    <?= $customer_firstname.' '.$customer_lastname ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="badge bg-info fs-6 fw-normal"><i class="fa fa-envelope"></i>
                                                        Email
                                                    </div> 
                                                </td>
                                                <td> 
                                                    <?= $customer_email ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="badge bg-info fs-6 fw-normal"><i class="fa fa-phone-alt"></i>
                                                    Telephone
                                                    </div> 
                                                </td>
                                                <td> 
                                                    <?= $customer_telephone ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card shadow mb-5">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-info-circle"></i> Order (#<?= $get_order_id ?>)</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead> 
                                    <tr>
                                        <th>
                                            Customer Address
                                        </th>
                                    </tr>
                                </thead>

                                <tbody> 
                                    <tr>
                                        <td>
                                            <p><?= $customer_firstname.' '.$customer_lastname ?></p>
                                            <p><?= $address_1 ?></p>
                                            <p><?= $address_2 ?></p>
                                            <p><?= $city ?></p>
                                            <p><?= $region ?></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <?php $class->get_orders_product($get_order_id); ?>
                        </div>
                    </div>

                    <div class="card shadow mb-5">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-history"></i> Order History</h6>
                        </div>
                        <div class="card-body">
                            <!-- Tabs -->
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                <button class="nav-link tab_button active" onclick="openTabs(event, 'General')">History</button>
                                </li>
                            </ul>

                            <!-- Contents -->
                            <div id="General" class="tabcontent" style="display: flex; flex-direction: column;">
                                <table class="table table-bordered">
                                    <thead> 
                                        <tr>
                                            <th>Date Added</th>
                                            <th>Comment</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                    <tbody> 
                                        <tr>
                                            <td><?= $date_added ?></td>
                                            <td><?= $history_comment ?></td>
                                            <td><?= $status_name ?> </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <h5 class="mt-5 fw-normal">Add Order History</h5>
                                <hr></hr>
                                
                                <input type="hidden" id="ses_email" class="form-control" value="<?= $email ?>" readonly/>
                                <input type="hidden" id="ses_group_id" class="form-control" value="<?= $user_group ?>" readonly/>

                                <input type="hidden" id="order_id" class="form-control" value="<?= $order_id ?>" readonly/>
                                <input type="hidden" id="invoice_no" class="form-control" value="<?= $invoice_no ?>" readonly/>
                                <input type="hidden" id="customer_name" class="form-control" value="<?= $customer_firstname. ' ' . $customer_lastname ?>" readonly/>

                                <div class="row mb-4">
                                    <label for="order_status" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Order Status:</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" id="order_status" required>
                                            <option value="" selected disabled>Choose status</option>
                                            <?php $class->get_order_status_value(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="comment" class="col-sm-3 col-form-label text-right"> Comment:</label>
                                    <div class="col-sm-9">
                                        <textarea id="comment" rows="4" cols="50" class="form-control" placeholder="Comment"><?= $history_comment; ?></textarea>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="submit" class="btn btn-md btn-primary" onclick="addHistory()"><i class="fa fa-plus-circle"></i> Add History</button>
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

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/admin.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/datatables-demo.js"></script>

    <script src="script/order_summary.js"></script>
</body>