webpackJsonp([8],{

/***/ "./resources/assets/js/menu/index.js":
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {

var table = {};
$(document).ready(function () {
    table = {
        el: $("#table-menu"),
        evt: {},
        init: function init() {
            var self = this;
            // console.log(self);
            self.el.DataTable({
                saveState: true
            });
        }
    };

    table.init();
});
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__("./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ 4:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/assets/js/menu/index.js");


/***/ })

},[4]);