function add_info() {
    window.location.href="add_information";
}

function update_info(information_id, info_title, info_description, meta_title, meta_description, meta_keyword, info_status) {
    $('#close').click(function(){
        window.location.reload();
    });

    $('#Mymodal').modal('show');
    $('.title-container').html('<i class="fas fa-pencil-alt"></i> Update Information');
    $('.save-btn').attr("id", "update");

    $('#info_title').val(info_title);
    $('#info_description').val(info_description);
    $('#meta_title').val(meta_title);
    $('#meta_description').val(meta_description);
    $('#meta_keyword').val(meta_keyword);

    if (info_status == "Enable") {
        $('#info_status').val(1);
    } else if (info_status == "Disabled") {
        $('#info_status').val(0);
    }

    $('#update').on('click', function(){
        var alert_message = $('#alertMessage').val();

        var info_title = $('#info_title').val();
        var info_description = $('#info_description').val();
        var meta_title = $('#meta_title').val();
        var meta_description = $('#meta_description').val();
        var meta_keyword = $('#meta_keyword').val();
        var info_status = $('#info_status').val();

        if (info_title == "" || meta_title == "") {
            alert_message = "Please fill up the form correctly!";
            $('#alertMessage').text(alert_message).addClass("alert alert-danger");
        } else {
            $.ajax({
                url: 'controller/function.php?update_products',
                method: 'POST',
                data: {
                    information_id:information_id,
                    info_title:info_title,
                    info_description:info_description,
                    meta_title:meta_title,
                    meta_description:meta_description,
                    meta_keyword:meta_keyword,
                    info_status:info_status
                },
                success:function(){
                    window.location.reload();
                }
            });
        }
    });

}

function delete_info(information_id) {
    $.ajax({
        url: 'controller/function.php?delete_informations',
        method: 'POST',
        data: {
            information_id:information_id
        },
        success:function(){
            window.location.reload();
        }
    });
}

// Add information
$(document).ready(function(){
    $('#save').on('click', function(){
        var alert_message = $('#alertMessage').val();

        var info_title = $('#info_title').val();
        var info_description = $('#info_description').val();
        var meta_title = $('#meta_title').val();
        var meta_description = $('#meta_description').val();
        var meta_keyword = $('#meta_keyword').val();
        var info_status = $('#info_status').val();

        if (info_title == "" || meta_title == "") {
            alert_message = "Please fill up the required field!";
            $('#alertMessage').text(alert_message).addClass("alert alert-danger");
        } else {
            $.ajax({
                url: 'controller/function.php?add_information',
                method: 'POST',
                data: {
                    info_title:info_title,
                    info_description:info_description,
                    meta_title:meta_title,
                    meta_description:meta_description,
                    meta_keyword:meta_keyword,
                    info_status:info_status
                },
                success:function(){
                    window.location.reload();
                }
            });
        }
    });
});