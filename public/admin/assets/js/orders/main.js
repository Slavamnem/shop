$( document ).ready(function() {

    $('#order-new-product').on("input", function(){
        var name = $(this).val();

        if (name) {
            $.ajax({
                url: "/admin/products/get_products",
                method: 'POST',
                data: {name: name},
                success: function(res) {
                    $("#order-new-products").html(res);
                },
                error: function(){
                    alert("error");
                }
            });
        }
    });

    $('#order_client_phone').on("input", function(){
        var phone = $(this).val();

        $.ajax({
            url: "/admin/orders/get_client_data",
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
            url: "/admin/orders/get_client_data",
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

    $('.admin-filter-input').on("input", function(){
        var field = $(this).data("name");
        var value = $(this).val();

        $.ajax({
            url: "/admin/orders/filter",
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

    $(document).on("click", '.add-product-to-basket', function(){
        var newProductId = $('#new-product').val(); //without elastic
        //var newProductId = $(this).data('id'); //for elastic

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

    $(document).on("click", '.remove-basket', function(){
        $.ajax({
            url: "/admin/orders/remove_basket",
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