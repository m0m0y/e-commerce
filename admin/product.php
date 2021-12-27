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

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-list"></i> Product List</h6>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <?php $class->select_product(); ?>
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
                                                <label for="product_name" class="col-sm-3 col-form-label text-right">* Product Name:</label>
                                                <div class="col-sm-9">
                                                    <input type="text" id="product_name" class="form-control" name="product_name" placeholder="Product Name">
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="description" class="col-sm-3 col-form-label text-right">Description:</label>
                                                <div class="col-sm-9">
                                                    <textarea id="description" name="description" rows="4" cols="50" class="form-control" placeholder="Description"></textarea>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="meta_tag_title" class="col-sm-3 col-form-label text-right">* Meta Tag Title:</label>
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

                                            <div class="row mb-4">
                                                <label for="price" class="col-sm-3 col-form-label text-right">* Price:</label>
                                                <div class="col-sm-9">
                                                    <input type="number" id="price" class="form-control" name="price" placeholder="Price">
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="quantity" class="col-sm-3 col-form-label text-right">* Quantity:</label>
                                                <div class="col-sm-9">
                                                    <input type="number" id="quantity" class="form-control" name="quantity" placeholder="Quantity">
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="stock_status" class="col-sm-3 col-form-label text-right">Stock Status:</label>
                                                <div class="col-sm-9">
                                                    <select name="stock_status" class="form-control" id="stock_status">
                                                        <?php $class->get_stock_status_id(); ?>
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
                                                        <?php $class->get_weight_description(); ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="email" class="col-sm-3 col-form-label text-right">Status:</label>
                                                <div class="col-sm-9">
                                                    <select name="product_status" class="form-control" id="product_status">
                                                        <option id="product_status_val" value="1">Enable</option>
                                                        <option id="product_status_val" value="0">Disabled</option>
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
                <?php include "assets/common/footer.php"; ?>
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

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/chart-area-demo.js"></script>
    <script src="assets/js/demo/chart-pie-demo.js"></script>

    <script>
        function add_product() {
            window.location.href="add_product";
        }

        function update_product(product_id, name, quantity, price, product_status, description, meta_title, meta_description, meta_keywords, stock_status_id, product_weight, weight_id) {
            $('#close').click(function(){
                window.location.reload();
            });

            $('#Mymodal').modal('show');
            $('.title-container').html('<i class="fas fa-pencil-alt"></i> Update Product');
            $('.save-btn').attr("id", "update");

            $('#product_name').val(name);
            $('#description').val(description);
            $('#meta_tag_title').val(meta_title);
            $('#meta_tag_description').val(meta_description);
            $('#meta_tag_keywords').val(meta_keywords);
            $('#price').val(number_format(price, '2'));
            $('#quantity').val(quantity);
            $('#stock_status').val(stock_status_id);
            $('#weight').val(product_weight);
            $('#weight_class').val(weight_id);

            if (product_status == "Enable") {
                $('#product_status').val(1);
            } else if (product_status == "Disabled") {
                $('#product_status').val(0);
            }

            $('#update').on('click', function(){
                var alert_message = $('#alertMessage').val();

                var product_name = $('#product_name').val();
                var product_desc = $('#description').val();
                var meta_tag_title = $('#meta_tag_title').val();
                var meta_tag_description = $('#meta_tag_description').val();
                var meta_tag_keywords = $('#meta_tag_keywords').val();
                var price = $('#price').val();
                var quantity = $('#quantity').val();
                var stock_status = $('#stock_status').val();
                var product_weight = $('#weight').val();
                var weight_class = $('#weight_class').val();
                var product_status = $('#product_status').val();

                if (product_name == "" || price == "" || quantity == "" || meta_tag_title == "" || weight == "") {
                    alert_message = "Please fill up the form correctly!";
                    $('#alertMessage').text(alert_message).addClass("alert alert-danger");
                } else {
                    $.ajax({
                        url: 'controller/function.php?update_product',
                        method: 'POST',
                        data: {
                            product_id:product_id,
                            product_name:product_name,
                            product_desc:product_desc,
                            meta_tag_title:meta_tag_title,
                            meta_tag_description:meta_tag_description,
                            meta_tag_keywords:meta_tag_keywords,
                            price:price,
                            quantity:quantity,
                            stock_status:stock_status,
                            product_weight:product_weight,
                            weight_class:weight_class,
                            product_status:product_status
                        },
                        success:function(){
                            window.location.reload();
                        }
                    });
                }
            });
        }

        function delete_products(product_id) {
            $.ajax({
                url: 'controller/function.php?delete_product',
                method: 'POST',
                data: {
                    product_id:product_id
                },
                success:function(){
                    window.location.reload();
                }
            });
        }
    </script>

</body>
