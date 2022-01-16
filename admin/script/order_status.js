function add_orderStatus() {
    $('#close').click(function(){
        window.location.href="order_status";
    });

    $('.Mymodal').modal('show');
    $('.title-container').html('<i class="fas fa-pencil-alt"></i> Add Stock Status');
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
                url: 'controller/base.controller.php?add_orderstatus',
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

function update_orderStatus(order_status_id, name) {
    $('#close').click(function(){
        window.location.href="order_status";
    });

    $('.Mymodal').modal('show');
    $('.title-container').html('<i class="fas fa-pencil-alt"></i> Update Stock Status');
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
                url: 'controller/base.controller.php?update_orderstatus',
                method: 'POST',
                data: {
                    email:email,
                    ses_group_id:ses_group_id,
                    order_status_id:order_status_id,
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

function delete_orderStatus(order_status_id) {
    var email = $('#email').val();
    var ses_group_id = $('#ses_group_id').val();
    
    $.ajax({
        url: 'controller/base.controller.php?delete_orderstatus',
        method: 'POST',
        data: {
            email:email,
            ses_group_id:ses_group_id,
            order_status_id:order_status_id
        },
        success:function(){
            $('#preloader').show();
            window.location.reload();
        }
    });
}