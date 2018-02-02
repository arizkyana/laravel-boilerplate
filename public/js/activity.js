webpackJsonp([10],{

/***/ "./resources/assets/js/activity/index.js":
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {/**
 * Created by agungrizkyana on 11/9/17.
 */

var table = {};
var supervisor = {};
var pic = {};
var filter = {
    tanggalMulai: {},
    tanggalAkhir: {}
};

var btn = {
    refresh: {}
};

var _datatable;

$(document).ready(function () {

    table = {
        el: $("#table-jadwal"),
        evt: {},
        init: function init() {
            var self = this;

            _dataTable = self.el.DataTable({
                processing: true,
                serverSide: true,
                saveState: true,
                ajax: {
                    url: base_url + '/api/activity/ajax_log',
                    method: 'post'
                },
                order: [[0, 'desc']],

                columns: [{
                    data: 'created_at',
                    name: 'activity.created_at',
                    searchable: false,
                    render: function render(data, type, row, meta) {
                        return moment(data).format('DD-MM-YYYY hh:mm:ss');
                    }
                }, {
                    data: 'ip',
                    name: 'activity.ip'
                }, {
                    data: 'email',
                    name: 'users.email',
                    render: function render(data, type, row, meta) {
                        return row.email;
                    }

                }, {
                    data: 'role',
                    name: 'role.name'

                }, {
                    data: 'message',
                    name: 'activity.message'
                }]
            });
        },
        redraw: function redraw(query) {
            var url = base_url + '/api/activity/ajax_log' + query;
            _dataTable.ajax.url(url).load();
            _dataTable.draw(true);
        }
    };

    filter.tanggalMulai = {
        el: $('#tanggal_mulai'),
        evt: {},
        init: function init() {
            var self = this;

            self.el.datepicker({
                autoclose: true,
                orientation: 'bottom'
            });
        }
    };
    filter.tanggalAkhir = {
        el: $('#tanggal_akhir'),
        evt: {
            change: function change(e) {
                e.preventDefault();
                table.redraw("?" + $("#form-filter").serialize());
            }
        },
        init: function init() {
            var self = this;

            self.el.datepicker({
                autoclose: true,
                orientation: 'bottom'
            });

            self.el.change(self.evt.change);
        }
    };

    btn.refresh = {
        el: $("#refresh"),
        evt: {
            click: function click() {

                table.redraw("?" + $("#form-filter").serialize());
            }
        },
        init: function init() {
            var self = this;
            self.el.click(self.evt.click);
        }
    };

    filter.tanggalMulai.init();
    filter.tanggalAkhir.init();
    btn.refresh.init();
    table.init();
});
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__("./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ 9:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/assets/js/activity/index.js");


/***/ })

},[9]);