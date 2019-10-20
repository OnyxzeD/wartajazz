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