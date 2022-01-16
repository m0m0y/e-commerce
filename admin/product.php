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
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-list"></i> Product List</h6>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <?php $class->get_product(); ?>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade Mymodal" id="staticBackdrop" data-bs-backdrop="static">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="title-container">
                                                <h5 class="modal-title"></h5>
                                            </div>
                                        </div> 
                                        <div class="modal-body">

                                            <div class="mb-3" id="alertMessage"></div>

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
                                                    <label for="product_name" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Product Name:</label>
                                                    <div class="col-sm-9">
                                                        <input type="hidden" id="email" class="form-control" value="<?= $email ?>" readonly/>
                                                        <input type="hidden" id="ses_group_id" class="form-control" value="<?= $user_group ?>" readonly/>
                                                        <input type="text" id="product_name" class="form-control" placeholder="Product Name">
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="description" class="col-sm-3 col-form-label text-right">Description:</label>
                                                    <div class="col-sm-9">
                                                        <textarea id="description" rows="4" cols="50" class="form-control" placeholder="Description"></textarea>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="meta_tag_title" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Meta Tag Title:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="meta_tag_title" class="form-control" placeholder="Meta Tag Title">
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="meta_tag_description" class="col-sm-3 col-form-label text-right">Meta Tag Description:</label>
                                                    <div class="col-sm-9">
                                                        <textarea id="meta_tag_description" rows="4" cols="50" class="form-control" placeholder="Meta Tag Description"></textarea>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="meta_tag_keywords" class="col-sm-3 col-form-label text-right">Meta Tag Keywords:</label>
                                                    <div class="col-sm-9">
                                                        <textarea id="meta_tag_keywords" rows="3" cols="50" class="form-control" placeholder="Meta Tag Keywords"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div id="Data" class="tabcontent">
                                                <div class="row mb-4">
                                                    <label for="price" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Price:</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" id="price" class="form-control" placeholder="Price">
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="quantity" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Quantity:</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" id="quantity" class="form-control" placeholder="Quantity">
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="stock_status" class="col-sm-3 col-form-label text-right">Stock Status:</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" id="stock_status">
                                                            <?php $class->get_stock_status_id(); ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="weight" class="col-sm-3 col-form-label text-right">Weight:</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" id="weight" class="form-control" placeholder="Weight">
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="weight_class" class="col-sm-3 col-form-label text-right">Weight Class:</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" id="weight_class">
                                                            <?php $class->get_weight_description(); ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="product_status" class="col-sm-3 col-form-label text-right">Status:</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" id="product_status">
                                                            <option value="1">Enable</option>
                                                            <option value="0">Disabled</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="manufacturer_id" class="col-sm-3 col-form-label text-right">Manufacturer:</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" id="manufacturer_id">
                                                            <?php $class->get_manufacturer_value(); ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="product_category" class="col-sm-3 col-form-label text-right">Categories:</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" id="product_category">
                                                            <?php $class->get_category_description(); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>   
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Close</button>      
                                            <button type="button" class="btn btn-primary save-btn">Save</button>           
                                        </div>
                                    </div>                                                                       
                                </div>                                          
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

    <script src="script/product.js"></script>

</body>
