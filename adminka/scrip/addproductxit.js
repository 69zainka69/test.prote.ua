$(document).ready(function() {

    $('#sendred').click(function() {

        $.ajax({
            url: "https://prote.ua/adminka/scrip/addproductaction.php",
            type: "POST",
            cashe: false,
            data: {

                token: $('#token').val(),
                method: $('#method').val(),
                url: $('#url').val(),
                new_child: $('#new_child').val(),

            },
            success: function(data) {
                $('#one').html(data);
            }
        });
    });
});