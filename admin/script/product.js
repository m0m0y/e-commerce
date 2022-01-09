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

function add_product() {
    window.location.href="add_product";
}

function update_products(product_id, name, quantity, price, product_status, description, meta_title, meta_description, meta_keywords, stock_status_id, product_weight, weight_id, product_category) {
    $('#close').click(function(){
        window.location.reload();
    });

    $('#Mymodal').modal('show');
    $('.title-container').html('<i class="fas fa-pencil-alt"></i> Update Product');
    $('.save-btn').attr("id", "update");

    $('#product_name').val(name);
    $('#description').val(description);
    $('#meta_tag_title').val(meta_title);
    $('#meta_tag_description').val(meta_description);
    $('#meta_tag_keywords').val(meta_keywords);
    $('#price').val(number_format(price, '2'));
    $('#quantity').val(quantity);
    $('#stock_status').val(stock_status_id);
    $('#weight').val(product_weight);
    $('#weight_class').val(weight_id);

    if (product_status == "Enable") {
        $('#product_status').val(1);
    } else if (product_status == "Disabled") {
        $('#product_status').val(0);
    }

    $('#product_category').val(product_category);

    $('#update').on('click', function(){
        var alert_message = $('#alertMessage').val();

        var product_name = $('#product_name').val();
        var product_desc = $('#description').val();
        var meta_tag_title = $('#meta_tag_title').val();
        var meta_tag_description = $('#meta_tag_description').val();
        var meta_tag_keywords = $('#meta_tag_keywords').val();
        var price = $('#price').val();
        var quantity = $('#quantity').val();
        var stock_status = $('#stock_status').val();
        var product_weight = $('#weight').val();
        var weight_class = $('#weight_class').val();
        var product_status = $('#product_status').val();

        var product_category = $('#product_category').val();

        if (product_name == "" || price == "" || quantity == "" || meta_tag_title == "" || weight == "") {
            alert_message = "Please double check the required fields!";
            $('#alertMessage').text(alert_message).addClass("alert alert-danger");
        } else {
            $.ajax({
                url: 'controller/function.php?update_product',
                method: 'POST',
                data: {
                    product_id:product_id,
                    product_name:product_name,
                    product_desc:product_desc,
                    meta_tag_title:meta_tag_title,
                    meta_tag_description:meta_tag_description,
                    meta_tag_keywords:meta_tag_keywords,
                    price:price,
                    quantity:quantity,
                    stock_status:stock_status,
                    product_weight:product_weight,
                    weight_class:weight_class,
                    product_status:product_status,
                    product_category:product_category
                },
                success:function(){
                    window.location.reload();
                }
            });
        }
    });
}

function delete_products(product_id) {
    $.ajax({
        url: 'controller/function.php?delete_product',
        method: 'POST',
        data: {
            product_id:product_id
        },
        success:function(){
            window.location.reload();
        }
    });
}