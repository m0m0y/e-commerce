$(document).ready(function(){
    $('#dataTable').DataTable();
    
    var over_all_total = 0;

    $('td[data-id]').map(function() {
        over_all_total += parseFloat($(this).find('span').text());
    });

    $('#sub-total').html('₱ '+over_all_total+'.00');
    $('#vat').html('₱ 0.00');
    $('#total-price').html('₱ '+over_all_total+'.00');
    
    var cart_numrows = $('#cart_numrows').val();

    $('#continue-shopping').on('click', function(){
        window.location.href="home";
    });

    if (cart_numrows != 0) {
        $('#checkout').css("display", "flex");

        $('#checkout').on('click', function(){
            window.location.href="checkout";
        });
    }
});

function update_quantity(cart_id) {
    var quantity = $('#quantity'+cart_id).val();
    
    if (quantity <= 0) {
        $('#quantity'+cart_id).addClass("is-invalid");
    } else {
        $.ajax({
            url: 'controller/cart.controller.php?update_cart_quantity',
            method: 'POST',
            data: {
                cart_id:cart_id,
                quantity:quantity
            },
            success:function() {
                window.location.reload();
            }
        });
    }
}

function remove_product(cart_id) {
    $.ajax({
        url: 'controller/cart.controller.php?delete_customer_cart',
        method: 'POST',
        data: {
            cart_id:cart_id
        },
        success:function() {
            window.location.reload();
        }
    });
}