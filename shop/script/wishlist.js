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