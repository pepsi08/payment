$(document).ready(function () {

    //input mask CURD NUMBER
    $('[name=curd_number_face]').mask('9999 9999 9999 9999').keyup(function () {
        $('[name=curd_number]').val($(this).val().replace(/\D/g, ''));
    });
    //input mask MOBILE NUMBER
    $('.phone').mask('+38(999) 999 9999').keyup(function () {
        $('[name=mobile]').val('+' + $(this).val().replace(/\D/g, ''));
    });
    //input mask DATE EXPIRATION
    $('[name=date]').mask('9999/99/99', {placeholder: "yyyy/mm/dd"});

    //Ajax validation
    $('#payment-form').submit(function () {
        var result = false;
        $.ajax({
            type: 'post',
            url: './validate/payment',
            data: $(this).serialize(),
            dataType: 'json',
            async: false,
            success: function (response) {
                result = response;
            },
            error: function (response, textStatus, errorThrown) {
                var errors = JSON.parse(response.responseText);
                $('.error').html('');
                $.each(errors, function (key, value) {
                    $('.error-' + key).html(value[0]);
                });
            }
        });
        return result;
    });

});