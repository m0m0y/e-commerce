<?php 
require "assets/common/header.php";

$get_product_id = $_GET["product_id"];
$product_name = $class->get_product_info("product_name", "product_description", $get_product_id);
$store = $class->get_product_info("store", "product_description", $get_product_id);
$product_desc = $class->get_product_info("product_desc", "product_description", $get_product_id);
$meta_title = $class->get_product_info("meta_title", "product_description", $get_product_id);
$meta_descriptiom = $class->get_product_info("meta_description", "product_description", $get_product_id);
$meta_keywords = $class->get_product_info("meta_keywords", "product_description", $get_product_id);

$quantity = $class->get_product_info("quantity", "product", $get_product_id);
$stock_status_id = $class->get_product_info("stock_status_id", "product", $get_product_id);
$manufacturer_id = $class->get_product_info("manufacturer_id", "product", $get_product_id);
$price = $class->get_product_info("price", "product", $get_product_id);
$product_weight = $class->get_product_info("product_weight", "product", $get_product_id);
$weight_id = $class->get_product_info("weight_id", "product", $get_product_id);
$product_status = $class->get_product_info("product_status", "product", $get_product_id);

$category_id = $class->get_product_info("category_id", "product_to_category", $get_product_id);
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
                        <h1 class="h3 mb-0 text-gray-800">Products</h1>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-pencil-alt"></i> Update Product</h6>
                        </div>

                        <div class="card-body">

                            <div id="alertMessage"></div>

                            <div align="right" style="margin-bottom:5px;">
                                <button type="button" id="update" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Save</button>
                                <a href="product" class="btn btn-sm btn-secondary btn-user"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
                            </div>

                            <!-- Tabs -->
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <button class="nav-link tab_button active" onclick="openTabs(event, 'General')">General</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link tab_button" onclick="openTabs(event, 'Data')">Data</button>
                                </li>
                            </ul>

                            <!-- Contents -->
                            <div id="General" class="tabcontent mt-3" style="display: flex; flex-direction: column;">
                                <div class="row mb-4">
                                    <label for="product_name" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Product Name:</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" id="email" class="form-control" value="<?= $email ?>" readonly/>
                                        <input type="hidden" id="ses_group_id" class="form-control" value="<?= $user_group ?>" readonly/>
                                        <input type="hidden" id="product_id" class="form-control" value="<?= $get_product_id ?>" readonly/>
                                        <input type="text" id="product_name" class="form-control" value="<?= $product_name ?>" placeholder="Product Name">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="store" class="col-sm-3 col-form-label text-right">Store:</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="store" class="form-control" value="<?= $store ?>" placeholder="Store"/>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="description" class="col-sm-3 col-form-label text-right">Description:</label>
                                    <div class="col-sm-9">
                                        <textarea name="description" id="description" class="form-control"><?= $product_desc ?></textarea>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="meta_tag_title" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Meta Tag Title:</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="meta_tag_title" class="form-control"  value="<?= $meta_title ?>" placeholder="Meta Tag Title">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="meta_tag_description" class="col-sm-3 col-form-label text-right">Meta Tag Description:</label>
                                    <div class="col-sm-9">
                                        <textarea id="meta_tag_description" rows="4" cols="50" class="form-control" placeholder="Meta Tag Description"><?= $meta_descriptiom ?></textarea>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="meta_tag_keywords" class="col-sm-3 col-form-label text-right">Meta Tag Keywords:</label>
                                    <div class="col-sm-9">
                                        <textarea id="meta_tag_keywords" rows="3" cols="50" class="form-control" placeholder="Meta Tag Keywords"><?= $meta_keywords ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div id="Data" class="tabcontent mt-3">
                                <div class="row mb-4">
                                <label for="price" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Price:</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">₱</span>
                                            <input type="number" id="price" class="form-control"  value="<?= number_format($price, 2) ?>" placeholder="Price">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="quantity" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Quantity:</label>
                                    <div class="col-sm-9">
                                        <input type="number" id="quantity" class="form-control"  value="<?= $quantity ?>" placeholder="Quantity">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="stock_status" class="col-sm-3 col-form-label text-right">Stock Status:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="stock_status">
                                            <?php $class->get_stock_status_id($stock_status_id); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="weight" class="col-sm-3 col-form-label text-right">Weight:</label>
                                    <div class="col-sm-9">
                                        <input type="number" id="weight" class="form-control" value="<?= $product_weight  ?>" placeholder="Weight">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="weight_class" class="col-sm-3 col-form-label text-right">Weight Class:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="weight_class">
                                            <?php $class->get_weight_description($weight_id); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="product_status" class="col-sm-3 col-form-label text-right">Status:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="product_status">
                                            <option <?= ($product_status == 1 ? "selected" : "") ?> value="1">Enable</option>
                                            <option <?= ($product_status == 0 ? "selected" : "") ?> value="0">Disabled</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="manufacturer_id" class="col-sm-3 col-form-label text-right">Manufacturer:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="manufacturer_id">
                                            <?php $class->get_manufacturer_value($manufacturer_id); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="product_category" class="col-sm-3 col-form-label text-right">Categories:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="product_category">
                                            <?php $class->get_category_description($category_id); ?>
                                        </select>
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
    <script src="vendor/summernote/summernote-lite.min.js"></script>

    <script src="script/product.js"></script>

</body>