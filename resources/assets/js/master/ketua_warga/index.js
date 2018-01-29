var _dataTable;
var table,
    kecamatan;
window.dinkes = (function () {

    function init() {
        console.log('init table');
        initTable();
    }

    function initTable() {
        table = {
            el: $("#table-dinkes"),
            evt: {},
            init: function () {
                const self = this;

                _dataTable = self.el.DataTable({
                    processing: true,
                    serverSide: true,
                    saveState: true,
                    ajax: {
                        url: base_url + '/api/master/ketua_warga',
                        method: 'post'
                    },
                    columns: [
                        {
                            data: 'id',
                            name: 'ketua_warga.id',
                            render: function (data, type, row, meta) {
                                console.log(meta);
                                return data;
                            }
                        },
                        {
                            data: 'nama',
                            name: 'ketua_warga.nama',
                            render: function (data, type, row, meta) {
                                let link = '<a class="text-danger no-underline" href="' + base_url + '/master/ketua_warga/' + row.id + '/edit">' + data + '</a>';
                                return link;
                            }
                        },
                        {
                            data: 'alamat',
                            name: 'ketua_warga.alamat'
                        },
                        {
                            data: 'ketua',
                            name: 'ketua_warga.ketua',
                            render: function (data, type, row, meta) {
                                let ketua = data == 1 ? 'RT ' + (row.rt ? row.rt : '') : 'RW ' + (row.rw ? row.rw : '');
                                return ketua;
                            }
                        },
                        {
                            data: 'masa_bakti_mulai',
                            name: 'ketua_warga.masa_bakti_mulai'
                        },
                        {
                            data: 'masa_bakti_akhir',
                            name: 'ketua_warga.masa_bakti_akhir'
                        },
                        {
                            data: 'telepon',
                            name: 'ketua_warga.telepon'
                        },
                        {
                            data: 'id',
                            name: 'ketua_warga.id',
                            orderable: false,
                            searchable: false,
                            render: function (data, type, row, meta) {
                                let link = '<a class="btn btn-danger btn-sm" onclick="remove(' + data + ')"><i class="fa fa-trash"></i></a>';
                                return link;
                            }
                        }
                    ]
                });
            },
            reDraw: function (param) {
                _dataTable.ajax.url(param).load();
                _dataTable.draw(true);
            }
        };

        table.init();
    }


    return {
        init: (init)
    }
})();

$(document).ready(function () {
    window.dinkes.init();
    console.log(_dataTable.ajax.url());

    $("#kelurahan-ketua-warga").on('change', function (e) {
        e.preventDefault();

        let param = $("#form-filter").serialize();
        table.reDraw(base_url + '/api/master/ketua_warga?' + param);

    });
});

window.remove = function (id) {
    event.preventDefault();

    swal({
        title: "Apakah Anda Yakin?",
        text: "Ketua Warga yang sudah di hapus tidak dapat di kembalikan!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: 'Batal',
        closeOnConfirm: false,
        html: false
    }, function () {
        $.ajax({
            url: base_url + '/api/master/ketua_warga/destroy',
            method: 'post',
            data: {id: id}
        }).then(function (result) {
            swal("Berhasil!",
                "Ketua Warga sudah dihapus.",
                "success");
            _dataTable.reDraw($("#form-filter").serialize());
        }, logError);

    });
};