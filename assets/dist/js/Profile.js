$(function () {
    // $('#err').hide();
    $('.toggle-password').click(function () {
        // console.log('clicked');
        thisPassword = $(this).parent().find('input');
        if (thisPassword != null && thisPassword != undefined) {
            if (thisPassword.attr('type') == 'password') {
                $(this).html('<i class="fa fa-eye-slash"></i>');
                thisPassword.attr('type', 'text');
            } else {
                $(this).html('<i class="fa fa-eye"></i>');
                thisPassword.attr('type', 'password');
            }
        }
    });

    $("input[name='confirm_password']").keyup(function(){
        if($(this).val() != $("input[name='password']").val()){
            $('#err').show('slow');
            $('#submit').prop("disabled", true);
            //more processing here
        } else {
            $('#err').hide('slow');
            $('#submit').prop("disabled", false);
        }
    });
});