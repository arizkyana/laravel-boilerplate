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
/******/ 	return __webpack_require__(__webpack_require__.s = 43);
/******/ })
/************************************************************************/
/******/ ({

/***/ 43:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(44);
__webpack_require__(46);
module.exports = __webpack_require__(47);


/***/ }),

/***/ 44:
/***/ (function(module, exports, __webpack_require__) {


var modal = {
    kategori: __webpack_require__(45)
};

$(document).ready(function () {
    console.log('create buku');
});

/***/ }),

/***/ 45:
/***/ (function(module, exports) {

var modalKategori = {
    el: $("#modal-kategori"),
    evt: {
        onShow: function onShow(e) {
            // alert('modal kategori on show');
        },
        onHide: function onHide(e) {
            // alert('modal kategori on hide');
        }
    }
};

var formKategori = {
    el: $("form[name=form-kategori]"),
    evt: {
        submit: function submit(e) {
            e.preventDefault();
            var data = $(this).serialize();

            return;
        }
    }
};

modalKategori.el.on('show.bs.modal', modalKategori.evt.onShow);
modalKategori.el.on('hide.bs.modal', modalKategori.evt.onHide);

formKategori.el.submit(formKategori.evt.submit);

module.exports = modalKategori;

/***/ }),

/***/ 46:
/***/ (function(module, exports) {

console.log("buku edit");

/***/ }),

/***/ 47:
/***/ (function(module, exports) {

console.log("buku index");

/***/ })

/******/ });