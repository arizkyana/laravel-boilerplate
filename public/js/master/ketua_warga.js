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
/******/ 	return __webpack_require__(__webpack_require__.s = 211);
/******/ })
/************************************************************************/
/******/ ({

/***/ 211:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(212);
module.exports = __webpack_require__(213);


/***/ }),

/***/ 212:
/***/ (function(module, exports) {

var _dataTable;
var table, kecamatan;
window.dinkes = function () {

    function init() {
        console.log('init table');
        initTable();
    }

    function initTable() {
        table = {
            el: $("#table-dinkes"),
            evt: {},
            init: function init() {
                var self = this;

                _dataTable = self.el.DataTable({
                    processing: true,
                    serverSide: true,
                    saveState: true,
                    ajax: {
                        url: base_url + '/api/master/ketua_warga',
                        method: 'post'
                    },
                    columns: [{
                        data: 'id',
                        name: 'ketua_warga.id',
                        render: function render(data, type, row, meta) {
                            console.log(meta);
                            return data;
                        }
                    }, {
                        data: 'nama',
                        name: 'ketua_warga.nama',
                        render: function render(data, type, row, meta) {
                            var link = '<a class="text-danger no-underline" href="' + base_url + '/master/ketua_warga/' + row.id + '/edit">' + data + '</a>';
                            return link;
                        }
                    }, {
                        data: 'alamat',
                        name: 'ketua_warga.alamat'
                    }, {
                        data: 'ketua',
                        name: 'ketua_warga.ketua',
                        render: function render(data, type, row, meta) {
                            var ketua = data == 1 ? 'RT ' + (row.rt ? row.rt : '') : 'RW ' + (row.rw ? row.rw : '');
                            return ketua;
                        }
                    }, {
                        data: 'masa_bakti_mulai',
                        name: 'ketua_warga.masa_bakti_mulai'
                    }, {
                        data: 'masa_bakti_akhir',
                        name: 'ketua_warga.masa_bakti_akhir'
                    }, {
                        data: 'telepon',
                        name: 'ketua_warga.telepon'
                    }, {
                        data: 'id',
                        name: 'ketua_warga.id',
                        orderable: false,
                        searchable: false,
                        render: function render(data, type, row, meta) {
                            var link = '<a class="btn btn-danger btn-sm" onclick="remove(' + data + ')"><i class="fa fa-trash"></i></a>';
                            return link;
                        }
                    }]
                });
            },
            reDraw: function reDraw(param) {
                _dataTable.ajax.url(param).load();
                _dataTable.draw(true);
            }
        };

        table.init();
    }

    return {
        init: init
    };
}();

$(document).ready(function () {
    window.dinkes.init();
    console.log(_dataTable.ajax.url());

    $("#kelurahan-ketua-warga").on('change', function (e) {
        e.preventDefault();

        var param = $("#form-filter").serialize();
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
            data: { id: id }
        }).then(function (result) {
            swal("Berhasil!", "Ketua Warga sudah dihapus.", "success");
            _dataTable.reDraw($("#form-filter").serialize());
        }, logError);
    });
};

/***/ }),

/***/ 213:
/***/ (function(module, exports) {

        throw new Error("Module build failed: Error: ENOENT: no such file or directory, open 'D:\\xampp\\htdocs\\laravel-boilerplate\\resources\\assets\\js\\master\\ketua_warga\\create.js'\n    at Error (native)");

/***/ })

/******/ });