$(document).ready(function(){
    $('#close').click(function(){
        window.location.href="user_group";
    });
});

function add_user_group() {
    $('.Mymodal').modal('show');
    $('.title-container').html('<i class="fas fa-user-plus"></i> Add User Group');
    $('.save-btn').attr('id', 'save');

    $('#save').on('click', function(){
        var alert_message = $('#alertMessage').val();
        var email = $('#email').val();
        var ses_group_id = $('#ses_group_id').val();
        var name = $('#user_group_name').val();

        if(name == "") {
            alert_message = "Please double check the required fields!";
            $('#alertMessage').text(alert_message).addClass("alert alert-danger");
        } else {
            $.ajax({
                url:'controller/base.controller.php?add_user_groups',
                method:'POST',
                data:{
                    email:email,
                    ses_group_id:ses_group_id,
                    name:name
                },
                success:function() {
                    $('#preloader').show();
                    window.location.reload();
                }
            });
        }
    });
}

function update_user_group(user_group_id, name){
    $('.Mymodal').modal('show');
    $('.title-container').html('<i class="fas fa-pencil-alt"></i> Update User Group');
    $('.save-btn').attr('id', 'update');
    $('#user_group_name').val(name);

    $('#update').on('click', function(){
        var alert_message = $('#alertMessage').val();
        var email = $('#email').val();
        var ses_group_id = $('#ses_group_id').val();
        var u_name = $("#user_group_name").val();  

        if(u_name == ""){
            alert_message = "Please double check the required fields!";
            $('#alertMessage').text(alert_message).addClass("alert alert-danger");
        } else {
            $.ajax({
                url:'controller/base.controller.php?update_user_groups',
                method:'POST',
                data: {
                    email:email,
                    ses_group_id:ses_group_id,
                    user_group_id:user_group_id,
                    name:u_name,
                },
                success:function() {
                    $('#preloader').show();
                    window.location.reload();  
                }
            }); 
        }
    });
}

function delete_user_group(user_group_id){
    var email = $('#email').val();
    var ses_group_id = $('#ses_group_id').val();

    $.ajax({
        url:'controller/base.controller.php?delete_user_groups',
        method:'POST', 
        data: {
            email:email,
            ses_group_id:ses_group_id,
            user_group_id:user_group_id
        },
        success:function() {
            $('#preloader').show();
            window.location.reload();     
        }
    });
}