$(document).ready(function(){
    $('#submit').on("click", function(){
        var customer_firstname = $('#customer_firstname').val();
        var customer_lastname = $('#customer_lastname').val();
        var customer_email = $('#customer_email').val();
        var customer_telophone = $('#customer_telophone').val();
        var customer_password = $('#customer_password').val();
        var confirm_password = $('#confirm_password').val();

        var address_1 = $('#address_1').val();
        var address_2 = $('#address_2').val();
        var city = $('#city').val();
        var postcode = $('#postcode').val();
        var region = $('#region').val();

        if (customer_password != confirm_password){
            $('.modal-alert').modal('show');
            $('#proceed').hide();

            alert_message = "<b>Your Password did not match!</b>";
            $('#alert').html(alert_message).addClass("alert alert-danger mb-3");
        } 
        
        else if(customer_firstname == "" || customer_lastname == "" || customer_email == "" || customer_telophone == "" || customer_password == "" || confirm_password == "" || address_1 == "" || city == "" || postcode == "" || region == "") {
            $('.modal-alert').modal('show');
            $('#proceed').hide();

            alert_message = "<b>Please double check the fields</b>";
            $('#alert').html(alert_message).addClass("alert alert-danger mb-3");
        }
        
        else {
            $.ajax({
                url: 'controller/register.controller.php?registration',
                method: 'POST',
                data: {
                    customer_firstname:customer_firstname,
                    customer_lastname:customer_lastname,
                    customer_email:customer_email,
                    customer_telophone:customer_telophone,
                    customer_password:customer_password,
                    address_1:address_1,
                    address_2:address_2,
                    city:city,
                    postcode:postcode,
                    region:region
                },
                success: function(response) {
                    if (response == "existing email"){
                        $('.modal-alert').modal('show');
                        $('#proceed').hide();

                        alert_message = "Your <b>email is already registered!</b>";
                        $('#alert').html(alert_message).addClass("alert alert-danger mb-3");
                    } else if (response == "success") {
                        $('.modal-alert').modal('show');
                        $('#alert').hide();
                        $('#close').hide();

                        $('#proceed').show().click(function(){
                            window.location.replace("myaccount");
                        });

                        alert_message = "<b>You are now registered!</b> Please click confirm to log-in.";
                        $('#successAlert').html(alert_message).addClass("alert alert-success mb-3");
                    }
                }
            });
        }
    });
});