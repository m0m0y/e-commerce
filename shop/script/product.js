$(document).ready(function() {
    $('.owl-carousel').owlCarousel({
        items: 1,
        margin: 10,
        autoHeight: true,
        autoplay: true,
        loop: true
    });
});

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

function alert_to_login() {
    $('.modal-alert').modal('show');

    var alert_message = $('#alert').val();
    alert_message = 'You must <b>login</b> or <b>create an account</b> to add product into your wishlist!';
    $('#alert').html(alert_message).addClass("alert alert-danger mb-3");
}

function add_to_cart(customer_id, product_id) {
    var quantity = $('#quantity').val();

    if (quantity <= 0) {
        $('#quantity').addClass("is-invalid");
    } else {
        $.ajax({
            url: 'controller/cart.controller.php?add_cart',
            method: 'POST',
            data: {
                customer_id:customer_id,
                product_id:product_id,
                quantity:quantity
            },
            success:function(){
                window.location.reload();
            }
        });
    }
}

function add_to_wishlist(product_id, customer_id) {
    var alert_message = $('#alert').val();

    $.ajax({
        url: 'controller/wishlist.controller.php?add_wishlist',
        method: 'POST',
        data: {
            customer_id:customer_id,
            product_id:product_id
        },
        success:function(response) {
            if(response == "New record created successfully"){
                window.location.href="wishlist";
            } else if (response == "Record is existing") {
                $('.modal-alert').modal('show');

                alert_message = 'You <b>already added</b> this product to your wishlist!';
                $('#alert').html(alert_message).addClass("alert alert-success mb-3");
            }
        }
    });
}