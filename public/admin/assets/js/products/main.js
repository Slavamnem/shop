$( document ).ready(function() {
    $('.generate-slug').on("click", function(){

        var name = $('#name').val();

        //alert(name);

        $.ajax({
            url: "/admin/ajax/translate",
            method: 'POST',
            data: {value: name},
            success: function(res) {
                //alert("success");
                $('#slug').val(res);
            },
            error: function(){
                //alert("error");
            }
        });

    });
});