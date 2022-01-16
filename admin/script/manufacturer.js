function add_manufacturers() {
    $('#close').click(function(){
        window.location.href="manufacturer";
    });

    $('.Mymodal').modal('show');
    $('.title-container').html('<i class="fas fa-pencil-alt"></i> Add Manufacturer');
    $('.save-btn').attr('id', 'save');

    $('#save').on('click', function(){
        var alert_message = $('#alertMessage').val();

        var email = $('#email').val();
        var ses_group_id = $('#ses_group_id').val();
        var name = $('#name').val();

        if(name == "") {
            alert_message = "Please double check the required fields!";
            $('#alertMessage').text(alert_message).addClass("alert alert-danger");
        } else {
            $.ajax({
                url: 'controller/base.controller.php?add_manufacturer',
                method: 'POST',
                data: {
                    email:email,
                    ses_group_id:ses_group_id,
                    name:name
                },
                success:function(){
                    $('#preloader').show();
                    window.location.reload();
                }
            });
        }
    });
}

function update_manufacturers(manufacturer_id, name) {
    $('#close').click(function(){
        window.location.href="manufacturer";
    });

    $('.Mymodal').modal('show');
    $('.title-container').html('<i class="fas fa-pencil-alt"></i> Update Manufacturer');
    $('.save-btn').attr('id', 'update');

    $('#name').val(name);

    $('#update').on('click', function(){
        var alert_message = $('#alertMessage').val();

        var email = $('#email').val();
        var ses_group_id = $('#ses_group_id').val();
        var name = $('#name').val();

        if(name == "") {
            alert_message = "Please double check the required fields!";
            $('#alertMessage').text(alert_message).addClass("alert alert-danger");
        } else {
            $.ajax({
                url: 'controller/base.controller.php?update_manufaturer',
                method: 'POST',
                data: {
                    email:email,
                    ses_group_id:ses_group_id,
                    manufacturer_id:manufacturer_id,
                    name:name
                },
                success:function(){
                    $('#preloader').show();
                    window.location.reload();
                }
            });
        }
    });
}

function delete_manufacturers(manufacturer_id) {
    var email = $('#email').val();
    var ses_group_id = $('#ses_group_id').val();
    
    $.ajax({
        url: 'controller/base.controller.php?delete_manufacturer',
        method: 'POST',
        data: {
            email:email,
            ses_group_id:ses_group_id,
            manufacturer_id:manufacturer_id
        },
        success:function(){
            $('#preloader').show();
            window.location.reload();
        }
    });
}