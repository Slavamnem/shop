$( document ).ready(function() {

    $('.admin-filter-input').on("input", function(){
        var field = $(this).data("name");
        var value = $(this).val();

        $.ajax({
            url: "/admin/groups/filter",
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

    $('.generator').on("change", function(){

        //var value = $(this).checked;
        //alert("change");
        //alert(value);

        if ($(this).is(':checked')) {
            //alert("on!");
            $.ajax({
                    url: "/admin/groups/modifications",
                    method: 'POST',
                    success: function(res){
                        //alert("success");
                        $('.variations').html(res);
                    },
                    error: function(){
                        //alert("error");
                    }
                });
        } else {
            //alert("off");
            $('.variations').html("");
        }
        // var orderId = $(this).data('id');
        // var link = $(this).data('link');
        // var token = $(this).data('token');
        //
        // $.ajax({
        //     url: "/admin/orders/telegram/" + orderId,
        //     data: {"_token": token, "link": link},
        //     method: 'POST',
        //     success: function(res){
        //         //alert("success");
        //     },
        //     error: function(){
        //         //alert("error");
        //     }
        // });
    });
});