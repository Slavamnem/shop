$( document ).ready(function() {

    $("#search_command").on("input", function(){

            var value = $(this).val();

            $.ajax({
                url: "/admin/commands/search",
                method: 'POST',
                data: {value: value},
                success: function(res) {
                    $('#filtered_commands').html(res);
                },
                error: function(){
                    alert("error");
                }
            });

    });

    $(document).on('click', '.command_list_item', function(){
        if ($(this).data("checked") == false) {
            $('.command_list_item').css('background-color', 'grey');
            $('.command_list_item').data('checked', false);

            $(this).data("checked", true);
            $(this).css('background-color', '#2ec551');
            $('#search_command').val($(this).data("code"));
        } else {
            $(this).data("checked", false);
            $(this).css('background-color', 'grey');
            $('#search_command').val("");
        }
    });

    $(document).on('click', '#execute-command', function(){
        $('.command-worksheet').html("");
        $('#loader').show();

        var commandCode = $("#search_command").val();
        // тут аджакс запрос для выполнения команды
        $.ajax({
            url: "/admin/commands/execute",
            method: 'POST',
            data: {commandCode: commandCode},
            success: function(res) {
                $('.command-worksheet').html(res);
                $('#loader').hide();
            },
            error: function(){
                alert("error");
            }
        });
    });

    //examples
    $('.admin-filter-input').on("input", function(){
        var field = $(this).data("name");
        var value = $(this).val();

        $.ajax({
            url: "/admin/groups/filter",
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

    $('.generator').on("change", function(){

        if ($(this).is(':checked')) {
            $.ajax({
                url: "/admin/groups/modifications",
                method: 'POST',
                success: function(res){
                    $('.variations').html(res);
                },
                error: function(){
                }
            });
        } else {
            $('.variations').html("");
        }
    });
});