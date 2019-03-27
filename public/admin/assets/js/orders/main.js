$( document ).ready(function() {
    $('.push-to-telegram').click(function(){

        var orderId = $(this).data('id');
        var token = $(this).data('token');

        $.ajax({
            url: "/admin/orders/telegram/" + orderId,
            data: {"_token": token},
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