$(document).ready(function(){
    $('#close').click(function(){
        $('#Mymodal').modal('hide');
    });
});

function add_user_group() {
    $('#Mymodal').modal('show');
    $('.title-container').html('<i class="fas fa-user-plus"></i> Add User Group');
    $('.save-btn').attr("id", "save");

    $('#save').on('click', function(){
        var alert_message = $('#alertMessage').val();
        var name = $('#user_group_name').val();

        if(name == "") {
            alert_message = "Please double check the required fields!";
            $('#alertMessage').text(alert_message).addClass("alert alert-danger");
        } else {
            $.ajax({
                url:'controller/function.php?add_user_groups',
                method:'POST',
                data:{
                    name:name
                },
                success:function() {
                    window.location.href="user_group";
                    alert("Success!");
                }
            });
        }
    });
}

function update_user_group(user_group_id, name){
    $('#Mymodal').modal('show');
    $('.title-container').html('<i class="fas fa-pencil-alt"></i> Update User Group');
    $('.save-btn').attr("id", "update");
    $('#user_group_name').val(name);

    $('#update').on('click', function(){
        var alert_message = $('#alertMessage').val();
        var u_name = $("#user_group_name").val();

        if(u_name == ""){
            alert_message = "Please double check the required fields!";
            $('#alertMessage').text(alert_message).addClass("alert alert-danger");
        } else {
            $.ajax({
                url:'controller/function.php?update_user_groups',
                method:'POST',
                data: {
                    name : u_name,
                    user_group_id : user_group_id
                },
                success:function(data) {
                    window.location.href="user_group";
                    alert("Successfully Modified!");     
                }
            }); 
        }
    });
}

function delete_user_group(user_group_id){
    $.ajax({
        url:'controller/function.php?delete_user_groups',
        method:'POST', 
        data: {user_group_id},
        success:function() {
            window.location.href="user_group";
            alert("Delete Successfully!");        
        }
    });
}