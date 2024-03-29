function add_stockStatus() {
    $('#close').click(function(){
        window.location.href="stock_status";
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
                url: 'controller/base.controller.php?add_stockstatus',
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

function update_stockStatus(stock_status_id, name) {
    $('#close').click(function(){
        window.location.href="stock_status";
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
                url: 'controller/base.controller.php?update_stockstatus',
                method: 'POST',
                data: {
                    email:email,
                    ses_group_id:ses_group_id,
                    stock_status_id:stock_status_id,
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

function delete_stockStatus(stock_status_id) {
    var email = $('#email').val();
    var ses_group_id = $('#ses_group_id').val();

    $.ajax({
        url: 'controller/base.controller.php?delete_stockstatus',
        method: 'POST',
        data: {
            email:email,
            ses_group_id:ses_group_id,
            stock_status_id:stock_status_id
        },
        success:function(){
            $('#preloader').show();
            window.location.reload();
        }
    });
}