webpackJsonp([2],{

/***/ "./resources/assets/js/notification/setup/create.js":
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {var kecamatan, kelurahan, role;
(function () {

    kelurahan = {
        el: $('#kelurahan'),
        evt: {},
        init: function init() {
            var self = this;

            $(self.el).select2();
        }

    };

    kecamatan = {
        el: $('#kecamatan'),
        evt: {
            change: function change() {
                var idKecamatan = $(this).val();
                $.ajax({
                    url: base_url + '/api/kelurahan/get_by_kecamatan/' + idKecamatan,
                    method: 'get'
                }).then(function (result) {
                    kelurahan.el.select2().val(null).trigger('change');
                    kelurahan.el.empty();
                    $.each(result, function (i, item) {

                        var options = "<option value='" + item.kelurahan_id + "'>" + item.nama_kelurahan + "</option>";
                        kelurahan.el.append(options);
                    });
                }, logError);
            }
        },
        init: function init() {
            var self = this;
            self.el.select2();
            self.el.change(self.evt.change);
        }
    };

    role = {
        el: $("#role"),
        evt: {},
        init: function init() {
            var self = this;
            self.el.select2();
        }
    };

    kelurahan.init();
    kecamatan.init();
    role.init();
})();
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__("./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./resources/assets/js/notification/setup/index.js":
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {var _dataTable;
var table, kecamatan;
window.notifikasi = function () {

    function init() {
        initTable();
    }

    function initTable() {
        table = {
            el: $("#table-setup"),
            evt: {},
            init: function init() {
                var self = this;

                _dataTable = self.el.DataTable();
            }
        };

        table.init();
    }

    return {
        init: init
    };
}();

$(document).ready(function () {
    window.notifikasi.init();
});

window.remove = function (id) {
    event.preventDefault();

    swal({
        title: "Apakah Anda Yakin?",
        text: "Notifikasi yang sudah di hapus tidak dapat di kembalikan!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: 'Batal',
        closeOnConfirm: false,
        html: false
    }, function () {
        document.getElementById('delete-' + id).submit();
        swal("Berhasil!", "Notifikasi sudah dihapus.", "success");
    });
};
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__("./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ "./resources/assets/js/notification/setup/show.js":
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {var _dataTable;
var table, kecamatan;
window.dinkes = function () {

    function init() {
        initTable();
    }

    function initTable() {
        table = {
            el: $("#table-users"),
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

/***/ 7:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__("./resources/assets/js/notification/setup/index.js");
__webpack_require__("./resources/assets/js/notification/setup/create.js");
module.exports = __webpack_require__("./resources/assets/js/notification/setup/show.js");


/***/ })

},[7]);