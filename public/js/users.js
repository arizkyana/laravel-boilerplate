webpackJsonp([1],{

/***/ "./resources/assets/js/users/create.js":
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {

$(document).ready(function () {});
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__("./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./resources/assets/js/users/edit.js":
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {var form = {
    api: {
        scope: {}
    }
};

$(document).ready(function () {

    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function (html) {
        new Switchery(html);
    });

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
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__("./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./resources/assets/js/users/index.js":
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {var table = {};
$(document).ready(function () {
    table = {
        el: $("#table-users"),
        evt: {},
        init: function init() {
            var self = this;
            self.el.dataTable();
        }
    };

    table.init();
});

window.remove = function (id) {
    event.preventDefault();

    swal({
        title: "Apakah Anda Yakin?",
        text: "User yang sudah di hapus tidak dapat di kembalikan!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: 'Batal',
        closeOnConfirm: false,
        html: false
    }, function () {
        document.getElementById('delete-' + id).submit();
        swal("Berhasil!", "User sudah dihapus.", "success");
    });
};
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__("./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ 2:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__("./resources/assets/js/users/create.js");
__webpack_require__("./resources/assets/js/users/edit.js");
module.exports = __webpack_require__("./resources/assets/js/users/index.js");


/***/ })

},[2]);