<?php 
require "controller/header.controller.php";
require "assets/common/header.php";
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
                    </ol>
                </nav>
            </div>

            <div class="col-sm-12 col-md-8 order-history"> 
                <h3 class="mt-3">Order History</h3>
                <hr> </hr>

                <div class="table-responsive">
                    <?php $class->get_order_history($customer_id); ?>
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
            $('#dataTable').DataTable();
        });
    </script>
</body>