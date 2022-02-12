<?php 
require "assets/common/header.php";

$info_id = $_GET["information_id"];
$info_title = $class->get_info_details("info_title", "information_description", $info_id);
$info_desc = $class->get_info_details("info_description", "information_description", $info_id);
$meta_title = $class->get_info_details("meta_title", "information_description", $info_id);
$meta_desc = $class->get_info_details("meta_description", "information_description", $info_id);
$meta_keywords = $class->get_info_details("meta_keyword", "information_description", $info_id);
$status = $class->get_info_details("info_status", "information_description", $info_id);
?>

<body id="page-top">
    <div id="wrapper">
        <?php require "assets/common/sidenav.php"; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php require "assets/common/top-navbar.php"; ?>

                 <!-- Begin Page Content -->
                 <div class="container-fluid">
                     <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Information</h1>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-pencil-alt"></i> Update Information</h6>
                        </div>

                        <div class="card-body">

                            <div id="alertMessage"></div>

                            <div align="right" class="mb-5">
                                <button type="button" id="update" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Save</button>
                                <a href="information" class="btn btn-sm btn-secondary btn-user"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
                            </div>

                            <div class="row mb-4">
                                <label for="info_title" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Title:</label>
                                <div class="col-sm-9">
                                    <input type="hidden" id="information_id" class="form-control" value="<?= $info_id ?>" readonly>
                                    <input type="text" id="info_title" class="form-control" value="<?= $info_title ?>" placeholder="Title">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="info_description" class="col-sm-3 col-form-label text-right">Description:</label>
                                <div class="col-sm-9">
                                    <textarea id="info_description" rows="4" cols="50" class="form-control"><?= $info_desc ?></textarea>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="meta_title" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Meta Tag Title:</label>
                                <div class="col-sm-9">
                                    <input type="text" id="meta_title" class="form-control" value="<?= $meta_title ?>" placeholder="Meta Tag Title">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="meta_description" class="col-sm-3 col-form-label text-right">Meta Tag Description:</label>
                                <div class="col-sm-9">
                                    <textarea id="meta_description" rows="4" cols="50" class="form-control" placeholder="Meta Tag Description"><?= $meta_desc ?></textarea>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="meta_keyword" class="col-sm-3 col-form-label text-right">Meta Tag Keywords:</label>
                                <div class="col-sm-9">
                                    <textarea id="meta_keyword" rows="3" cols="50" class="form-control" placeholder="Meta Tag Keywords"><?= $meta_keywords ?></textarea>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="info_status" class="col-sm-3 col-form-label text-right">Status:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="info_status">
                                        <option <?= ($status == 1 ? "selected" : "") ?> value="1">Enable</option>
                                        <option <?= ($status == 0 ? "selected" : "") ?> value="0">Disabled</option>
                                    </select>
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

    <!-- Summernote -->
    <script src="vendor/summernote/summernote-lite.min.js"></script>

    <script src="script/information.js"></script>
</body>