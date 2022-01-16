function add_category(){
    $('#preloader').show();
    window.location.href="add_category";
}

function update_category(category_id, category_name, description, meta_title, category_status) {
    $('#close').click(function(){
        window.location.reload();
    });

    $('.Mymodal').modal('show');
    $('.title-container').html('<i class="fas fa-pencil-alt"></i> Update Categories');
    $('.save-btn').attr("id", "update");

    $('#category_name').val(category_name);
    $('#description').val(description);
    $('#meta_tag_title').val(meta_title);

    if (category_status == "Enable") {
        $('#category_status').val(1);
    } else if (category_status == "Disabled") {
        $('#category_status').val(0);
    }

    $('#update').on('click', function(){
        var alert_message = $('#alertMessage').val();

        var email = $('#email').val();
        var ses_group_id = $('#ses_group_id').val();
        var category_name = $('#category_name').val();
        var description = $('#description').val();
        var meta_tag_title = $('#meta_tag_title').val();
        var category_status = $('#category_status').val();

        if (category_name == "" || meta_tag_title == "") {
            alert_message = "Please fill up the form correctly!";
            $('#alertMessage').text(alert_message).addClass("alert alert-danger");
        } else {
            $.ajax({
                url: 'controller/base.controller.php?update_categories',
                method: 'POST',
                data: {
                    email:email,
                    ses_group_id:ses_group_id,
                    category_id:category_id,
                    category_name:category_name,
                    description:description,
                    meta_tag_title:meta_tag_title,
                    category_status:category_status
                },
                success: function(){
                    $('#preloader').show();
                    window.location.reload();
                }
            });
        }
    });
}

function delete_category(category_id) {
    var email = $('#email').val();
    var ses_group_id = $('#ses_group_id').val();
    
    $.ajax({
        url: 'controller/base.controller.php?delete_categories',
        method: 'POST',
        data: {
            email:email,
            ses_group_id:ses_group_id,
            category_id:category_id
        },
        success: function() {
            $('#preloader').show();
            window.location.reload();
        }
    });
}


// Add new category script
function openTabs(event, tabName) {
    var c, tabcontent, tab_button;

    tabcontent = document.getElementsByClassName("tabcontent");
    for (c = 0; c < tabcontent.length; c++) {
    tabcontent[c].style.display = "none";
    }

    tab_button = document.getElementsByClassName("tab_button");
    for (c = 0; c < tab_button.length; c++) {
    tab_button[c].className = tab_button[c].className.replace(" active", "");
    }

    document.getElementById(tabName).style.display = "block";
    event.currentTarget.className += " active";
}

$(document).ready(function(){
    $('#save').on('click', function(){
        var alert_message = $('#alertMessage').val();

        var email = $('#email').val();
        var ses_group_id = $('#ses_group_id').val();
        var category_name = $('#category_name').val();
        var description = $('#description').val();
        var meta_tag_title = $('#meta_tag_title').val();
        var category_status = $('#category_status').val();

        if (category_name == "" || meta_tag_title == "") {
            alert_message = "Please fill up the required field!";
            $('#alertMessage').text(alert_message).addClass("alert alert-danger");
        } else {
            $.ajax({
                url: 'controller/base.controller.php?add_categories',
                method: 'POST',
                data: {
                    email:email,
                    ses_group_id:ses_group_id,
                    category_name:category_name,
                    description:description,
                    meta_tag_title:meta_tag_title,
                    category_status:category_status
                },
                success:function(){
                    $('#preloader').show();
                    window.location.reload();
                }
            });
        }
    });
});