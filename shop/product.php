<?php
// For displaying the page title only
function page_title() {
    $page_title = "Your Shop - Categories";
    echo $page_title;
}
require "assets/common/header.php";
$product_id = $_GET["product_id"];

$category_id = $class->get_product_category("category_id", $product_id);
$category_name = $class->get_category_description("category_name", $category_id);

$product_name = $class->get_product_description("product_name", $product_id);
$store = $class->get_product_description("store", $product_id);
$product_desc = $class->get_product_description("product_desc", $product_id);
$price = $class->get_product("price", $product_id);
$product_status = $class->get_product("product_status", $product_id);
$manufacturer_id = $class->get_product("manufacturer_id", $product_id);
$stock_status_id = $class->get_product("stock_status_id", $product_id);

$manufacturer = $class->get_product_manufacturer("name", $manufacturer_id);
$stock_status = $class->get_product_stock_status("name", $stock_status_id);

if ($product_desc == "" || $product_desc == NULL) {
    $product_desc .= "No Available description.";
}

if ($product_status == 0) { 
    require "404.php";
}
?>

<body>
    <!-- Navbar -->
    <?php require "assets/common/navbar.php"; ?>

    <section class="mt-5 container">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="margin: 0;">
                    <!-- Check if the product has category -->
                    <?php if ($category_name == "") { ?>
                        <li class="breadcrumb-item active"><i class="fa fa-home" aria-hidden="true"></i></li>
                        <li class="breadcrumb-item"><?= $product_name; ?></li>
                    <?php } else { ?>
                        <li class="breadcrumb-item active"><i class="fa fa-home" aria-hidden="true"></i></li>
                        <li class="breadcrumb-item"><?= $category_name; ?></li>
                        <li class="breadcrumb-item"><?= $product_name; ?></li>
                    <?php } ?>
                </ol>
            </nav> 
        </div>

        <div class="container row">
            <div class="col-sm-12 col-md-7">
                <div class="container">
                    <img src="assets/images/products/shopping-bag-icon4.png" class="product-icon" alt="img" width="80%">
                </div>
            </div>
            <div class="col-sm-12 col-md-5">
                <div class="container">
                    <ul class="list-unstyled">
                        <li><h3><?= $product_name ?></h3></li>
                        <li><small>Store: <?= $store == "" ? "N/A" : "$store" ?></small></li>
                        <li><small>Manufacturer/Brand: <?= $manufacturer == "" ? "N/A" : "$manufacturer" ?></small></li>
                        <li><small>Product ID: <?= $product_id == "" ? "N/A" : "$product_id" ?></small></li>
                        <li><small>Availability: <?= $stock_status == "" ? "N/A" : "$stock_status" ?></small></li>
                        </br>
                        <li><h4>₱ <?= number_format($price, 2) ?></h4></li>
                        <hr></hr>
                        <li><p>Quantity:</p></li>
                        <li><input type="number" name="quantity" min="0" value="1" size="2" id="quantity" class="form-control"></li>
                        </br>
                        <li>
                            <div class="d-grid gap-2">
                                <?php 
                                if (isset($_SESSION["customer_id"])){
                                    $customer_id = $_SESSION["customer_id"];        
                                    echo '
                                        <button type="button" class="btn btn-primary" onclick="add_to_cart(\'' . $customer_id . '\',\'' . $product_id . '\')"><i class="fa fa-shopping-cart"></i> ADD TO CART</button>

                                        <button type="button" class="btn btn-secondary" onclick="add_to_wishlist(\'' . $product_id . '\',\'' . $customer_id . '\')"><i class="fa fa-heart"></i> ADD TO WISHLIST</button>
                                    ';
                                } else {
                                    $customer_id = "";
                                    echo '
                                        <button type="button" class="btn btn-primary" onclick="add_to_cart(\'' . $customer_id . '\',\'' . $product_id . '\')"><i class="fa fa-shopping-cart"></i> ADD TO CART</button>
                                        
                                        <button type="button" class="btn btn-secondary" onclick="alert_to_login()"><i class="fa fa-heart"></i> ADD TO WISHLIST</button>
                                    ';
                                }
                                ?>

                                 <!-- Alert modal for wishlist -->
                                <div class="modal fade modal-alert" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Alert message</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="alert" role="alert"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container">
            <!-- Tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <button class="nav-link tab_button active" onclick="openTabs(event, 'Description')">Description</button>
                </li>
                <!-- <li class="nav-item">
                    <button class="nav-link tab_button" onclick="openTabs(event, 'Review')">Review</button>
                </li> -->
            </ul>

            <!-- Contents -->
            <div id="Description" class="tabcontent" style="display: flex; flex-direction: column;">
                <div class="container">
                    <p class="mt-4"><?= $product_desc ?></p>
                </div>
            </div>

            <!-- <div id="Review" class="tabcontent" style="display: flex; flex-direction: column;"> -->
        
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require "assets/common/footer.php"; ?>

    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                items: 1,
                margin: 10,
                autoHeight: true,
                autoplay: true,
                loop: true
            });
        });

        function openTabs(event, tabName) {
            var c, tabcontent, tab_button;

            tabcontent = document.getElementsByClassName("tabcontent");
            for (c = 0; c < tabcontent.length; c++) {
            tabcontent[c].style.display = "none";
            }

            tab_button = document.getElementsByClassName("tab_button");
            for (c = 0; c < tab_button.length; c++) {
            tab_button[c].className = tab_button[c].className.replace(" active", "");
            }

            document.getElementById(tabName).style.display = "block";
            event.currentTarget.className += " active";
        }

        function alert_to_login() {
            $('.modal-alert').modal('show');

            var alert_message = $('#alert').val();
            alert_message = 'You must <b>login</b> or <b>create an account</b> to add product into your wishlist!';
            $('#alert').html(alert_message).addClass("alert alert-danger mb-3");
        }

        function add_to_cart(customer_id, product_id) {
            var quantity = $('#quantity').val();

            if (quantity <= 0) {
                $('#quantity').addClass("is-invalid");
            } else {
                $.ajax({
                    url: 'controller/cart.controller.php?add_cart',
                    method: 'POST',
                    data: {
                        customer_id:customer_id,
                        product_id:product_id,
                        quantity:quantity
                    },
                    success:function(){
                        window.location.reload();
                    }
                });
            }
        }

        function add_to_wishlist(product_id, customer_id) {
            var alert_message = $('#alert').val();

            $.ajax({
                url: 'controller/wishlist.controller.php?add_wishlist',
                method: 'POST',
                data: {
                    customer_id:customer_id,
                    product_id:product_id
                },
                success:function(response) {
                    if(response == "New record created successfully"){
                        window.location.href="wishlist";
                    } else if (response == "Record is existing") {
                        $('.modal-alert').modal('show');

                        alert_message = 'You <b>already added</b> this product to your wishlist!';
                        $('#alert').html(alert_message).addClass("alert alert-success mb-3");
                    }
                }
            });
        }
    </script>
</body>