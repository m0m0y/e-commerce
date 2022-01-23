$(document).ready(function(){
    var over_all_total = 0;

    $('td[data-id]').map(function() {
        over_all_total += parseFloat($(this).find('span').text());
    });

    $('#sub-total').html('₱ '+over_all_total+'.00');
    $('#vat').html('₱ 0.00');
    $('#total-price').html('₱ '+over_all_total+'.00');
});

function addHistory() {
    var order_id = $('#order_id').val();
    var invoice_no = $('#invoice_no').val();
    var customer_name = $('#customer_name').val();
    var order_status = $('#order_status').val();
    var comment = $('#comment').val();

    var ses_email = $('#ses_email').val();
    var ses_group_id = $('#ses_group_id').val();

    if(order_status == "") {
        $('#order_status').addClass("is-invalid");
    } else {
        $.ajax({
            url: 'controller/base.controller.php?add_newHistory',
            method: 'POST',
            data: {
                order_id:order_id,
                invoice_no:invoice_no,
                customer_name:customer_name,
                order_status:order_status,
                comment:comment,
                ses_email:ses_email,
                ses_group_id:ses_group_id
            },
            success:function() {
                window.location.reload();
            }
        });
    }
}

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