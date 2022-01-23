function openTabs(event, tabName) {
    var c, tabcontent, tab_button;

    tabcontent = document.getElementsByClassName("tabcontent");
    for (c = 0; c < tabcontent.length; c++) {
    tabcontent[c].style.display = "none";
    }

    tab_button = document.getElementsByClassName("tab_button");
    for (c = 0; c < tab_button.length; c++) {
    tab_button[c].className = tab_button[c].className.replace(" active", "");
    }

    document.getElementById(tabName).style.display = "block";
    event.currentTarget.className += " active";
}

$(document).ready(function() {
    $('#back').click(function(){
        window.location.href="orders";
    });

    $('#save').on('click',function(){
        var ses_email = $('#ses_email').val();
        var ses_group_id = $('#ses_group_id').val();
        var order_id = $('#order_id').val();
        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var email = $('#email').val();
        var telephone = $('#telephone').val();
        var payment_option = $('#payment_option').val();

        if (payment_option == "cash") {
            var payment_method = "Cash";
        } else if (payment_option == "gcash"){
            var payment_method = "Gcash";
        } else if (payment_option == "bank_transfer") {
            var payment_method = "Bank Transfer";
        }

        if (firstname == "" || lastname == "" || email == "" || telephone == "") {
            alert_message = "Please fill up the required field!";
            $('#alertMessage').text(alert_message).addClass("alert alert-danger");
        } else {
            $.ajax({
                url: 'controller/base.controller.php?update_customer_orders',
                method: 'POST',
                data:{
                    ses_email:ses_email,
                    ses_group_id:ses_group_id,
                    order_id:order_id,
                    firstname:firstname,
                    lastname:lastname,
                    email:email,
                    telephone:telephone,
                    payment_method:payment_method,
                    payment_option:payment_option
                },
                success: function(){
                    $('#preloader').show();
                    window.location.replace("orders");
                }
            });
        }
    });
});