let table = {};
$(document).ready(function(){
    table = {
        el: $("#table-role"),
        evt: {},
        init: function(){
            let self = this;
            self.el.dataTable();
        }
    };

    table.init();
});

window.remove = function (id) {
    event.preventDefault();

    swal({
        title: "Apakah Anda Yakin?",
        text: "Role yang sudah di hapus tidak dapat di kembalikan!",
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
            "Role sudah dihapus.",
            "success");
    });
};