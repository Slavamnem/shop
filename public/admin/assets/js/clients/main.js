$( document ).ready(function() {

    $('.admin-filter-input').on("input", function () {
        var field = $(this).data("name");
        var value = $(this).val();

        $.ajax({
            url: "/admin/clients/filter",
            method: 'POST',
            data: {field: field, value: value},
            success: function (res) {
                $('.tbody').html(res);
            },
            error: function () {
                alert("error");
            }
        });
    });

});