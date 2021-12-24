$(document).ready(function() {

    $('#sendredel0').click(function() {

            $.ajax({
                url: "https://prote.ua/adminka/scrip/addproductaction.php",
                type: "POST",
                cashe: false,
                data: {

                    token: $('#token0').val(),
                    method: $('#method0').val(),
                    url: $('#url0').val(),
                    prodid: $('#prodid0').val(),

                },
                success: function(data) {
                    $('#one').html(data);
                }
            });
        }



    );
});

$(document).ready(function() {

    $('#sendredel1').click(function() {

            $.ajax({
                url: "https://prote.ua/adminka/scrip/addproductaction.php",
                type: "POST",
                cashe: false,
                data: {

                    token: $('#token1').val(),
                    method: $('#method1').val(),
                    url: $('#url1').val(),
                    prodid: $('#prodid1').val(),

                },
                success: function(data) {
                    $('#one').html(data);
                }
            });
        }



    );
});