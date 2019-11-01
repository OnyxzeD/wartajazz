var totalArtist = 2;
var temp = 0;
$(function () {
    var rupiah = document.getElementById("rupiah");
    rupiah.addEventListener("keyup", function (e) {
        rupiah.value = formatRupiah(this.value, "Rp ");
    });
});

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
    // console.log(t[0]);
    var d = new Date(t[0]);
    $('.timepicker').each(function () {
        $(this).timepicker('setTime', d);
        d.setHours(d.getHours() + 1);
    });
}

function showModal(int) {
    temp = int;
    $('#modal_artist').modal();
    console.log("artist : " + temp);
}

function pilih(id, artist) {
    $('#artist-id-' + temp).val(id);
    $('#artist-name-' + temp).val(artist);
    temp = 0;
    $('#modal_artist').modal('toggle');
}

function addElem() {
    totalArtist++;
    $("#artist-" + (totalArtist - 1)).after("" +
        "<div id='artist-" + totalArtist + "'>" +
        "   <div class='col-md-6'>" +
        "       <div class='form-group'>" +
        "           <label> &nbsp; </label>" +
        "           <div class='input-group'>" +
        "               <input type='hidden' id='artist-id-" + totalArtist + "' name='artist_id[]'>" +
        "               <input type='text' id='artist-name-" + totalArtist + "' class='form-control pull-left artist' name='artist[]' onclick='showModal(" + totalArtist + ")'>" +
        "               <div class='input-group-addon'>" +
        "                   <i class='fa fa-user'></i>" +
        "               </div>" +
        "           </div>" +
        "       </div>" +
        "   </div>" +
        "   <div class='col-md-6'>" +
        "       <div class='form-group'>" +
        "           <label> &nbsp; </label>" +
        "           <div class='input-group'>" +
        "               <input type='text' class='form-control timepicker' name='show[]'>" +
        "               <div class='input-group-addon'>" +
        "                   <i class='fa fa-clock-o'></i>" +
        "               </div>" +
        "           </div>" +
        "       </div>" +
        "   </div>" +
        "</div>");

    $('.timepicker').timepicker({
        showInputs: false,
        showMeridian: false
    });

    setTime();
}