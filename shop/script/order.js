$(document).ready(function(){
    $('#dataTable').DataTable();
});

function cancel(order_id) {
    $('.modal-alert').modal('show');

    alert_message = "<b>Cancel Order!</b> Are you sure to cancel your order/s?";
    $('#alert').html(alert_message).addClass("alert alert-warning mb-3");

    $('#proceed').show().click(function(){
         $.ajax({
            url: 'controller/order.controller.php?cancel_order',
            method: 'POST',
            data: {
                order_id:order_id
            },
            success: function(){
                window.location.href = 'order_history';
            }
        });
    });
}

function add_to_cart(customer_id, product_id, quantity) {
    $.ajax({
        url: 'controller/cart.controller.php?add_cart',
        method: 'POST',
        data: {
            customer_id:customer_id,
            product_id:product_id,
            quantity:quantity
        },
        success:function(){
            window.location.href = 'cart'; 
        }
    });
}