<?php
// For displaying the page title only
function page_title() {
    $page_title = "Your Shop - Categories";
    echo $page_title;
}
require "assets/common/header.php";
$category_id = $_GET["category_id"];

$category_status = $class->get_categories_status("category_status", $category_id);

if ($category_status == 0) {
    require "404.php";
}
?>

<body>
    <!-- Navbar -->
    <?php require "assets/common/navbar.php"; ?>

    <!-- Product Content  -->
    <section class="mt-5 container">
        <div class="row">
            <div class="col-sm-12 col-md-4 side-menu">
                <div class="menu"> 
                    <ul class="list-group">
                        <?php $class->side_categories(); ?>
                    </ul>
                </div>
            </div>

            <div class="col-sm-12 col-md-8">
                <h4 class="title"><?= $class->get_category_description("category_name", $category_id); ?></h4>
                <h5 class="mb-4"><?= $class->get_category_description("description", $category_id); ?></h5>
                <div class="row">
                    <?php $class->get_product_to_category($category_id); ?>
                </div>
            </div>
        </div>

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
    </section>

    <!-- Footer -->
    <?php require "assets/common/footer.php"; ?>

    <script>
        function alert_to_login() {
            $('.modal-alert').modal('show');

            var alert_message = $('#alert').val();
            alert_message = 'You must <b>login</b> or <b>create an account</b> to add product into your wishlist!';
            $('#alert').html(alert_message).addClass("alert alert-danger mb-3");
        }

        function add_to_cart(customer_id, product_id, quantity) {
            // alert(customer_id);
            $.ajax({
                url: 'controller/cart.controller.php?add_cart',
                method: 'POST',
                data: {
                    customer_id:customer_id,
                    product_id:product_id,
                    quantity:quantity
                },
                success:function(){
                    // window.location.reload();
                }
            });
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

