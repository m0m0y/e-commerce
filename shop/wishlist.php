<?php
require "controller/header.controller.php";
require "assets/common/header.php";
?>

<body>
    <!-- Navbar -->
    <?php require "assets/common/navbar.php"; ?>

    <section class="mt-5 container">
        <div class="mb-5 container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="margin: 0;">
                    <li class="breadcrumb-item active"><i class="fa fa-home" aria-hidden="true"></i></li>
                    <li class="breadcrumb-item">Account</li>
                    <li class="breadcrumb-item">My Wishlist</li>
                </ol>
            </nav>
        </div>
        
        <div class="mb-5 container"> 
            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <h4>My Wishlist</h4>
                    <?php $class->get_customer_wishlist($customer_id); ?>
                </div>

                <div class="col-sm-12 col-md-4 side-menu">
                    <!-- Side Menu -->
                    <?php require "assets/common/sidemenu.php"; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require "assets/common/footer.php"; ?>
    
    <script>
        $(document).ready(function(){
            $('#dataTable').DataTable();
        });

        function add_to_cart(customer_id, product_id) {
            var quantity = 1;

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

        function remove_wishlist(product_id) {
            $.ajax({
                url: 'controller/wishlist.controller.php?delete_wishlist',
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