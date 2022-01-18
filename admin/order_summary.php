<?php 
require "assets/common/header.php";
$order_id = $_GET["order_id"];


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
                            <a href="#" class="btn btn-sm btn-info shadow-sm"><i class="fas fa-print"></i> Print Invoice</a>
                            <a href="#" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                            <a href="#" class="btn btn-sm btn-secondary shadow-sm"><i class="fas fa-arrow-left"></i> Back</a>
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
                                                    <td>Date Added: Larry the Bird</td>
                                                </tr>

                                                <tr>
                                                    <td>Payment Method: Larry the Bird</td>
                                                </tr>

                                                <tr>
                                                    <td>Shipping Method: Larry the Bird</td>
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
                                        
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card shadow mb-5">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-shopping-cart"></i> Order (#<?= $order_id ?>)</h6>
                        </div>
                        <div class="card-body">
                           
                        </div>
                    </div>
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
</body>