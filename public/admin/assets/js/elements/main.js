$( document ).ready(function() {

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