$(document).ready(function(){
    $('#back').on('click', function(){
        window.location.href="myaccount";
    });

    $('#submit').on('click', function(){
        var alert_message = $('#alert').val();
        var customer_id = $('#customer_id').val();
        var firstname = $('#customer_firstname').val();
        var lastname = $('#customer_lastname').val();
        var email = $('#customer_email').val();
        var telephone = $('#customer_telephone').val();

        if (customer_id == "" || firstname == "" || lastname == "" || email == "" || telephone == "") {
            alert_message = "Invalid data: Please check the required fields!";
            $('#alert').text(alert_message).addClass("alert alert-danger mb-3");
        } else {
            $.ajax({
                url: 'controller/update_account.controller.php?update_customer',
                method: 'POST',
                data: {
                    customer_id:customer_id,
                    firstname:firstname,
                    lastname:lastname,
                    email:email,
                    telephone:telephone
                },
                success:function(){
                    window.location.reload();
                }
            });
        }
    });
});