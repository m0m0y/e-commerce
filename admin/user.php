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
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-list"></i> User List</h6>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <?php $class->get_admin_user(); ?>
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
                                                <label for="firstname" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Firstname:</label>
                                                <div class="col-sm-9">
                                                    <input type="hidden" id="ses_email" class="form-control" value="<?= $email ?>" readonly/>
                                                    <input type="hidden" id="ses_group_id" class="form-control" value="<?= $user_group ?>" readonly/>
                                                    <input type="text" id="firstname" class="form-control" name="fname" placeholder="First Name">
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="lastname" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Lastname:</label>
                                                <div class="col-sm-9">
                                                    <input type="text" id="lastname" class="form-control" name="lname" placeholder="Last Name">
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="user_group" class="col-sm-3 col-form-label text-right"> User Group:</label>
                                                <div class="col-sm-9">
                                                    <select id="user_group" class="form-control" name="user_group">
                                                        <?php $class->get_user_group_id(); ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="email" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Email Address:</label>
                                                <div class="col-sm-9">
                                                    <input type="email" id="email" class="form-control" name="mail" placeholder="Email Address">
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="password" class="col-sm-3 col-form-label text-right"> Password:</label>
                                                <div class="col-sm-9">
                                                    <input type="password" id="password" class="form-control" name="pass" placeholder="Password">
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="confirm_password" class="col-sm-3 col-form-label text-right"> Confirm Password:</label>
                                                <div class="col-sm-9">
                                                    <input type="password" id="confirm_password" class="form-control" name="confirm_pass" placeholder="Confirm Password">
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="admin_status" class="col-sm-3 col-form-label text-right">Status:</label>
                                                <div class="col-sm-9">
                                                    <select name="admin_status" class="form-control" id="admin_status">
                                                        <option id="admin_status_val" value="1">Enable</option>
                                                        <option id="admin_status_val" value="0">Disabled</option>
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

    <script src="script/user.js"></script>
</body>