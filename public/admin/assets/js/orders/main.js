$( document ).ready(function() {

    $('.admin-filter-input').on("input", function(){
        var field = $(this).data("name");
        var table = $(this).data("table");
        var value = $(this).val();

        $.ajax({
            url: "/admin/ajax/filer_table",
            method: 'POST',
            data: {table: table, field: field, value: value},
            success: function(res) {
                $('.tbody').html(res);
            },
            error: function(){
                alert("error");
            }
        });
    });

    $('.add-product-to-basket').click(function(){

        var newProductId = $('#new-product').val();

        $.ajax({
            url: "/admin/orders/add_product_to_basket",
            data: {"newProductId": newProductId},
            method: 'POST',
            success: function(res){
                $("#basket").html(res);
            },
            error: function(){
                alert("error");
            }
        });
    });

    $('.push-to-telegram').click(function(){

        var orderId = $(this).data('id');
        var link = $(this).data('link');
        var token = $(this).data('token');

        $.ajax({
            url: "/admin/orders/telegram/" + orderId,
            data: {"_token": token, "link": link},
            method: 'POST',
            success: function(res){
                //alert("success");
            },
            error: function(){
                //alert("error");
            }
        });
    });

    $("#order-city").on("change", function () {
        var cityRef = $(this).val();
        var deliveryType = $("#order-delivery-type").val();

        $.ajax({
            url: "/admin/orders/selectCity",
            data: {"cityRef": cityRef, "deliveryType": deliveryType},
            method: 'POST',
            success: function(res){
                if (res) {
                    $(".warehouses").html(res);
                }
            },
            error: function(){
                alert("error");
            }
        });
    });

    $("#order-delivery-type").on("change", function () {
        var deliveryType = $(this).val();
        //alert(deliveryType); exit();

        $.ajax({
            url: "/admin/orders/selectDeliveryType",
            data: {"deliveryType": deliveryType},
            method: 'POST',
            success: function(res){
                //alert(res);
                $(".warehouses").html(res);
            },
            error: function(){
                alert("error");
            }
        });
    });
});