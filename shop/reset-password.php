<?php
function page_title() {
    $page_title = "Reset Password";
    echo $page_title;
}
require "assets/common/header.php";
if(isset($_SESSION["email"])){
    // Redirect to shopping cart if the cart is empty
    echo '<script>window.location.replace("myaccount");</script>';
}
?>

<body>
    <!-- Navbar -->
    <?php require "assets/common/navbar.php"; ?>
    <?php 
        if ($_GET["key"] && $_GET["token"]) {
        $customer_email = $_GET["key"];
        $expiration_format = mktime(date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y"));
        $expDate = date("Y-m-d H:i:s",$expiration_format);
        $curDate = date("Y-m-d H:i:s");

        if ($expDate >= $curDate) {
    ?>

    <section class="mt-5 container"> 
        <div class="mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="margin: 0;">
                    <li class="breadcrumb-item active"><i class="fa fa-home" aria-hidden="true"></i></li>
                    <li class="breadcrumb-item">Reset Password</li>
                </ol>
            </nav>
        </div>

        <div class="row"> 
            <div class="col-sm-12 col-md-8 login-form"> 
                <div class="form container"> 
                    <h3 class="title mb-3">Reset Password</h3>

                    <div class="mb-3">
                        <label for="customer_email" class="form-label">E-mail Address: *</label>
                        <input type="text" class="form-control" id="customer_email" value="<?= $customer_email ?>" placeholder="E-mail Address">
                    </div>

                    <div class="mb-3">
                        <label for="customer_password" class="form-label">New Password: *</label>
                        <input type="password" class="form-control" id="customer_password" placeholder="Password">
                    </div>

                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password: *</label>
                        <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password">
                    </div>

                    <button type="submit" class="btn btn-md btn-primary" id="submit">Submit</button>
                </div>
            </div>

            <div class="col-sm-12 col-md-4 side-menu">
                <!-- Side Menu -->
                <?php require "assets/common/sidemenu.php"; ?>
            </div>

            <!-- Alert modal -->
            <div class="modal fade modal-alert" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Alert message</h5>
                    </div>
                    <div class="modal-body">
                        <div id="alert" role="alert"></div>
                        <div id="successAlert" role="alert"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="close" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="proceed" class="btn btn-primary">Proceed</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php 
      } else {
        echo '<script>window.location.replace("404");</script>';
      }
    } else {
        echo '<script>window.location.replace("404");</script>';
    }
    ?>
    <!-- Footer -->
    <?php require "assets/common/footer.php"; ?>

    <script src="script/update_password.js"></script>
</body>