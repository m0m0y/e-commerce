function delete_orders(order_id) {
    var email = $('#email').val();
    var ses_group_id = $('#ses_group_id').val();

    $.ajax({
        url: 'controller/base.controller.php?delete_order',
        method: 'POST',
        data: {
            email:email,
            ses_group_id:ses_group_id,
            order_id:order_id
        },
        success:function() {
            window.location.reload();
        }
    });
}