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
    var conditionsAmount = 0;

    $('.add-new-condition').on("click", function(){
        var delimiterType = $(this).data('type');

        if (delimiterType == "or") {
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
            data: {delimiterType: delimiterType, conditionId: conditionId, conditionsAmount: conditionsAmount},
            success: function(res) {
                $('#conditions').append(res);
                conditionId++;
                conditionsAmount++;
            },
            error: function(){
                alert("error");
            }
        });
    });

    $(document).on('click', '.delimiter-button', function(){
        if ($(this).html() == "ИЛИ") {
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
            url: "/admin/shares/loadConditionValues",
            method: 'POST',
            data: {field: field},
            success: function(res) {
                $('.values-section-' + condition_id).html(res);
            },
            error: function(){
                alert("error");
            }
        });
    });

    $(document).on('click', '.delete-condition', function(){
        $(this).parents(".share-condition").html("");
        conditionsAmount--;
    });

});