<?php
require "assets/common/header.php";
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
                        <?php require "assets/common/page-heading.php"; ?>
                    </div>
                    
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-pencil-alt"></i> Add Category</h6>
                        </div>

                        <div class="card-body">
                            <div id="alertMessage"></div>

                            <div align="right" style="margin-bottom:5px;">
                                <button type="button" id="save" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Save</button>
                                <a href="categories" class="btn btn-sm btn-secondary btn-user"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
                            </div>

                            <!-- Tabs -->
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                <button class="nav-link tab_button active" onclick="openTabs(event, 'General')">General</button>
                                </li>
                                <li class="nav-item">
                                <button class="nav-link tab_button" onclick="openTabs(event, 'Data')">Data</button>
                                </li>
                            </ul>

                            <!-- Contents -->
                            <div id="General" class="tabcontent" style="display: flex; flex-direction: column;">

                                <div class="row mb-4">
                                    <label for="category_name" class="col-sm-3 col-form-label text-right">* Category Name:</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="category_name" class="form-control" placeholder="Category Name">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="description" class="col-sm-3 col-form-label text-right">Description:</label>
                                    <div class="col-sm-9">
                                        <textarea id="description" name="description" rows="4" cols="50" class="form-control" placeholder="Description"></textarea>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="meta_tag_title" class="col-sm-3 col-form-label text-right">* Meta Tag Title:</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="meta_tag_title" class="form-control" name="meta_tag_title" placeholder="Meta Tag Title">
                                    </div>
                                </div>
                            </div>

                            <div id="Data" class="tabcontent">

                                <div class="row mb-4">
                                    <label for="price" class="col-sm-3 col-form-label text-right">* Price:</label>
                                    <div class="col-sm-9">
                                        <input type="number" id="price" class="form-control" name="price" placeholder="Price">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="quantity" class="col-sm-3 col-form-label text-right">* Quantity:</label>
                                    <div class="col-sm-9">
                                        <input type="number" id="quantity" class="form-control" name="quantity" placeholder="Quantity">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="stock_status" class="col-sm-3 col-form-label text-right">Stock Status:</label>
                                    <div class="col-sm-9">
                                        <select name="stock_status" class="form-control" id="stock_status">
                                        <?php $class->get_stock_status_id(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="weight" class="col-sm-3 col-form-label text-right">Weight:</label>
                                    <div class="col-sm-9">
                                        <input type="number" id="weight" class="form-control" name="weight" placeholder="Weight">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="weight_class" class="col-sm-3 col-form-label text-right">Weight Class:</label>
                                    <div class="col-sm-9">
                                        <select name="weight_class" class="form-control" id="weight_class">
                                        <?php $class->get_weight_description(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="product_status" class="col-sm-3 col-form-label text-right">Status:</label>
                                    <div class="col-sm-9">
                                        <select name="product_status" class="form-control" id="product_status">
                                        <option id="product_status_val" value="1">Enable</option>
                                        <option id="product_status_val" value="0">Disabled</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
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
    <script src="assets/js/admin.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/datatables-demo.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/chart-area-demo.js"></script>
    <script src="assets/js/demo/chart-pie-demo.js"></script>

    <script> 
        function openTabs(event, tabName) {
            var c, tabcontent, tab_button;

            tabcontent = document.getElementsByClassName("tabcontent");
            for (c = 0; c < tabcontent.length; c++) {
            tabcontent[c].style.display = "none";
            }

            tab_button = document.getElementsByClassName("tab_button");
            for (c = 0; c < tab_button.length; c++) {
            tab_button[c].className = tab_button[c].className.replace(" active", "");
            }

            document.getElementById(tabName).style.display = "block";
            event.currentTarget.className += " active";
        }

        $(document).ready(function(){
            $('#save').on('click', function(){
                alert("sdsd");
            });
        });
    </script>
</body>