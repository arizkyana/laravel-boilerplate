var formCariWarga;
var btnCariSubmitWarga;
$(document).ready(function () {

    $("select[name=role]").select2();

    formCariWarga = $("form[name=form-cari-warga]");
    formCariWarga.submit(function (e) {
        e.preventDefault();

        btnCariSubmitWarga.ladda('start');

        window.axios.post(base_url + '/api/disduk', {
            nik: $("input[name=nik]").val(),
            kk: $("input[name=kk]").val()
        }).then(function (result) {
            console.log(result);

            if (result.data.status == 0) {
                swal({
                    type: 'error',
                    title: result.data.data,
                    text: result.data.data
                });
                btnCariSubmitWarga.ladda('stop');
                return;
            }

            btnCariSubmitWarga.ladda('stop');

            swal({
                type: 'success',
                title: 'Berhasil!',
                text: 'Warga di temukan'
            }, function () {


                $("input[name=no_ktp]").val(result.data.data.nik);
                $("input[name=nama]").val(result.data.data.nama);

                if (result.data.data.jenis_kelamin == 'LAKI-LAKI') {
                    $($("input[name=jenis_kelamin]")[0]).attr('checked', 'checked');
                } else {
                    $($("input[name=jenis_kelamin]")[1]).attr('checked', 'checked');
                }

                $("#modal-disduk").modal('hide');


            });


        }).catch(logError);
    });


    // btnCariSubmitWarga.click(function () {
    //     btnCariSubmitWarga.ladda('start');
    // });

});

$("#modal-disduk").on('show.bs.modal', function () {
    btnCariSubmitWarga = $('.ladda-button-demo').ladda();
});

$("#modal-disduk").on('hide.bs.modal', function () {
    $("input[name=kk]").val(null);
    $("input[name=nik]").val(null);
});