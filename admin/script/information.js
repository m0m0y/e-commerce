$(document).ready(function() {
    $('#info_description').summernote({
        tabsize: 2,
        height: 250,
    });

    $('#update').on('click', function(){
        var alert_message = $('#alertMessage').val();

        var information_id = $('#information_id').val();
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
                url: 'controller/base.controller.php?update_info',
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
                    $('#preloader').show();
                    window.location.reload();
                }
            });
        }
    });
});

function add_info() {
    $('#preloader').show();
    window.location.href="add_information";
}

function update_info(information_id) {
    window.location.href = 'update_information.php?information_id='+information_id; 
}

function delete_info(information_id) {
    $.ajax({
        url: 'controller/base.controller.php?delete_informations',
        method: 'POST',
        data: {
            information_id:information_id
        },
        success:function(){
            $('#preloader').show();
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
                url: 'controller/base.controller.php?add_information',
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
                    $('#preloader').show();
                    window.location.reload();
                }
            });
        }
    });
});