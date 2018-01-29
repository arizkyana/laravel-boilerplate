var tableDetail = {};
// load map

var map;
var markers = {
    apartment: [],
    faskes: [],
    perkimtan: [],
    sekolah: [],
    perumahan: []
};

var carousel = {
    indicator: $("#detail > ol.carousel-indicators"),
    inner: $("#detail > div.carousel-inner")
};

window.openFoto = (id) => {

    window.axios.get(base_url + '/api/penyakit/laporan/detail/' + id)
        .then(function (result) {

            let detail = result.data.data;
            let foto = detail.foto ? detail.foto.split(',') : undefined;

            if (foto) {
                $.each(foto, function(i, _foto){
                    carousel.indicator.append(
                        '<li data-slide-to="' + i + '" data-target="#detail" class="' + (i == 0 ? 'active' : '') + '"></li>'
                    );

                    let marshallFoto = _foto.replace("uploads/", "");

                    carousel.inner.append(
                        '<div class="item ' + (i == 0 ? 'active' : '') + '">\n' +
                        '<img alt="image" class="img-responsive" src="' + base_url + '/media/' + marshallFoto + '">\n' +
                        '<div class="carousel-caption">\n' +
                        '<p>' + detail.keterangan + '</p>\n' +
                        '</div>\n' +
                        '</div>'
                    );
                });
            }

            $("#modal_foto").modal();
        })
        .catch(logError);
};

$("#modal_foto").on('hide.bs.modal', function(){
   carousel.indicator.empty();
   carousel.inner.empty();
});

$(document).ready(function () {

    $("#modal_foto").on('show.bs.modal', function (e) {
        const foto = $(this).data('foto');
        let imgFoto = $("#foto");

        imgFoto.attr('src', base_url + '/media' + foto);
    });

    tableDetail = {
        el: $("#table-detail-laporan"),
        evt: {},
        init: function () {
            let self = this;

            self.el.DataTable({
                order: [[0, 'desc']]
            });
        }
    };

    tableDetail.init();

});

window.remove = function (id) {
    event.preventDefault();

    swal({
        title: "Apakah Anda Yakin?",
        text: "Laporan yang sudah di hapus tidak dapat di kembalikan!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: 'Batal',
        closeOnConfirm: false,
        html: false
    }, function () {
        document.getElementById('delete-' + id).submit();
        swal("Berhasil!",
            "Laporan sudah dihapus.",
            "success");
    });
};