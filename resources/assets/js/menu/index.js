
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