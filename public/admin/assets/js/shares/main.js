$( document ).ready(function() {

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

    $('.add-new-condition').on("click", function(){
        var type = $(this).data('type');

        $.ajax({
            url: "/admin/shares/addNewCondition",
            method: 'POST',
            data: {type: type},
            success: function(res) {
                $('#new-conditions').append(res);
            },
            error: function(){
                alert("error");
            }
        });
    });

    $(document).on('change', '.condition', function(){
        var field = $(this).val();
        //alert(field);

        $.ajax({
            url: "/admin/shares/addNewConditionValues",
            method: 'POST',
            data: {field: field},
            success: function(res) {
                //alert(res);
                // var container = $(this).parents(".share-condition");
                // console.log(container.children());
                // container.children(".values-section").html(res);
                if (res) {
                    $('.values-section').html(res);
                }
            },
            error: function(){
                alert("error");
            }
        });
    });

    $(document).on('click', '.delete-condition', function(){
        $(this).parents(".share-condition").html("");
    });

});