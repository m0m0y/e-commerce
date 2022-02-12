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
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-list"></i> Customer List</h6>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <?php $class->get_customers(); ?>
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
                                                    <button class="nav-link tab_button" onclick="openTabs(event, 'Address')">Address</button>
                                                </li>
                                            </ul>
                                            
                                            <!-- Contents -->
                                            <div id="General" class="tabcontent" style="display: flex; flex-direction: column;">
                                                <div class="row mt-4">
                                                    <label for="firstname" class="col-sm-3 col-form-label text-right"><span class="required">*</span> First Name:</label>
                                                    <div class="col-sm-9">
                                                        <input type="hidden" id="ses_email" class="form-control" value="<?= $email ?>" readonly/>
                                                        <input type="hidden" id="ses_group_id" class="form-control" value="<?= $user_group ?>" readonly/>
                                                        <input type="text" id="firstname" class="form-control" placeholder="First Name">
                                                    </div>
                                                </div>

                                                <div class="row mt-4">
                                                    <label for="lastname" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Last Name:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="lastname" class="form-control" placeholder="Last Name">
                                                    </div>
                                                </div>

                                                <div class="row mt-4">
                                                    <label for="email" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Email:</label>
                                                    <div class="col-sm-9">
                                                        <input type="email" id="email" class="form-control" placeholder="Email">
                                                    </div>
                                                </div>

                                                <div class="row mt-4">
                                                    <label for="telephone" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Telephone:</label>
                                                    <div class="col-sm-9">
                                                        <input type="numter" id="telephone" class="form-control" placeholder="Telephone">
                                                    </div>
                                                </div>

                                                <div class="row mt-4">
                                                    <label for="password" class="col-sm-3 col-form-label text-right"> Password:</label>
                                                    <div class="col-sm-9">
                                                        <input type="password" id="password" class="form-control" placeholder="Password">
                                                    </div>
                                                </div>

                                                <div class="row mt-4">
                                                    <label for="confirm_pass" class="col-sm-3 col-form-label text-right"> Confirm Password:</label>
                                                    <div class="col-sm-9">
                                                        <input type="password" id="confirm_pass" class="form-control" placeholder="Confirm Password">
                                                    </div>
                                                </div>

                                                <div class="row mt-4">
                                                    <label for="status" class="col-sm-3 col-form-label text-right">Status:</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" id="status">
                                                            <option value="1">Enable</option>
                                                            <option value="0">Disabled</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="Address" class="tabcontent">
                                                <div class="row mt-4">
                                                    <label for="address_1" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Primary Address:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="address_1" class="form-control" placeholder="Primary Address">
                                                    </div>
                                                </div>

                                                <div class="row mt-4">
                                                    <label for="address_2" class="col-sm-3 col-form-label text-right">Secondary Address:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="address_2" class="form-control" placeholder="Secondary Address">
                                                    </div>
                                                </div>

                                                <div class="row mt-4">
                                                    <label for="city" class="col-sm-3 col-form-label text-right"><span class="required">*</span> City:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="city" class="form-control" placeholder="City">
                                                    </div>
                                                </div>

                                                <div class="row mt-4">
                                                    <label for="postcode" class="col-sm-3 col-form-label text-right"> Postal Code:</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" id="postcode" class="form-control" placeholder="Postal Code">
                                                    </div>
                                                </div>

                                                <div class="row mt-4">
                                                    <label for="region" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Region:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="region" class="form-control" placeholder="Region">
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

    <script src="script/customer.js"></script>
</body>