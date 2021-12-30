<?php 
require "assets/common/header.php";
require "controller/function.php";
session_start();

$id = $_SESSION["id"];
$firstname = $_SESSION["firstname"];
$lastname = $_SESSION["lastname"];
$email = $_SESSION["email"];
$user_id = $_SESSION["id"];
$class->islogin($email);
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

                    <!-- Basic Card Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-pencil-alt"></i> Edit Your Profile</h6>
                        </div>
                        <div class="card-body">

                        <!-- Form -->
                        <div class="p-4">
                            <div id="alertMessage"></div>
                            
                            <div class="row mb-3">
                                <label for="firstname" class="col-sm-2 col-form-label">* Firstname</label>
                                <div class="col-sm-10">
                                    <input type="hidden" id="user_id" class="form-control" name="user_id" value="<?php echo $user_id ?>" readonly/>
                                    <input type="text" id="firstname" class="form-control" name="fname" placeholder="First Name" value="<?php echo $firstname ?>"/>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="lastname" class="col-sm-2 col-form-label">* Lastname</label>
                                <div class="col-sm-10">
                                    <input type="text" id="lastname" class="form-control" name="lname" placeholder ="Last Name" value="<?php echo $lastname ?>"/>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="emailadd" class="col-sm-2 col-form-label">* Email</label>
                                <div class="col-sm-10">
                                    <input type="email" id="emailadd" class="form-control form-control-user" name="email" placeholder="Email Address" value="<?php echo $email ?>"/>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password" class="col-sm-2 col-form-label">* Password</label>
                                <div class="col-sm-10">
                                    <input type="password" id="password" class="form-control" name="pass" placeholder="Password"/>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="confirm_password" class="col-sm-2 col-form-label">* Confirm</label>
                                <div class="col-sm-10">
                                <input type="password" id="confirm_password" class="form-control" name="confirm_pass" placeholder="Repeat Password"/>
                                </div>
                            </div>

                            <input id="save" type="button" class="btn btn-primary btn-user" name="save" value="Save">

                            <a href="home" class="btn btn-secondary btn-user">Back</a>
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
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/chart-area-demo.js"></script>
    <script src="assets/js/demo/chart-pie-demo.js"></script>

    <script src="script/profile.js"></script>
</body>