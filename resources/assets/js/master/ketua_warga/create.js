var kecamatan,
    kelurahan,
    role,
    masaBakti = {
        mulai: {},
        akhir: {}
    };
(function () {

    kelurahan = {
        el: $('select[name=kelurahan]'),
        evt: {},
        init: function () {
            const self = this;

            $(self.el).select2();
        }

    };

    kecamatan = {
        el: $('select[name=kecamatan]'),
        evt: {
            change: function () {
                let idKecamatan = $(this).val();
                $.ajax({
                    url: base_url + '/api/kelurahan/get_by_kecamatan/' + idKecamatan,
                    method: 'get'
                }).then(function (result) {
                    kelurahan.el.select2().val(null).trigger('change');
                    kelurahan.el.empty();
                    $.each(result.data, function (i, item) {

                        let options = "<option value='" + item.kelurahan_id + "'>" + item.nama_kelurahan + "</option>";
                        kelurahan.el.append(options)
                    });
                }, logError);
            }
        },
        init: function () {
            const self = this;
            self.el.select2();
            self.el.change(self.evt.change);
        }
    };


    role = {
        el: $("#role"),
        evt: {},
        init: function () {
            const self = this;
            self.el.select2();
        }
    };

    masaBakti.mulai = {
        el: $("#masa_bakti_mulai"),
        evt: {},
        init: function(){
            const self = this;
            self.el.datepicker({
                autoclose: true
            });
        }
    };

    masaBakti.akhir = {
      el: $("#masa_bakti_akhir"),
      evt: {},
      init: function(){
          const self = this;
          self.el.datepicker({
              autoclose: true
          });
      }
    };

    kelurahan.init();
    kecamatan.init();
    masaBakti.mulai.init();
    masaBakti.akhir.init();
    role.init();

})();
