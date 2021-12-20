<?php 
include "assets/common/header.php";
include "controller/function.php";
session_start();

$firstname = $_SESSION["firstname"];
$lastname = $_SESSION["lastname"];
$email = $_SESSION["email"];
$class->islogin($email);
?>

<body id="page-top">

    <div id="wrapper">

        <?php include "assets/common/sidenav.php"; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column"> 

            <!-- Main Content -->
            <div id="content">

                <?php include "assets/common/top-navbar.php"; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <?php include "assets/common/page-heading.php"; ?>
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
                                                <label for="firstname" class="col-sm-3 col-form-label">* Firstname</label>
                                                <div class="col-sm-9">
                                                    <input type="text" id="firstname" class="form-control" name="fname" placeholder="First Name">
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="lastname" class="col-sm-3 col-form-label">* Lastname</label>
                                                <div class="col-sm-9">
                                                    <input type="text" id="lastname" class="form-control" name="lname" placeholder="Last Name">
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="user_group" class="col-sm-3 col-form-label"> User Group</label>
                                                <div class="col-sm-9">
                                                    <select id="user_group" class="form-control" name="user_group">
                                                        <?php $class->get_user_group_id(); ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="email" class="col-sm-3 col-form-label">* Email Address</label>
                                                <div class="col-sm-9">
                                                    <input type="email" id="email" class="form-control" name="mail" placeholder="Email Address">
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="password" class="col-sm-3 col-form-label">* Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" id="password" class="form-control" name="pass" placeholder="Password">
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="confirm_password" class="col-sm-3 col-form-label">* Confirm Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" id="confirm_password" class="form-control" name="confirm_pass" placeholder="Confirm Password">
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="firstname" class="col-sm-3 col-form-label">Status</label>
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
        $(document).ready(function(){
            $('#close').click(function(){
                window.location.href="user";
            });
        });

        function add_user_admin() {
            $('#Mymodal').modal('show');
            $('.title-container').html('<i class="fas fa-user-plus"></i> Add User');
            $('.save-btn').attr("id", "save");

            $('#save').on('click', function(){
                var alert_message = $('#alertMessage').val();

                var fname = $('#firstname').val();
				var lname = $('#lastname').val();
                var user_group = $('#user_group').val();
				var mail = $('#email').val();
				var pass = $('#password').val();
				var confirm_pass = $('#confirm_password').val();
                var admin_status = $('#admin_status').val();

                if (pass != confirm_pass) {
                    alert_message = "Password did not match!";
                    $('#alertMessage').text(alert_message).addClass("alert alert-danger");
                } else if (fname == "" || lname == "" || mail == "" || pass == "") {
                    alert_message = "Please fill up the form correctly!";
                    $('#alertMessage').text(alert_message).addClass("alert alert-danger");
                } else {
                    $.ajax({
                        url:'controller/function.php?add_user_admin',
                        method:'POST',
                        data: {
                            fname:fname,
                            lname:lname,
                            user_group:user_group,
                            mail:mail,
                            pass:pass,
                            confirm_pass:confirm_pass,
                            admin_status:admin_status
                        },
                        success:function() {
                            alert_message = "Successfully";
                            $('#alertMessage').text(alert_message).addClass("alert alert-success");
                        }
                    });
                }

            });
        }

        function delete_admin_user(admin_user_id) {
            $.ajax({
                url:'controller/function.php?delete_admin_users',
                method:'POST', 
                data: {admin_user_id},
                success:function() {
                    window.location.href="user";
                    alert("Delete Successfully!");        
                }
            });
        }

        function update_admin_user(admin_user_id, firstname, lastname, email, admin_status, user_group) {
            $('#Mymodal').modal('show');
            $('.title-container').html('<i class="fas fa-pencil-alt"></i> Update User Admin');
            $('.save-btn').attr('id', 'update');
            $('#firstname').val(firstname);
            $('#lastname').val(lastname);
            $('#user_group').val(user_group).attr('disabled', 'disabled');
            $('#email').val(email);
            
            if (admin_status == "Enable") {
                $('#admin_status').val(1);
            } else if (admin_status == "Disabled") {
                $('#admin_status').val(0);
            }

            if ($('#user_group').val() == null) {
                $('.save-btn').attr('disabled', 'disabled');
            }
            
            $('#update').on('click', function(){
                var alert_message = $('#alertMessage').val();

                var fname = $('#firstname').val();
                var lname = $('#lastname').val();
                var mail = $('#email').val();
                var pass = $('#password').val();
				var confirm_pass = $('#confirm_password').val();
                var admin_status = $('#admin_status').val();
                var user_group = $('#user_group').val();
                
                if (pass != confirm_pass) {
                    alert_message = "Your password did not match!";
                    $('#alertMessage').text(alert_message).addClass("alert alert-danger");
                } else if (fname == "" || lname == "" || email == "") {
                    alert_message = "Please fill up the form correctly!";
                    $('#alertMessage').text(alert_message).addClass("alert alert-danger");
                } else {
                    $.ajax({
                        url: 'controller/function.php?update_user_admins',
                        method: 'POST',
                        data: {
                            admin_user_id:admin_user_id,
                            fname:fname,
                            lname:lname,
                            mail:mail,
                            pass:pass,
                            admin_status:admin_status
                        },
                        success:function(){
                            window.location.href="user";
                            alert("Success");
                        }
                    });
                }

            });
        }
    </script>
</body>