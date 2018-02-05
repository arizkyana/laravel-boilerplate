
let table = {};
let parents;
$(document).ready(function(){
    table = {
        el: $("#table-menu"),
        evt: {},
        init: function(){
            let self = this;
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
        swal("Berhasil!",
            "Menu sudah dihapus.",
            "success");
    });
};