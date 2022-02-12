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

                            <div align="right" class="btn-container" style="margin-bottom:5px;">
                                <button type="button" id="save" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Save</button>
                                <a href="categories" class="btn btn-sm btn-secondary btn-user"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
                            </div>

                            <!-- Tabs -->
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                <button class="nav-link tab_button active" onclick="openTabs(event, 'General')">General</button>
                                </li>
                            </ul>

                            <!-- Contents -->
                            <div id="General" class="tabcontent" style="display: flex; flex-direction: column;">

                                <div class="row mb-4">
                                    <label for="category_name" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Category Name:</label>
                                    <div class="col-sm-9">
                                            <input type="hidden" id="email" class="form-control" value="<?= $email ?>" readonly/>
                                            <input type="hidden" id="ses_group_id" class="form-control" value="<?= $user_group ?>" readonly/>
                                        <input type="text" id="category_name" class="form-control" placeholder="Category Name">
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
                                        <input type="text" id="meta_tag_title" class="form-control" name="meta_tag_title" placeholder="Meta Tag Title">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="product_status" class="col-sm-3 col-form-label text-right">Status:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="category_status">
                                        <option value="1">Enable</option>
                                        <option value="0">Disabled</option>
                                        </select>
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

    
    <script src="assets/js/demo/chart-area-demo.js"></script>
    <script src="assets/js/demo/chart-pie-demo.js"></script>

    <script src="script/categories.js"></script>
</body>