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

    $(document).on("click", ".add-to-basket", function() {

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


    $('#order_client_phone').on("input", function(){
        var phone = $(this).val();

        $.ajax({
            url: "/order/get_client_data",
            method: 'POST',
            data: {field: "phone", value: phone},
            success: function(res) {
                if (res = JSON.parse(res)) {
                    $("#order_client_name").val(res.name);
                    $("#order_client_last_name").val(res.last_name);
                    $("#order_client_email").val(res.email);
                }
            },
            error: function(){
                //alert("error");
            }
        });
    });

    $('#order_client_email').on("input", function(){
        var email = $(this).val();

        $.ajax({
            url: "/order/get_client_data",
            method: 'POST',
            data: {field: "email", value: email},
            success: function(res) {
                if (res = JSON.parse(res)) {
                    $("#order_client_name").val(res.name);
                    $("#order_client_last_name").val(res.last_name);
                    $("#order_client_phone").val(res.phone);
                }
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
            url: "/order/selectCity",
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
            url: "/order/selectDeliveryType",
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