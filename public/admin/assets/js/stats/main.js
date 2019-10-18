$( document ).ready(function() {
    $('.stats-sort-button').on("click", function(){
        var checked = $(this).is(':checked');

        $.ajax({
            url: "/admin/stats/products_list",
            method: 'GET',
            data: {checked: checked},
            success: function(res) {
                $('#top-products-list').html(res);
            },
            error: function(){
                alert("error");
            }
        });
    });

    $('#export-order-stats').on("click", function(){

        $.ajax({
            url: "/admin/stats/export",
            method: 'GET',
            // data: {checked: checked},
            success: function(res) {
                //alert(res);
                //alert('9');
                // $('#top-products-list').html(res);
            },
            error: function(){
                alert("error");
            }
        });

    });
});