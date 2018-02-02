var moment = require('moment');
var Highcharts = require('highcharts');

try {

    window.moment = moment;
    window.Highcharts = Highcharts;


    require('./bootstrap');
} catch (e) {
    console.log(e);
}
