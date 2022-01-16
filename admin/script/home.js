$(document).ready(function(){
    $('#close').click(function(){
        window.location.href="home";
    });

    $('#add_notes').on('click', function(){
        $('.Mymodal').modal('show');
        $('.title-container').html('<i class="fas fa-pencil-alt"></i> Add Notes');
        $('.save-btn').attr('id', 'save');

        $('#save').on('click', function(){
            var alert_message = $('#alertMessage').val();
            var title = $('#title').val();
            var note = $('#note').val();

            if (note == "") {
                alert_message = "You cannot save empty contents.";
                $('#alertMessage').text(alert_message).addClass("alert alert-danger");
                $('#note').addClass("is-invalid");
            } else {
                $.ajax({
                    url: 'controller/base.controller.php?add_notes',
                    method: 'POST',
                    data: {
                        title:title,
                        note:note
                    },
                    success:function(){
                        $('#preloader').show();
                        window.location.reload();
                    }
                });
            }
        });
    });
});

function view_notes(note_id, title, note, date_added) {
    $('.Mymodal').modal('show');
    $('.title-container').html('<i class="fas fa-pencil-alt"></i> Add Notes');
    $('.save-btn').attr('id', 'update');

    $('#title').val(title);
    $('#note').val(note);
    $('#date-added').html('Date Added: '+date_added).addClass("text-end");

    $('#update').on('click', function(){
        var alert_message = $('#alertMessage').val();
        var title = $('#title').val();
        var note = $('#note').val();

        if (note == "") {
            alert_message = "You cannot save empty contents.";
            $('#alertMessage').text(alert_message).addClass("alert alert-danger");
            $('#note').addClass("is-invalid");
        } else {
            $.ajax({
                url: 'controller/base.controller.php?update_note',
                method: 'POST',
                data: {
                    note_id:note_id,
                    title:title,
                    note:note
                },
                success:function(){
                    $('#preloader').show();
                    window.location.reload();
                }
            });
        }
    });
}

function delete_notes(note_id) {
    $.ajax({   
        url: 'controller/base.controller.php?delete_note',
        method: 'POST',
        data: {
            note_id:note_id
        },
        success:function(){
            $('#preloader').show();
            window.location.reload();
        }
    });
}