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
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-list"></i> Manufacturer List</h6>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <?php $class->get_manufacturers(); ?>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="Mymodal">
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
                                                <label for="name" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Manufacturer Name:</label>
                                                <div class="col-sm-9">
                                                    <input type="text" id="name" class="form-control" placeholder="Manufacturer Name">
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
        function add_manufacturers() {
            $('#close').click(function(){
                window.location.href="manufacturer";
            });

            $('#Mymodal').modal('show');
            $('.title-container').html('<i class="fas fa-pencil-alt"></i> Add Manufacturer');
            $('.save-btn').attr('id', 'save');

            $('#save').on('click', function(){
                var alert_message = $('#alertMessage').val();

                var name = $('#name').val();

                if(name == "") {
                    alert_message = "Please double check the required fields!";
                    $('#alertMessage').text(alert_message).addClass("alert alert-danger");
                } else {
                    $.ajax({
                        url: 'controller/function.php?add_manufacturer',
                        method: 'POST',
                        data: {
                            name:name
                        },
                        success:function(){
                            window.location.reload();
                        }
                    });
                }
            });
        }

        function update_manufacturers(manufacturer_id, name) {
            $('#close').click(function(){
                window.location.href="manufacturer";
            });

            $('#Mymodal').modal('show');
            $('.title-container').html('<i class="fas fa-pencil-alt"></i> Update Manufacturer');
            $('.save-btn').attr('id', 'update');

            $('#name').val(name);

            $('#update').on('click', function(){
                var alert_message = $('#alertMessage').val();

                var name = $('#name').val();

                if(name == "") {
                    alert_message = "Please double check the required fields!";
                    $('#alertMessage').text(alert_message).addClass("alert alert-danger");
                } else {
                    $.ajax({
                        url: 'controller/function.php?update_manufaturer',
                        method: 'POST',
                        data: {
                            manufacturer_id:manufacturer_id,
                            name:name
                        },
                        success:function(){
                            window.location.reload();
                        }
                    });
                }
            });
        }

        function delete_manufacturers(manufacturer_id) {
            $.ajax({
                url: 'controller/function.php?delete_manufacturer',
                method: 'POST',
                data: {
                    manufacturer_id:manufacturer_id
                },
                success:function(){
                    window.location.reload();
                }
            });
        }
    </script>
</body>