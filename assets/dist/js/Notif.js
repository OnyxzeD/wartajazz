$(function () {
    // $('.artist').is(':focus');
    $('#userElem').hide();
    $('.users').click(function () {
        $('#modal_users').modal();
    });


    $("select[name='type']").change(function () {
        if ($("select[name='type']").val() == 'single') {
            $('#userElem').show('slow');
        } else {
            $('#userElem').hide('slow');
        }
    });
});

function pick(data)
{
    $('#username').val(data);
    $('#modal_users').modal('toggle');
}

function Postsubmit(resp) {
    // $.unblock();
    $.unblockUI();
    if (resp.error == true) {
        $('#modal_alert_label').empty().append('<span style="color:red"><i class="fa fa-exclamation-triangle"></i> Kesalahan</span>');
        $('#modal_alert_content').empty().append(resp.message);
        $('#modal_alert').modal();
    } else {
        $('#modal_alert_label').empty().append('<span style="color:green"><i class="fa fa-exclamation-triangle"></i> Berhasil</span>');
        $('#modal_alert_content').empty().append(resp.message);
        $('#modal_alert').modal();
        location.reload();
    }
}

function cekInput() {
    if ($("input[name='outlet-nama']").val() == '') {
        $('#modal_alert_label').empty().append('<span style="color:red"><i class="fa fa-exclamation-triangle"></i> Kesalahan</span>');
        $('#modal_alert_content').empty().append('Nama Outlet Wajib Diisi');
        $('#modal_alert').modal();
    }
    else {
        return true;
    }
}

function setTime() {
    var tgl = $('#reservationtime').val();
    var t = tgl.split(" - ");
    console.log(t[0]);
    var d = new Date(t[0]);
    $('.timepicker').each(function () {
        $(this).timepicker('setTime', d);
        /*$(this).timepicker({
            setTime: d,
            showMeridian: false
        });*/
        d.setHours(d.getHours() + 1);
    });
}