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

    var conditionId = 0;

    $('.add-new-condition').on("click", function(){
        var type = $(this).data('type');

        if (type == "or") {
            $('.delimiter').html("ИЛИ");
            $('.delimiter').val("or");
        } else {
            $('.delimiter').html("И");
            $('.delimiter').val("and");
        }
        //alert(conditionId);
        $.ajax({
            url: "/admin/shares/addNewCondition",
            method: 'POST',
            data: {type: type, conditionId: conditionId},
            success: function(res) {
                $('#new-conditions').append(res);
                conditionId++;
            },
            error: function(){
                alert("error");
            }
        });
    });

    $(document).on('click', '.delimiter', function(){
        if ($(this).val() == "or") {
            $('.delimiter-button').html("И");
            $('.delimiter-button').val("and");
            $('.delimiter').val("and");
        } else {
            $('.delimiter-button').html("ИЛИ");
            $('.delimiter-button').val("and");
            $('.delimiter').val("or");
        }
    });

    $(document).on('change', '.condition', function(){
        var field = $(this).val();
        var condition_id = $(this).data("id");
        //alert(condition_id);

        $.ajax({
            url: "/admin/shares/addNewConditionValues",
            method: 'POST',
            data: {field: field},
            success: function(res) {
                //alert(res);
                // var container = $(this).parents(".share-condition");
                // console.log(container.children());
                // container.children(".values-section").html(res);
                //if (res) {
                    $('.new-values-section-' + condition_id).html(res);
                //}
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