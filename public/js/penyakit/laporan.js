/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 185);
/******/ })
/************************************************************************/
/******/ ({

/***/ 185:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(186);
module.exports = __webpack_require__(187);


/***/ }),

/***/ 186:
/***/ (function(module, exports) {

/**
 * Created by agungrizkyana on 10/21/17.
 */
var table = {};
var filter = {};
var _dataTable = {};
(function () {

    table = {
        el: $("#table-laporan-jumantik"),
        evt: {},
        init: function init() {
            var self = this;

            _dataTable = self.el.DataTable({
                processing: true,
                serverSide: true,
                saveState: true,
                ajax: {
                    url: base_url + '/api/penyakit/laporan/ajax_laporan' + "?" + $("#form-filter").serialize(),
                    method: 'post',
                    complete: function complete(result) {
                        console.log(result);
                    }
                },
                order: [[0, 'desc']],
                createdRow: function createdRow(row, data) {
                    var text = "";
                    var bg = "";
                    switch (data.status) {
                        case 1:
                            text = 'Open';
                            bg = 'bg-primary';
                            break;
                        case 2:
                            text = 'Finish';
                            bg = 'bg-success';
                            break;
                        case 3:
                            text = 'On Going';
                            bg = 'bg-warning';
                            break;
                        case 4:
                            text = 'Surveyed';
                            bg = 'bg-info';
                            break;
                    }

                    $('td', row).eq(7).html(text).addClass(bg);
                    $('td', row).addClass('cursor-pointer');
                },
                columns: [{
                    data: 'created_at',
                    name: 'laporan.created_at',
                    searchable: false,
                    render: function render(data, type, row, meta) {
                        var html = '<a class="text-danger" href="' + base_url + '/penyakit/laporan/' + row.id + '/show">' + data + '</a>';
                        return html;
                    }
                }, {
                    data: 'pelapor',
                    name: 'users.name'

                }, {
                    data: 'tipe_pelapor',
                    name: 'role.name'

                }, { data: 'title', name: 'laporan.title' }, {
                    data: 'nama_penyakit',
                    name: 'penyakit.nama_penyakit'
                }, {
                    data: 'nama_tindakan',
                    name: 'tindakan.nama_tindakan'
                }, { data: 'nama_kecamatan', name: 'kecamatan.nama_kecamatan', visible: false }, { data: 'nama_kelurahan', name: 'kelurahan.nama_kelurahan', visible: false }, {
                    data: 'alamat',
                    name: 'laporan.alamat',
                    render: function render(data, type, row, meta) {
                        var html = '<small>' + row.nama_kelurahan + ", " + row.nama_kecamatan + '</small>';
                        return html;
                    }
                }, {
                    searchable: false,
                    data: 'status',
                    name: 'laporan.status'
                }]
            });

            $('#table-laporan-jumantik tbody').on('click', 'tr', function () {
                var data = _dataTable.row(this).data();
                console.log(data);
                window.location.href = base_url + '/penyakit/laporan/' + data.id + '/show';
                // alert( 'You clicked on '+data[0]+'\'s row' );
            });
        },
        redraw: function redraw(query) {
            var url = base_url + '/api/penyakit/laporan/ajax_laporan' + query;
            stopInterval();
            console.log('masuk clear interval');
            _dataTable.ajax.url(url).load(function (result) {
                startInterval();
                console.log("result load", result);
                // _dataTable.columns.adjust().draw(true);
            }, false);
        }
    };

    filter.tipePelapor = {
        el: $('#tipe_pelapor'),
        evt: {
            change: function change(e) {
                e.preventDefault();
                table.redraw("?" + $("#form-filter").serialize());
            }
        },
        init: function init() {
            var self = this;

            self.el.select2();

            self.el.change(self.evt.change);
        }
    };
    filter.penyakit = {
        el: $("#penyakit"),
        evt: {
            change: function change(e) {
                e.preventDefault();

                table.redraw("?" + $("#form-filter").serialize());
            }
        },
        init: function init() {
            var self = this;
            self.el.change(self.evt.change);
        }
    };
    filter.tanggalMulai = {
        el: $('#tanggal_mulai'),
        evt: {},
        init: function init() {
            var self = this;

            self.el.datepicker({
                autoclose: true,
                orientation: 'bottom'
            });
        }
    };
    filter.tanggalAkhir = {
        el: $('#tanggal_akhir'),
        evt: {
            change: function change(e) {
                e.preventDefault();
                table.redraw("?" + $("#form-filter").serialize());
            }
        },
        init: function init() {
            var self = this;

            self.el.datepicker({
                autoclose: true,
                orientation: 'bottom'
            });

            self.el.change(self.evt.change);
        }
    };

    filter.kecamatan = {
        el: $('#kecamatan'),
        evt: {
            change: function change(e) {
                e.preventDefault();
                table.redraw("?" + $("#form-filter").serialize());
            }
        },
        init: function init() {
            var self = this;

            self.el.select2();

            self.el.change(self.evt.change);
        }
    };

    filter.tanggalMulai.init();
    filter.tanggalAkhir.init();
    filter.tipePelapor.init();
    filter.penyakit.init();
    filter.kecamatan.init();
    table.init();
})();

window.deleteLaporan = function (id) {

    var confirms = confirm('Apakah anda yakin?');
    if (confirms) {
        $.ajax({
            url: base_url + '/api/penyakit/laporan/delete/' + id,
            method: 'get'

        }).then(function (result) {
            console.log(result);
            table.redraw("");
        }, logError);
    }
};

window.refresh = function () {
    table.redraw("");
};

var countInterval = 5;
var intervalID;
$(document).ready(function () {
    startInterval();
});

function startInterval() {
    countInterval = 5;
    intervalID = setInterval(function () {
        countInterval--;
        console.log(countInterval);

        if (countInterval === 0) {
            // console.log("do request / reload table");
            table.redraw("?" + $("#form-filter").serialize());
        }
    }, 3000);
}

function stopInterval() {
    clearInterval(intervalID);
}

/***/ }),

/***/ 187:
/***/ (function(module, exports) {

        throw new Error("Module build failed: Error: ENOENT: no such file or directory, open 'D:\\xampp\\htdocs\\laravel-boilerplate\\resources\\assets\\js\\penyakit\\laporan\\create.js'\n    at Error (native)");

/***/ })

/******/ });