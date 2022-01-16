$(document).ready(function(){
    $('#submit').on('click',function(){
        var error_msg = $('#usercheck').val();

        var email = $('#email').val();
        var pass = $('#password').val();

        if (email == "" || pass == ""){
            error_msg = 'Error message!';
            $('#usercheck').text(error_msg).addClass("alert alert-danger");
        } else {
            $.ajax({
                url:'controller/base.controller.php?login',
                type:'post',
                data:{
                    email:email,
                    pass:pass
                },
                success: function(response){
                    if(response=="success") {
                        window.location.href="home";
                    } else {
                        error_msg = 'Your email and password not match!';
                        $('#usercheck').text(error_msg).addClass("alert alert-danger");
                    }
                }
            });
        }
    });
});