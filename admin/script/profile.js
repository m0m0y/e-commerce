$(document).ready(function(){
    $('#save').on('click',function(){
        var alert_message = $('#alertMessage').val();
        var userId = $('#user_id').val();
        var fname = $('#firstname').val();
        var lname = $('#lastname').val();
        var mail = $('#emailadd').val();
        var pass = $('#password').val();
        var confirm_pass = $('#confirm_password').val();

        if(pass != confirm_pass) {
            alert_message = "Password did not match!";
            $('#alertMessage').text(alert_message).addClass("alert alert-danger");
        } else if(fname == "" || lname == "" || mail == "") {
            alert_message = "Please double check the required fields!";
            $('#alertMessage').text(alert_message).addClass("alert alert-danger");
        } else {
            $.ajax({
                url:'controller/base.controller.php?update_profile',
                method:'POST',
                data:{
                    userId:userId, 
                    fname:fname, 
                    lname:lname, 
                    mail:mail, 
                    pass:pass
                },
                success: function(){
                    $('#preloader').show();
                    window.location.reload();                      
                }
            });
        }
    });
});
