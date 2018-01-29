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
/******/ 	return __webpack_require__(__webpack_require__.s = 188);
/******/ })
/************************************************************************/
/******/ ({

/***/ 188:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(189);


/***/ }),

/***/ 189:
/***/ (function(module, exports) {

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

window.openFoto = function (id) {

    window.axios.get(base_url + '/api/penyakit/laporan/detail/' + id).then(function (result) {

        var detail = result.data.data;
        var foto = detail.foto ? detail.foto.split(',') : undefined;

        if (foto) {
            $.each(foto, function (i, _foto) {
                carousel.indicator.append('<li data-slide-to="' + i + '" data-target="#detail" class="' + (i == 0 ? 'active' : '') + '"></li>');

                var marshallFoto = _foto.replace("uploads/", "");

                carousel.inner.append('<div class="item ' + (i == 0 ? 'active' : '') + '">\n' + '<img alt="image" class="img-responsive" src="' + base_url + '/media/' + marshallFoto + '">\n' + '<div class="carousel-caption">\n' + '<p>' + detail.keterangan + '</p>\n' + '</div>\n' + '</div>');
            });
        }

        $("#modal_foto").modal();
    }).catch(logError);
};

$("#modal_foto").on('hide.bs.modal', function () {
    carousel.indicator.empty();
    carousel.inner.empty();
});

$(document).ready(function () {

    $("#modal_foto").on('show.bs.modal', function (e) {
        var foto = $(this).data('foto');
        var imgFoto = $("#foto");

        imgFoto.attr('src', base_url + '/media' + foto);
    });

    tableDetail = {
        el: $("#table-detail-laporan"),
        evt: {},
        init: function init() {
            var self = this;

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
        swal("Berhasil!", "Laporan sudah dihapus.", "success");
    });
};

/***/ })

/******/ });