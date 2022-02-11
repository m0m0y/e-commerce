<?php 
require "assets/common/header.php";
$manufacturer_id = "";
$category_id = "";
$stock_status_id = "";
$weight_id = "";
?>

<body id="page-top">
    <div id="wrapper">
      <?php require "assets/common/sidenav.php"; ?>

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <?php require "assets/common/top-navbar.php"; ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <?php require "assets/common/page-heading.php"; ?>
          </div>

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-pencil-alt"></i> Add Product</h6>
            </div>

            <div class="card-body">

              <div id="alertMessage"></div>

              <div align="right" style="margin-bottom:5px;">
                <button type="button" id="save" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Save</button>
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

              </br>

              <!-- Contents -->
              <div id="General" class="tabcontent" style="display: flex; flex-direction: column;">

                <div class="row mb-4">
                  <label for="product_name" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Product Name:</label>
                  <div class="col-sm-9">
                    <input type="hidden" id="email" class="form-control" value="<?= $email ?>" readonly/>
                    <input type="hidden" id="ses_group_id" class="form-control" value="<?= $user_group ?>" readonly/>
                    <input type="text" id="product_name" class="form-control" name="product_name" placeholder="Product Name">
                  </div>
                </div>

                <div class="row mb-4">
                  <label for="description" class="col-sm-3 col-form-label text-right">Description:</label>
                  <div class="col-sm-9">
                    <!-- <textarea id="description" name="description" rows="4" cols="50" class="form-control" placeholder="Description"></textarea> -->
                    <textarea name="description" id="description" class="form-control" rows="5"></textarea>
                  </div>
                </div>

                <div class="row mb-4">
                  <label for="meta_tag_title" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Meta Tag Title:</label>
                  <div class="col-sm-9">
                    <input type="text" id="meta_tag_title" class="form-control" name="meta_tag_title" placeholder="Meta Tag Title">
                  </div>
                </div>

                <div class="row mb-4">
                  <label for="meta_tag_description" class="col-sm-3 col-form-label text-right">Meta Tag Description:</label>
                  <div class="col-sm-9">
                    <textarea id="meta_tag_description" name="meta_tag_description" rows="4" cols="50" class="form-control" placeholder="Meta Tag Description"></textarea>
                  </div>
                </div>

                <div class="row mb-4">
                  <label for="meta_tag_keywords" class="col-sm-3 col-form-label text-right">Meta Tag Keywords:</label>
                  <div class="col-sm-9">
                    <textarea id="meta_tag_keywords" name="meta_tag_keywords" rows="3" cols="50" class="form-control" placeholder="Meta Tag Keywords"></textarea>
                  </div>
                </div>
              </div>

              <div id="Data" class="tabcontent">

                <div class="row mb-4">
                    <label for="stock_status" class="col-sm-3 col-form-label text-right">Manufacturer:</label>
                    <div class="col-sm-9">
                      <select class="form-control" id="manufacturer_id">
                      <option value="" selected disabled>Select Manufacturer</option>
                      <?php $class->get_manufacturer_value($manufacturer_id); ?>
                      </select>
                    </div>
                </div>

                <div class="row mb-4">
                    <label for="product_category" class="col-sm-3 col-form-label text-right">Categories:</label>
                    <div class="col-sm-9">
                      <select class="form-control" id="product_category">
                        <option value="" selected disabled>Select Categories</option>
                        <?php $class->get_category_description($category_id); ?>
                      </select>
                    </div>
                </div>

                <div class="row mb-4">
                  <label for="price" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Price:</label>
                  <div class="col-sm-9">
                    <input type="number" id="price" class="form-control" name="price" placeholder="Price">
                  </div>
                </div>

                <div class="row mb-4">
                  <label for="quantity" class="col-sm-3 col-form-label text-right"><span class="required">*</span> Quantity:</label>
                  <div class="col-sm-9">
                    <input type="number" id="quantity" class="form-control" name="quantity" placeholder="Quantity">
                  </div>
                </div>

                <div class="row mb-4">
                  <label for="stock_status" class="col-sm-3 col-form-label text-right">Stock Status:</label>
                  <div class="col-sm-9">
                    <select name="stock_status" class="form-control" id="stock_status">
                      <?php $class->get_stock_status_id($stock_status_id); ?>
                    </select>
                  </div>
                </div>

                <div class="row mb-4">
                  <label for="weight" class="col-sm-3 col-form-label text-right">Weight:</label>
                  <div class="col-sm-9">
                    <input type="number" id="weight" class="form-control" name="weight" placeholder="Weight">
                  </div>
                </div>

                <div class="row mb-4">
                  <label for="weight_class" class="col-sm-3 col-form-label text-right">Weight Class:</label>
                  <div class="col-sm-9">
                    <select name="weight_class" class="form-control" id="weight_class">
                      <?php $class->get_weight_description($weight_id); ?>
                    </select>
                  </div>
                </div>

                <div class="row mb-4">
                  <label for="product_status" class="col-sm-3 col-form-label text-right">Status:</label>
                  <div class="col-sm-9">
                    <select name="product_status" class="form-control" id="product_status">
                      <option value="1">Enable</option>
                      <option value="0">Disabled</option>
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

    <!-- Summernote -->
    <script src="vendor/summernote/summernote-lite.min.js"></script>

    <script src="script/product.js"></script>
</body>