$(document).ready(function(){
    $("select").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue){
                $(".box").not("." + optionValue).hide();
                $("." + optionValue).show();
            }
        });
    }).change();

    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;

    $('#pickup_date').attr('min', maxDate);

    $('#submit').on("click", function(){
        var customer_email = $('#customer_email').val();
        var customer_password = $('#customer_password').val();

        if(customer_email == "" || customer_password == "") {
            alert_message = "No match for Email Address and Password";
            $('#alert').text(alert_message).addClass("alert alert-danger mb-3");
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
                        window.location.replace("checkout");
                    } else if (response == "invalid") {
                        alert_message = "No match for Email Address and Password";
                        $('#alert').text(alert_message).addClass("alert alert-danger mb-3");
                    } else {
                        alert_message = "No match for Email Address and Password";
                        $('.alert').text(alert_message);
                    }
                }
            });
        }
    });
});