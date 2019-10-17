var no = 1;
var reader = new FileReader();
$(document).ready(function () {
    $('#effect').hide();
    $('#effect-bank').hide();
    $("#provinsi").change(function () {
        $.get("Home/add_ajax_kab/" + $(this).val(), function (data) {
            $('#kabupaten').children('option:not(:first)').remove();
            $.each(data, function (i) {
                $('#kabupaten').append($("<option value=" + data[i].id + ">" + data[i].nama + "</option>"));
            });
        });
    })
});

function readURL(input, type = 'ktp') {
    if (input.files && input.files[0]) {

        if (type == 'ktp') {
            reader.onload = function (e) {
                $('#img-preview').attr('src', e.target.result);
                $('#preview').hide();
                $('#foto_identitas').hide();
                $('#effect').show();
            };
        } else {
            reader.onload = function (e) {
                $('#preview-bank').hide();
                $('#img-preview-bank').attr('src', e.target.result);
                $('#foto_rekening').hide();
                $('#effect-bank').show();
            };
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function removeImage(type = 'ktp') {
    if (type == 'ktp') {
        reader = new FileReader();
        $('#effect').hide();
        $('#preview').show();
        $('#foto_identitas').show();
        $('#img-preview').attr('src', '');
    } else {
        $('#effect-bank').hide();
        $('#preview-bank').show();
        $('#foto_rekening').show();
        $('#img-preview-bank').attr('src', '');
    }
}

function addOutlet() {
    no++;
    $("#jumlah-outlet").val(no);
    $("#add-outlet-" + (no - 1)).hide('slow');
    $("#outlet-" + (no - 1)).after("" +
        "<div class=\"card border-default mb-3 text-center\" id='outlet-" + no + "'>" +
        "   <div class=\"card-header\" style=\"background-color: #337ab7; border-color: #2e6da4;\">" +
        "       <a class=\"collapsed card-link text-center\" data-toggle=\"collapse\" href='#outlet-collapse-" + no + "'>" +
        "           <h5 class=\"card-title text-white\">Data Outlet #" + no + "</h5>" +
        "           <h6 class=\"card-subtitle mb-2 text-white\">Informasi Tempat Usaha</h6>" +
        "       </a>" +
        "   </div>" +
        "   <div id='outlet-collapse-" + no + "' class=\"collapse\" data-parent=\"#accordion\">" +
        "       <div class=\"card-body text-left\">" +
        "           <div class=\"row form-group\">" +
        "               <div class=\"col-md-12\">" +
        "                   <label>Nama Outlet</label>" +
        "                   <input type=\"text\" class=\"form-control\" name='outlet-nama-" + no + "'>" +
        "               </div>" +
        "           </div>" +
        "           <div class=\"row form-group\">" +
        "               <div class=\"col-md-12\">" +
        "                   <label>Telp Outlet</label>" +
        "                   <input type=\"text\" class=\"form-control\" onkeydown='validateNumber(event)' pattern=\"\\d*\" maxlength='12' name='outlet-telp-" + no + "'/>" +
        "               </div>" +
        "           </div>" +
        "           <div class=\"row form-group\" id='add-outlet-" + no + "'>" +
        "               <div class=\"col-md-9\">" +
        "                   <button type=\"button\" class=\"btn btn-primary col-md-12\" onclick='addOutlet()'>" +
        "                       <span><i class='fa fa-plus'></i>&nbsp; </span> Tambah Outlet" +
        "                   </button>" +
        "               </div>" +
        "               <div class=\"col-md-3\">" +
        "                   <button type=\"button\" class=\"btn btn-danger col-md-12\" onclick='removeOutlet()'>" +
        "                       <span><i class='fa fa-trash'></i>&nbsp; </span> Hapus Outlet" +
        "                   </button>" +
        "               </div>" +
        "           </div>" +
        "       </div>" +
        "   </div>" +
        "</div>" +
        "");
    $("#outlet-collapse-" + (no - 1)).removeClass('show');
    $("#outlet-collapse-" + no).addClass('show');
}

function removeOutlet() {
    $("#add-outlet-" + (no - 1)).show('slow');
    $("#outlet-" + no).remove();
    $("#outlet-collapse-" + (no - 1)).addClass('show');
    no--;
    $("#jumlah-outlet").val(no);
}
