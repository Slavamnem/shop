$( document ).ready(function() {

    $(document).on("click", ".product-change-quantity", function() {

        var productId = $(this).data('id');
        var action = $(this).data('action');

        $.ajax({
            url: "/order/change_quantity",
            method: 'GET',
            data: {productId: productId, action: action},
            success: function(res) {
                if (res && res != 0) {
                    //$('#product-' + productId + "-quantity").html(res);
                    $('#basket').html(res);
                }
            },
            error: function(){
                alert("Ошибка");
            }
        });
    });

    $(document).on("click", ".basket-trash", function() {
        var productId = $(this).data('id');

        $.ajax({
            url: "/order/remove_basket_product",
            method: 'GET',
            data: {productId: productId},
            success: function(res) {
                if (res) {
                    $('#basket').html(res);
                }
            },
            error: function(){
                alert("Ошибка");
            }
        });
    });


    $('.add-to-basket').on("click", function() {

        var productId = $(this).data('id');

        $.ajax({
            url: "/order/add_basket_product",
            method: 'GET',
            data: {newProductId: productId},
            success: function(res) {
                if (res && res != 0) {
                    $('#basket').html(res);
                    $('#basket').modal();
                }
            },
            error: function(){
                alert("Ошибка");
            }
        });
    });


    $('.admin-filter-input').on("input", function(){
        var field = $(this).data("name");
        var value = $(this).val();

        $.ajax({
            url: "/admin/categories/filter",
            method: 'POST',
            data: {field: field, value: value},
            success: function(res) {
                $('.tbody').html(res);
            },
            error: function(){
                alert("error");
            }
        });
    });

    $('.generate-slug').on("click", function(){

        var name = $('#name').val();

        $.ajax({
            url: "/admin/ajax/translate",
            method: 'POST',
            data: {value: name},
            success: function(res) {
                $('#slug').val(res);
            },
            error: function(){
                alert("error");
            }
        });
    });
});