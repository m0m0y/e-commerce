function update_bank_details(bank_id, bank_name, account_number, account_name) {
    $('#close').click(function(){
        window.location.href="bank_details";
    });

    $('.Mymodal').modal('show');
    $('.title-container').html('<i class="fas fa-pencil-alt"></i> Update Bank Details');
    $('.save-btn').attr('id', 'update');

    $('#bank_id').val(bank_id);
    $('#bank_name').val(bank_name);
    $('#account_number').val(account_number);
    $('#account_name').val(account_name);

    $('#update').on('click', function(){
        var alert_message = $('#alertMessage').val();
        var email = $('#email').val();
        var ses_group_id = $('#ses_group_id').val();
        var bank_id = $('#bank_id').val();
        var bank_name = $('#bank_name').val();
        var account_number = $('#account_number').val();
        var account_name = $('#account_name').val();

        if(bank_name == "" || account_number == "" || account_name == ""){
            alert_message = "Please double check the required fields!";
            $('#alertMessage').text(alert_message).addClass("alert alert-danger");
        } else {
            $.ajax({
                url:'controller/base.controller.php?update_banks',
                method:'POST',
                data: {
                    email:email,
                    ses_group_id:ses_group_id,
                    bank_id:bank_id,
                    bank_name:bank_name,
                    account_number:account_number,
                    account_name:account_name
                },
                success:function() {
                    $('#preloader').show();
                    window.location.reload();  
                }
            }); 
        }
    });
}