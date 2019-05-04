$( document ).ready(function() {

    $('.admin-filter-input').on("input", function(){
        var field = $(this).data("name");
        var table = $(this).data("table");
        var value = $(this).val();

        $.ajax({
            url: "/admin/ajax/filer_table",
            method: 'POST',
            data: {table: table, field: field, value: value},
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


    $('.add-new-property').on("click", function(){
        $.ajax({
            url: "/admin/products/add-new-property",
            method: 'POST',
            success: function(res) {
                $('#new-properties').append(res);
            },
            error: function(){
                alert("error");
            }
        });
    });

    $('.add-new-image').on("click", function(){
        $.ajax({
            url: "/admin/products/add-new-image",
            method: 'POST',
            success: function(res) {
                $('#new-images').append(res);
            },
            error: function(){
                alert("error");
            }
        });
    });

    $(document).on('click', '.delete-image', function(){
        $(this).parents(".product-image").html("");
    });

    $(document).on('click', '.delete-property', function(){
        $(this).parents(".product-property").html("");
    });
});