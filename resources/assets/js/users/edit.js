var form = {
    api : {
        scope: {}
    }
};




$(document).ready(function(){

    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function (html) {
        new Switchery(html);
    });

    form.api.scope = {
        el: $("#client_scope"),
        evt: {
            onChange: function(e){
                e.preventDefault();
                return;
            }
        },
        init: function(){
            const self = this;
            self.el.select2({
                placeholder: 'Pilih Scope'
            });
        }
    }

});