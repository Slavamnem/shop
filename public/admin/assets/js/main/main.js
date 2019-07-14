$( document ).ready(function() {


    setInterval(function(){
        $.ajax({
            url: "/admin/notifications/check_new",
            method: 'GET',
            success: function(res) {
                if (res && res != 0) {
                    $('#new_notifications').html(res);
                    $('#new_notifications').modal();
                }
            },
            error: function(){
                alert("Ошибка обновления уведомлений");
            }
        });
    }, 10000);

    $(document).on('click', '.modal-backdrop', function(){
        $('#new_notifications').trigger('click');
    });
});