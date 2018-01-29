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
/******/ 	return __webpack_require__(__webpack_require__.s = 225);
/******/ })
/************************************************************************/
/******/ ({

/***/ 225:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(226);


/***/ }),

/***/ 226:
/***/ (function(module, exports) {

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

/***/ })

/******/ });