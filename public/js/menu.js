webpackJsonp([8],{

/***/ "./resources/assets/js/menu/index.js":
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {
var table = {};
var parents = void 0;
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

    // alert('tes');
    $('select[name=parent]').select2();
});

window.remove = function (id) {
    event.preventDefault();

    swal({
        title: "Apakah Anda Yakin?",
        text: "Menu yang sudah di hapus tidak dapat di kembalikan!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: 'Batal',
        closeOnConfirm: false,
        html: false
    }, function () {
        document.getElementById('delete-' + id).submit();
        swal("Berhasil!", "Menu sudah dihapus.", "success");
    });
};
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__("./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ 4:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/assets/js/menu/index.js");


/***/ })

},[4]);