$(document).ready(function(){
    var over_all_total = 0;
    $('td[data-id]').map(function() {
        over_all_total += parseFloat($(this).find('span').text());
    });

    $('#sub-total').html('₱ '+over_all_total+'.00');
    $('#vat').html('₱ 0.00');
    $('#total-price').html('₱ '+over_all_total+'.00');

    $('#back').on('click', function(){
        window.location.href="checkout";
    });

    $('#subtotal').val(over_all_total);
    $('#tax').val('0');
    $('#total').val(over_all_total);
    
    $('#confirm_order').on('click', function(){
        var customer_id = $('#customer_id').val();
        var customer_firstname = $('#customer_firstname').val();
        var customer_lastname = $('#customer_lastname').val();
        var customer_email = $('#customer_email').val();
        var customer_telephone = $('#customer_telephone').val();

        var address_1 = $('#address_1').val();
        var address_2 = $('#address_2').val();
        var city = $('#city').val();
        var postcode = $('#postcode').val();
        var region = $('#region').val();

        var pick_up_date = $('#pick_up_date').val();
        var payment_option = $('#payment_option').val();
        var comment = $('#comment').val();

        var subtotal = $('#subtotal').val();
        var tax = $('#tax').val();
        var total = $('#total').val();

        $.ajax({
            url: 'controller/order.controller.php?add_order',
            method: 'POST',
            data: {
                customer_id:customer_id,
                customer_firstname:customer_firstname,
                customer_lastname:customer_lastname,
                customer_email:customer_email,
                customer_telephone:customer_telephone,
                address_1:address_1,
                address_2:address_2,
                city:city,
                postcode:postcode,
                region:region,
                pick_up_date:pick_up_date,
                payment_option:payment_option,
                over_all_total:over_all_total,
                comment:comment,
                subtotal:subtotal,
                tax:tax,
                total:total
            },
            success:function() {
                window.location.replace("order_history");
            }
        });
    });
});