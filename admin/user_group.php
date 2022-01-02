<?php 
require "assets/common/header.php";
?>

<body id="page-top">

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
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-list"></i> User Group</h6>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- Data Tales -->
                                <?php $class->select_user_groups(); ?>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="Mymodal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="title-container">
                                                <h5 class="modal-title"></h5>
                                            </div>
                                        </div> 
                                        <div class="modal-body">
                                            <div id="alertMessage"></div>
                                            <label for="user_group_name" class="col-form-label">* User Group Name:</label>
                                            <div class="col-sm-12">
                                                <input type="text" id="user_group_name" class="form-control" name="user_group_name" placeholder="Type Here..."/>
                                            </div>
                                        </div>   
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Close</button>      
                                            <button type="button" class="btn btn-primary save-btn" name="save">Save</button>           
                                        </div>
                                    </div>                                                                       
                                </div>                                          
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Footer -->
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

    <script src="script/user_group.js"></script>

</body>