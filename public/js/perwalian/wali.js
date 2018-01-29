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
/******/ 	return __webpack_require__(__webpack_require__.s = 212);
/******/ })
/************************************************************************/
/******/ ({

/***/ 212:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(213);
__webpack_require__(214);
module.exports = __webpack_require__(215);


/***/ }),

/***/ 213:
/***/ (function(module, exports) {

var table = {};
var _datatable = void 0;
$(document).ready(function () {
    table = {
        el: $("#table-users"),
        evt: {},
        redraw: function redraw() {
            _datatable.ajax.url(base_url + '/api/perwalian/ajax_wali').load();
            _datatable.draw();
        },
        init: function init() {
            var self = this;
            _datatable = self.el.DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: base_url + '/api/perwalian/ajax_wali',
                    method: 'post'
                },
                createdRow: function createdRow(row) {
                    $('td', row).eq(2).addClass('text-center');
                },
                columns: [{
                    data: 'created_at',
                    name: 'wali.created_at'
                }, {
                    data: 'nama',
                    name: 'pengajar.nama',
                    render: function render(data, type, row, meta) {
                        return "<a class='text-danger' href='" + base_url + "/perwalian/wali/" + row.id + "/edit'>" + row.gelar_depan + ' ' + data + ' ' + row.gelar_belakang + "</a>";
                    }
                }, {
                    data: 'id',
                    name: 'wali.id',
                    render: function render(data, type, row, meta) {
                        return "<button onclick='remove(" + row.id + ")' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></button>";
                    }
                }]
            });
        }
    };

    table.init();
});

window.remove = function (id) {
    event.preventDefault();

    swal({
        title: "Apakah Anda Yakin?",
        text: "Fakultas yang sudah di hapus tidak dapat di kembalikan!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: 'Batal',
        closeOnConfirm: false,
        html: false
    }, function () {

        window.axios.post(base_url + '/api/master/fakultas/' + id + '/destroy', {
            id: id
        }).then(function () {
            swal("Berhasil!", "Fakultas sudah dihapus.", "success");
            table.redraw();
        }).catch(window.logError);
    });
};

/***/ }),

/***/ 214:
/***/ (function(module, exports) {

throw new Error("Module build failed: Error: ENOENT: no such file or directory, open 'D:\\xampp\\htdocs\\edu\\resources\\assets\\js\\perwalian\\wali\\create.js'\n    at Error (native)");

/***/ }),

/***/ 215:
/***/ (function(module, exports) {

var form = {
    api: {
        scope: {}
    }
};

$(document).ready(function () {

    form.api.scope = {
        el: $("#client_scope"),
        evt: {
            onChange: function onChange(e) {
                e.preventDefault();
                return;
            }
        },
        init: function init() {
            var self = this;
            self.el.select2({
                placeholder: 'Pilih Scope'
            });
        }
    };
});

/***/ })

/******/ });