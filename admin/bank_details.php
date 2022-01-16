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
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-list"></i> List of Order Status</h6>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <?php $class->get_bank_details(); ?>
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
                                                <label for="name" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Bank Name:</label>
                                                <div class="col-sm-9">
                                                    <input type="hidden" id="email" class="form-control" value="<?= $email ?>" readonly/>
                                                    <input type="hidden" id="ses_group_id" class="form-control" value="<?= $user_group ?>" readonly/>
                                                    <input type="hidden" id="bank_id" class="form-control" readonly/>
                                                    <input type="text" id="bank_name" class="form-control" placeholder="Bank Name">
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="name" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Account Number:</label>
                                                <div class="col-sm-9">
                                                    <input type="number" id="account_number" class="form-control" placeholder="Account Number">
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="name" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Account Name:</label>
                                                <div class="col-sm-9">
                                                    <input type="text" id="account_name" class="form-control" placeholder="Account Name">
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

    <script>
        function update_bank_details(bank_id, bank_name, account_number, account_name) {
            $('#close').click(function(){
                window.location.href="bank_details";
            });

            $('.Mymodal').modal('show');
            $('.title-container').html('<i class="fas fa-pencil-alt"></i> Update Bank Details');
            $('.save-btn').attr('id', 'update');

            $('#bank_id').val(bank_id);
            $('#bank_name').val(bank_name);
            $('#account_number').val(account_number);
            $('#account_name').val(account_name);

            $('#update').on('click', function(){
                var alert_message = $('#alertMessage').val();
                var email = $('#email').val();
                var ses_group_id = $('#ses_group_id').val();
                var bank_id = $('#bank_id').val();
                var bank_name = $('#bank_name').val();
                var account_number = $('#account_number').val();
                var account_name = $('#account_name').val();

                if(bank_name == "" || account_number == "" || account_name == ""){
                    alert_message = "Please double check the required fields!";
                    $('#alertMessage').text(alert_message).addClass("alert alert-danger");
                } else {
                    $.ajax({
                        url:'controller/base.controller.php?update_banks',
                        method:'POST',
                        data: {
                            email:email,
                            ses_group_id:ses_group_id,
                            bank_id:bank_id,
                            bank_name:bank_name,
                            account_number:account_number,
                            account_name:account_name
                        },
                        success:function() {
                            $('#preloader').show();
                            window.location.reload();  
                        }
                    }); 
                }
            });
        }
    </script>
</body>
