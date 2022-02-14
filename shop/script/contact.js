$(document).ready(function(){
    $('#submit').on("click", function(){
        var customer_name = $('#customer_name').val();
        var customer_number = $('#customer_number').val();
        var customer_email = $('#customer_email').val();
        var confirm_email = $('#confirm_email').val();
        var customer_message = $('#customer_message').val();

        if (customer_email != confirm_email) {
            alert_message = "Your email not match, please try again.";
            $('#alert').text(alert_message).addClass("alert alert-danger mb-3");
        } else if (customer_name == "" || customer_number == "" || customer_email == "" || confirm_email == "" || customer_message =="") {
            alert_message = "Please double check your input field";
            $('#alert').text(alert_message).addClass("alert alert-danger mb-3");
        } else {
            $.ajax({
                url: 'controller/contact.controller.php',
                method: 'POST',
                data: {
                    customer_name:customer_name,
                    customer_number:customer_number,
                    customer_email:customer_email,
                    customer_message:customer_message
                },
                success: function() {
                    window.location.replace("thankyou");
                }
            });
        }
   });
});