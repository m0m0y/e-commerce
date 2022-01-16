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

function update_cunstomer_info(customer_id, firstname, lastname, email, telephone, status, address_1, address_2, city, postcode, region) {
    $('#close').click(function(){
        window.location.reload();
    });

    $('.Mymodal').modal('show');
    $('.title-container').html('<i class="fas fa-pencil-alt"></i> Customer Information');
    $('.save-btn').attr("id", "update");

    $('#firstname').val(firstname);
    $('#lastname').val(lastname);
    $('#email').val(email);
    $('#telephone').val(telephone);
    $('#password').val();
    $('#confirm_pass').val();

    if (status == "Enable") {
        $('#status').val(1);
    } else if (status == "Disabled") {
        $('#status').val(0);
    }

    $('#address_1').val(address_1);
    $('#address_2').val(address_2);
    $('#city').val(city);
    $('#postcode').val(postcode);
    $('#region').val(region);

    $('#update').on('click', function(){
        var alert_message = $('#alertMessage').val();

        var ses_email = $('#ses_email').val();
        var ses_group_id = $('#ses_group_id').val();
        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var email = $('#email').val();
        var telephone = $('#telephone').val();
        var password = $('#password').val();
        var status = $('#status').val();
        var confirm_pass = $('#confirm_pass').val();

        var address_1 = $('#address_1').val();
        var address_2 = $('#address_2').val();
        var city = $('#city').val();
        var postcode = $('#postcode').val();
        var region = $('#region').val();
        if (password != confirm_pass){
            alert_message = "Password did not match!";
            $('#alertMessage').text(alert_message).addClass("alert alert-danger");
        } else if (firstname == "" || lastname == "" || email == "" || telephone == "" || address_1 == "" || city == "" || region == "") {
            alert_message = "Please double check the required fields!";
            $('#alertMessage').text(alert_message).addClass("alert alert-danger");
        } else {
            $.ajax({
                url: 'controller/base.controller.php?update_customer_info',
                method: 'POST',
                data: {
                    ses_email:ses_email,
                    ses_group_id:ses_group_id,
                    customer_id:customer_id,
                    firstname:firstname,
                    lastname:lastname,
                    email:email,
                    telephone:telephone,
                    password:password,
                    status:status,
                    address_1:address_1,
                    address_2:address_2,
                    city:city,
                    postcode:postcode,
                    region:region
                },
                success:function(){
                    $('#preloader').show();
                    window.location.reload();
                }
            });
        }
    });
}

function delete_customer(customer_id) {
    var ses_email = $('#ses_email').val();
    var ses_group_id = $('#ses_group_id').val();

    $.ajax({
        url: 'controller/base.controller.php?delete_customer_accnt',
        method: 'POST',
        data: {
            ses_email:ses_email,
            ses_group_id:ses_group_id,
            customer_id:customer_id
        },
        success:function(){
            $('#preloader').show();
            window.location.reload();
        }
    });
}