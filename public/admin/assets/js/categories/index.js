$( document ).ready(function() {

    $('.admin-filter-input').on("input", function(){
        var field = $(this).data("name");
        var value = $(this).val();

        $.ajax({
            url: "/admin/categories/filter",
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

    $('.generate-slug').on("click", function(){

        var name = $('#name').val();

        $.ajax({
            url: "/admin/ajax/translate",
            method: 'POST',
            data: {value: name},
            success: function(res) {
                //alert("success");
                $('#slug').val(res);
            },
            error: function(){
                alert("error");
            }
        });
    });
});