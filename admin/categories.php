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

                    <div class="card shadow mb-5">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-list"></i> Categories</h6>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <?php $class->get_categories(); ?>
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
                                            <div id="alertMessage"></div>

                                            <div class="row mb-4">
                                                <label for="product_name" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Category Name:</label>
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
                                                    <input type="text" id="meta_tag_title" class="form-control" placeholder="Meta Tag Title">
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="email" class="col-sm-3 col-form-label text-right">Status:</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="category_status">
                                                        <option value="1">Enable</option>
                                                        <option value="0">Disabled</option>
                                                    </select>
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

    <script src="script/categories.js"></script>
</body>