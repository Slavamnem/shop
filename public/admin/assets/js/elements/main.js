$( document ).ready(function() {

    $('.admin-filter-input').on("input", function(){
        var field = $(this).data("name");
        var value = $(this).val();

        $.ajax({
            url: "/admin/site-elements/filter",
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

    $(document).on('change', '#element-type', function(){
        var type = $(this).val();
        var key = $('#element-key').val();

        $.ajax({
            url: "/admin/site-elements/getValueBlock",
            method: 'POST',
            data: {type: type, key: key},
            success: function(res) {
                $('#value-block').html(res);
            },
            error: function(){
                alert("error");
            }
        });
    });

});