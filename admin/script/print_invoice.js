$(document).ready(function(){
    var over_all_total = 0;

    $('td[data-id]').map(function() {
        over_all_total += parseFloat($(this).find('span').text());
    });

    var sub_total = $('#sub-total').html('₱ '+over_all_total+'.00');
    var vat = $('#vat').html('₱ 0.00');
    var total_price = $('#total-price').html('₱ '+over_all_total+'.00');
});