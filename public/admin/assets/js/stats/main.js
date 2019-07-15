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
});