$( document ).ready(function() {

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
});