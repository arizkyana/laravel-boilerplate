webpackJsonp([3],{

/***/ "./resources/assets/js/apiClient/create.js":
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {

$(document).ready(function () {});
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__("./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./resources/assets/js/apiClient/edit.js":
/***/ (function(module, exports) {

console.log("buku users");

/***/ }),

/***/ "./resources/assets/js/apiClient/index.js":
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {var table = {};
$(document).ready(function () {
    table = {
        el: $("#table-api-client"),
        evt: {},
        init: function init() {
            var self = this;
            self.el.dataTable();
        }
    };

    table.init();
});
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__("./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ 3:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__("./resources/assets/js/apiClient/create.js");
__webpack_require__("./resources/assets/js/apiClient/edit.js");
module.exports = __webpack_require__("./resources/assets/js/apiClient/index.js");


/***/ })

},[3]);