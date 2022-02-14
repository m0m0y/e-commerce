$(document).ready(function(){
    $('#back').on('click', function(){
        window.location.href="myaccount";
    });

    $('#submit').on('click', function(){
        var alert_message = $('#alert').val();
        var customer_id = $('#customer_id').val();
        var address_1 = $('#address_1').val();
        var address_2 = $('#address_2').val();
        var city = $('#city').val();
        var postcode = $('#postcode').val();
        var region = $('#region').val();
        
        if (address_1 == "" || city == "" || postcode == "" || region == "") {
            alert_message = "Invalid data: Please check the required fields!";
            $('#alert').text(alert_message).addClass("alert alert-danger mb-3");
        } else {
            $.ajax({
                url: 'controller/update_account.controller.php?update_customer_address',
                method: 'POST',
                data: {
                    customer_id:customer_id,
                    address_1:address_1,
                    address_2:address_2,
                    city:city,
                    postcode:postcode,
                    region:region
                },
                success:function(){
                    window.location.reload();
                }
            });
        }
    });
});