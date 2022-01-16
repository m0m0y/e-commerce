$(document).ready(function(){
    $('#close').click(function(){
        window.location.href="user";
    });
});

function add_user_admin() {
    $('.Mymodal').modal('show');
    $('.title-container').html('<i class="fas fa-user-plus"></i> Add User');
    $('.save-btn').attr("id", "save");

    $('#save').on('click', function(){
        var alert_message = $('#alertMessage').val();

        var ses_email = $('#ses_email').val();
        var ses_group_id = $('#ses_group_id').val();
        var fname = $('#firstname').val();
        var lname = $('#lastname').val();
        var user_group = $('#user_group').val();
        var mail = $('#email').val();
        var pass = $('#password').val();
        var confirm_pass = $('#confirm_password').val();
        var admin_status = $('#admin_status').val();

        if (pass != confirm_pass) {
            alert_message = "Password did not match!";
            $('#alertMessage').text(alert_message).addClass("alert alert-danger");
        } else if (fname == "" || lname == "" || mail == "" || pass == "") {
            alert_message = "Please fill up the form correctly!";
            $('#alertMessage').text(alert_message).addClass("alert alert-danger");
        } else {
            $.ajax({
                url:'controller/base.controller.php?add_user_admin',
                method:'POST',
                data: {
                    ses_email:ses_email,
                    ses_group_id:ses_group_id,
                    fname:fname,
                    lname:lname,
                    user_group:user_group,
                    mail:mail,
                    pass:pass,
                    confirm_pass:confirm_pass,
                    admin_status:admin_status
                },
                success:function() {
                    $('#preloader').show();
                    window.location.reload();
                }
            });
        }

    });
}

function update_admin_user(admin_user_id, firstname, lastname, email, admin_status, user_group) {
    $('.Mymodal').modal('show');
    $('.title-container').html('<i class="fas fa-pencil-alt"></i> Update User Admin');
    $('.save-btn').attr('id', 'update');
    $('#firstname').val(firstname);
    $('#lastname').val(lastname);
    $('#user_group').val(user_group).attr('disabled', 'disabled');
    $('#email').val(email);
    
    if (admin_status == "Enable") {
        $('#admin_status').val(1);
    } else if (admin_status == "Disabled") {
        $('#admin_status').val(0);
    }

    if ($('#user_group').val() == null) {
        $('.save-btn').attr('disabled', 'disabled');
    }
    
    $('#update').on('click', function(){
        var alert_message = $('#alertMessage').val();

        var ses_email = $('#ses_email').val();
        var ses_group_id = $('#ses_group_id').val();
        var fname = $('#firstname').val();
        var lname = $('#lastname').val();
        var mail = $('#email').val();
        var pass = $('#password').val();
        var confirm_pass = $('#confirm_password').val();
        var admin_status = $('#admin_status').val();
        var user_group = $('#user_group').val();
        
        if (pass != confirm_pass) {
            alert_message = "Your password did not match!";
            $('#alertMessage').text(alert_message).addClass("alert alert-danger");
        } else if (fname == "" || lname == "" || email == "") {
            alert_message = "Please fill up the form correctly!";
            $('#alertMessage').text(alert_message).addClass("alert alert-danger");
        } else {
            $.ajax({
                url: 'controller/base.controller.php?update_user_admins',
                method: 'POST',
                data: {
                    ses_email:ses_email,
                    ses_group_id:ses_group_id,
                    admin_user_id:admin_user_id,
                    fname:fname,
                    lname:lname,
                    mail:mail,
                    pass:pass,
                    admin_status:admin_status,
                    user_group:user_group
                },
                success:function(){
                    $('#preloader').show();
                    window.location.reload();
                }
            });
        }

    });
}


function delete_admin_user(admin_user_id) {
    var ses_email = $('#ses_email').val();
    var ses_group_id = $('#ses_group_id').val();

    $.ajax({
        url:'controller/base.controller.php?delete_admin_users',
        method:'POST', 
        data: {
            ses_email:ses_email,
            ses_group_id:ses_group_id,
            admin_user_id:admin_user_id
        },
        success:function() {
            $('#preloader').show();
            window.location.reload();     
        }
    });
}

