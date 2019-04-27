$( document ).ready(function() {

    $('.stock-quantity').on("change", function(){
        var productId = $(this).data("product");
        var quantity = $(this).val();

        // alert(productId);
        // alert(quantity);
        $.ajax({
            url: "/admin/stock/change_quantity",
            method: 'POST',
            data: {productId: productId, quantity:quantity},
            success: function(res) {
                // alert(res);
                //$('#new-properties').append(res);
            },
            error: function(){
                alert("error");
            }
        });
    });

    // $(document).on('click', '.delete-image', function(){
    //     $(this).parents(".product-image").html("");
    // });
    //
    // $(document).on('click', '.delete-property', function(){
    //     $(this).parents(".product-property").html("");
    // });
});