var reader = new FileReader();

$(document).ready(function () {

    $("#addManager").submit(function (event) {
        $("#modal-manager").block();
        event.preventDefault();
        var form_data = new FormData();
        var $form = $("#addManager");
        var outlet = $form.find("select[name='outlet-id']").val();
        var photo = $form.find("input[name='manager-photo']").val();
        if ((outlet == 'pilih') || (photo == '')) {
            $('#modal_alert_label').empty().append('<span style="color:red"><i class="fa fa-exclamation-triangle"></i> Kesalahan</span>');
            $('#modal_alert_content').empty().append("Harap lengkapi data");
            $('#modal_alert').modal();
        } else {
            var data = {
                manager_username: $form.find("input[name='manager-username']").val(),
                manager_email: $form.find("input[name='manager-email']").val(),
                outlet_id: outlet,
                manager_fullname: $form.find("input[name='manager-fullname']").val(),
                manager_phone: $form.find("input[name='manager-phone']").val(),
                manager_photo: $("#manager-photo")[0].files[0]
            };

            $.each(data, function (key, value) {
                form_data.append(key, value);
            });

            $.ajax({
                method: "POST",
                url: baseurl + '/Partner/Users/create',
                data: form_data,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data);
                    if (data.Status == 'success') {
                        window.location.reload();
                    }
                },
                error: function (data) {

                }
            }).always(function () {
                $("#modal-manager").unblock();
            });
        }
    });

    // $("#editTroubleshoot").click(function (event) {
    //     event.preventDefault();
    //     var $form = $("#editForm"),
    //         id = $form.find("input[name='id']").val(),
    //         w_tanggal = $form.find("input[name='w_tanggal']").val(),
    //         w_mulai = $form.find("input[name='w_mulai']").val(),
    //         w_selesai = $form.find("input[name='w_selesai']").val(),
    //         w_pakai = $form.find("input[name='w_pakai']").val(),
    //         cp = $form.find("input[name='cp']").val(),
    //         product = $form.find("input[name='product']").val(),
    //         priority = $form.find("select[name='priority']").val(),
    //         status = $form.find("input[name='status']").val(),
    //         topic = $form.find("textarea[name='topic']").val(),
    //         issue_desc = $form.find("textarea[name='issue_desc']").val(),
    //         prob_solv = $form.find("textarea[name='prob_solv']").val(),
    //         tech = $form.find("input[name='tech']").val();
    //
    //     $.ajax({
    //         method: "POST",
    //         url: '/editPost',
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         data: {
    //             id: id,
    //             tanggal: w_tanggal,
    //             mulai: w_mulai,
    //             selesai: w_selesai,
    //             pakai: w_pakai,
    //             cp: cp,
    //             product: product,
    //             priority: priority,
    //             status: status,
    //             topic: topic,
    //             issue_desc: issue_desc,
    //             prob_solv: prob_solv,
    //             tech: tech
    //         },
    //         success: function (data) {
    //             if (data.errors) {
    //                 window.alert(data.message);
    //             } else {
    //                 window.alert(data.message);
    //                 $('#modal-edit').modal('toggle');
    //                 getList();
    //             }
    //         },
    //         error: function (data) {
    //
    //         }
    //     });
    // });
});

function Add() {

    $.ajax({
        method: "GET",
        url: baseurl + '/Partner/Users/modalCreate',
        data: {}
    })
        .done(function (data) {
            // console.log(data);
            $("#modal-title").html("Tambah Manajer");
            $("#editBody").html(data);
            $("#modal-manager").modal('show');
        });


}

function readURL(input) {
    var fileTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if (input.files && input.files[0]) {
        var extension = input.files[0].name.split('.').pop().toLowerCase(),  //file extension from input file
            isSuccess = fileTypes.indexOf(extension) > -1;  //is extension in acceptable types

        if (isSuccess) { //yes
            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
                $('#preview').attr('style', "width: 200px; height: auto");
            };

            reader.readAsDataURL(input.files[0]);
        }
        else {
            alert('File harus bertipe gambar!');
            var $form = $("#addManager");
            $form.find("input[name='manager-photo']").val('')
        }
    }
}