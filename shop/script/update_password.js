$(document).ready(function(){
    $('#back').on('click', function(){
        window.location.href="myaccount";
    });

    $('#submit').on('click', function(){
        var alert_message = $('#alert').val();
        var customer_id = $('#customer_id').val();
        var password = $('#customer_password').val();
        var confirm_pass = $('#confirm_password').val();

        if (customer_id == "" || password == "" || confirm_pass == "") {
            alert_message = "Please check the required fields!";
            $('#alert').text(alert_message).addClass("alert alert-danger mb-3");
        } else if (password != confirm_pass) {
            alert_message = "Your Password did not match!";
            $('#alert').text(alert_message).addClass("alert alert-danger mb-3");
        } else {
            $.ajax({
                url: 'controller/update_account.controller.php?update_customer_password',
                method: 'POST',
                data: {
                    customer_id:customer_id,
                    password:password
                },
                success:function(){
                    window.location.reload();
                }
            });
        }
    });

    $('#submit').click(function(){
        var customer_email = $('#customer_email').val();
        var customer_password = $('#customer_password').val();
        var confirm_password = $('#confirm_password').val();
    
        if (customer_email == "" || customer_password == "" || confirm_password == "") {
            $('.modal-alert').modal('show');
            $('#proceed').hide();

            alert_message = "<b>Error!</b> Please Fill up the required fields";
            $('#alert').html(alert_message).addClass("alert alert-danger mb-3").show();
        } else if(customer_password != confirm_password) {
            $('.modal-alert').modal('show');
            $('#proceed').hide();

            alert_message = "<b>Error!</b> The password you enter didn't match, please try again";
            $('#alert').html(alert_message).addClass("alert alert-danger mb-3").show();
        }
        else {
            $('.modal-alert').modal('show');
            $('#proceed').show();
            $('#alert').hide();
            $('#close').hide();

            alert_message = "<b>Your password has change!</b> Please click proceed to login.";
            $('#successAlert').html(alert_message).addClass("alert alert-success mb-3");

            $('#proceed').on('click', function(){
                $.ajax({
                    url: 'controller/update_account.controller.php?reset_password',
                    method: 'POST',
                    data: {
                        customer_email:customer_email,
                        customer_password:customer_password,
                        confirm_password:confirm_password
                    },
                    success: function() {
                        window.location.replace("login");
                    }
                });
            });
        }
    });
});