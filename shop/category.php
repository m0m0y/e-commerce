<?php
// For displaying the page title only
function page_title() {
    $page_title = "Your Shop - Categories";
    echo $page_title;
}
require_once  "assets/common/header.php";
$product_id = $_GET["id"];
?>

<body>
    <!-- Navbar -->
    <?php require_once  "assets/common/navbar.php"; ?>

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
                <div id="alert" role="alert"></div>

                <h4 class="title"><?php echo $class->get_product_desc("category_name", $product_id); ?></h4>
                <h5 class="mb-4"><?php echo $class->get_product_desc("description", $product_id); ?></h5>
                <div class="row">
                    <?php $class->get_product_to_category($product_id); ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require_once  "assets/common/footer.php"; ?>

    <script>
        function alert_to_login() {
            var alert_message = $('#alert').val();

            alert_message = 'You must <b>login</b> or <b>create an account</b> to add product into your wishlist!';
            $('#alert').html(alert_message).addClass("alert alert-danger mb-3");
        }

        function add_to_cart(customer_id, product_id, quantity) {
            $.ajax({
                url: 'controller/cart.controller.php?addToCart',
                method: 'POST',
                data: {
                    customer_id:customer_id,
                    product_id:product_id,
                    quantity:product_id
                },
                success:function(){
                    window.location.reload();
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
                        alert_message = '<b>Success</b> You have added product to your wishlist!';
                        $('#alert').html(alert_message).addClass("alert alert-success mb-3");
                    } else if (response == "Error") {
                        alert_message = 'You <b>already added</b> this product to your wishlist!';
                        $('#alert').html(alert_message).addClass("alert alert-success mb-3");
                    }
                }
            });
        }
    </script>
</body>

