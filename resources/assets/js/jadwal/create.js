/**
 * Created by agungrizkyana on 11/9/17.
 */

window.jadwal = (function () {

    function initDatePicker() {
        let el = {
            tanggalMulai: $("#mulai"),
            tanggalAkhir: $("#akhir")
        };

        el.tanggalMulai.datepicker({
            orientation: 'top'
        });

        el.tanggalAkhir.datepicker({
            orientation: 'top'
        });

        return el;
    }

    function initClockPicker() {
        let el = {
            jamMulai: $("#jam_mulai"),
            jamAkhir: $("#jam_akhir")
        };

        el.jamMulai.clockpicker({
            placement: 'top',
            donetext: 'Done'
        });
        el.jamAkhir.clockpicker({
            placement: 'top',
            donetext: 'Done'
        });

        return el;
    }

    function init() {
        initClockPicker();
        initDatePicker();
    }

    return {
        init: (init)
    }
})();

var jenis = {};
var alamat = {};

$(document).ready(function () {
    window.jadwal.init();

    alamat = {
        el: $("#alamat"),
        clearOptions: function () {
            console.log('masuk clear option');
            this.el.empty();
        },
        addOptions: function (option) {
            this.el.append(option);
        },
        init: function () {
            this.el.select2();
        }
    };

    jenis = {
        el: $("#jenis"),
        evt: {
            change: function (e) {
                e.preventDefault();
                let _jenis = $(this).val();

                window.axios.get(base_url + '/api/jadwal/lokasi/' + _jenis)
                    .then(function (result) {
                        alamat.clearOptions();
                        alamat.addOptions('<option value=""></option>');
                        $.each(result.data.data, function (i, lokasi) {
                            let _namaLokasi = lokasi.name ? lokasi.name : lokasi.nama;
                            alamat.addOptions(
                                '<option value="' + lokasi.id + '">' + _namaLokasi + '</option>'
                            );
                        });
                        alamat.el.select2().trigger('change');
                    })
                    .catch(logError);
                return;


            }
        },
        init: function () {
            this.el.select2();
            this.el.change(this.evt.change);
        }
    };



    alamat.init();
    jenis.init();
});