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
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-list"></i> Information List</h6>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <?php $class->get_information(); ?>
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
                                                <label for="info_title" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Title:</label>
                                                <div class="col-sm-9">
                                                    <input type="text" id="info_title" class="form-control" placeholder="Title">
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="info_description" class="col-sm-3 col-form-label text-right">Description:</label>
                                                <div class="col-sm-9">
                                                    <textarea id="info_description" rows="4" cols="50" class="form-control" placeholder="Description"></textarea>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="meta_title" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Meta Tag Title:</label>
                                                <div class="col-sm-9">
                                                    <input type="text" id="meta_title" class="form-control" placeholder="Meta Tag Title">
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="meta_description" class="col-sm-3 col-form-label text-right">Meta Tag Description:</label>
                                                <div class="col-sm-9">
                                                    <textarea id="meta_description" rows="4" cols="50" class="form-control" placeholder="Meta Tag Description"></textarea>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="meta_keyword" class="col-sm-3 col-form-label text-right">Meta Tag Keywords:</label>
                                                <div class="col-sm-9">
                                                    <textarea id="meta_keyword" rows="3" cols="50" class="form-control" placeholder="Meta Tag Keywords"></textarea>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="info_status" class="col-sm-3 col-form-label text-right">Status:</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="info_status">
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

            </div>

            <!-- Footer -->
            <div id="preloader" style="display: none;"></div>
            <?php require "assets/common/footer.php"; ?>
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

    <script src="script/information.js"></script>
</body>