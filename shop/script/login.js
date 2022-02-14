$(document).ready(function(){
    $('#submit').on("click", function(){
        var customer_email = $('#customer_email').val();
        var customer_password = $('#customer_password').val();

        if(customer_email == "" || customer_password == "") {
            $('.modal-alert').modal('show');
            $('#note').hide();
            $('#forgotPass_container').hide();
            $('#successAlert').hide();
            $('#proceed').hide();

            alert_message = "<b>Error login:</b> Invalid email address and password!";
            $('#alert').html(alert_message).addClass("alert alert-danger mb-3").show();
        } else {
            $.ajax({
                url: 'controller/login.controller.php?get_customer',
                method: 'POST',
                data: {
                    customer_email:customer_email,
                    customer_password:customer_password
                },
                success: function(response) {
                    if (response == "success") {
                        $('.modal-alert').modal('show');
                        $('#note').hide();
                        $('#forgotPass_container').hide();
                        $('#alert').hide();
                        $('#close').hide();

                        $('#proceed').show().click(function(){
                            window.location.replace("myaccount");
                        });

                        alert_message = "<b>Successfully logged-in!</b> Please click proceed";
                        $('#successAlert').html(alert_message).addClass("alert alert-success mb-3").show();
                    } else if (response == "invalid") {
                        $('.modal-alert').modal('show');
                        $('#note').hide();
                        $('#forgotPass_container').hide();
                        $('#successAlert').hide();
                        $('#proceed').hide();

                        alert_message = '<b>Error login:</b>  No match for Email Address and Password!';
                        $('#alert').html(alert_message).addClass("alert alert-danger mb-3").show();
                    }
                }
            });
        }
    });
});

function forgot_password() {
    $('.modal-alert').modal('show');
    $('#successAlert').hide();
    $('#alert').hide();
    
    $('#note').text('Enter the e-mail address associated with your account. Click proceed to have a password reset link e-mailed to you.').show();
    $('#forgotPass_container').show();

    $('#proceed').show().click(function(){
        var customer_email = $('#email_add').val();
        
        if(customer_email == "") {
            $('#email_add').addClass('is-invalid')
        }  else {
            $.ajax({
                url: 'controller/login.controller.php?forgot_pass',
                method: 'POST',
                data: {
                    customer_email:customer_email
                },
                success: function(){
                    window.location.replace("login");
                }
            });
        }
    });
}