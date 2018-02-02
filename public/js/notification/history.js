webpackJsonp([7],{

/***/ "./resources/assets/js/notification/history/index.js":
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {var _dataTable;
var table, kecamatan;
window.dinkes = function () {

    function init() {
        initTable();
    }

    function initTable() {
        table = {
            el: $("#table-dinkes"),
            evt: {},
            init: function init() {
                var self = this;

                self.el.DataTable();
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
});
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__("./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ 8:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/assets/js/notification/history/index.js");


/***/ })

},[8]);