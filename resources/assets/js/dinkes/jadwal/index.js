/**
 * Created by agungrizkyana on 10/21/17.
 */
let jadwal = {};

$(document).ready(function(){

    jadwal = {
        el: $("#calendar-jadwal-monitoring"),
        evt: {},
        init: function(){
            const self = this;

            self.el.fullCalendar();
        }
    };

    jadwal.init();

});