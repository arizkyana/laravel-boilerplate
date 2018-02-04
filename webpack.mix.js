let mix = require('laravel-mix');


/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.autoload({
    jquery: ['$', 'window.jQuery', 'jquery', 'window.$', 'window.jquery', 'jQuery']
});
mix.js([
    'resources/assets/js/themes/jquery-3.1.1.min.js',
    'resources/assets/js/themes/bootstrap.js',
    'resources/assets/js/themes/plugins/metisMenu/jquery.metisMenu.js',
    'resources/assets/js/themes/plugins/slimscroll/jquery.slimscroll.min.js',
    'resources/assets/js/themes/plugins/flot/jquery.flot.js',
    'resources/assets/js/themes/plugins/flot/jquery.flot.tooltip.min.js',
    'resources/assets/js/themes/plugins/flot/jquery.flot.spline.js',
    'resources/assets/js/themes/plugins/flot/jquery.flot.resize.js',
    'resources/assets/js/themes/plugins/flot/jquery.flot.pie.js',
    'resources/assets/js/themes/plugins/peity/jquery.peity.min.js',
    'resources/assets/js/themes/inspinia.js',
    'resources/assets/js/themes/plugins/pace/pace.min.js',
    'resources/assets/js/themes/plugins/jquery-ui/jquery-ui.min.js',
    'resources/assets/js/themes/plugins/sparkline/jquery.sparkline.min.js',
    'resources/assets/js/themes/plugins/toastr/toastr.min.js',
    'resources/assets/js/themes/plugins/dataTables/datatables.min.js',
    'resources/assets/js/themes/plugins/datapicker/bootstrap-datepicker.js',
    'resources/assets/js/themes/plugins/select2/select2.full.min.js',
    'resources/assets/js/themes/plugins/sweetalert/sweetalert.min.js',
    'resources/assets/js/themes/plugins/clockpicker/clockpicker.js',
    'resources/assets/js/app.js'
], 'public/js/bundle.js');

mix.extract(['jquery']);

mix.copy([
    'resources/assets/js/themes/plugins/switchery/switchery.js'
], 'public/js/themes/plugins/switchery/switchery.js');

mix.js([
    'resources/assets/js/users/create.js',
    'resources/assets/js/users/edit.js',
    'resources/assets/js/users/index.js',
], 'public/js/users.js')
    .js([
        'resources/assets/js/apiClient/create.js',
        'resources/assets/js/apiClient/edit.js',
        'resources/assets/js/apiClient/index.js',
    ], 'public/js/apiClient.js')
    .js([
        'resources/assets/js/menu/index.js'
    ], 'public/js/menu.js')
    .js([
        'resources/assets/js/role/index.js'
    ], 'public/js/role.js')
    .js([
        'resources/assets/js/dashboard/index.js'
    ], 'public/js/dashboard.js')

    .js([
        'resources/assets/js/notification/setup/index.js',
        'resources/assets/js/notification/setup/create.js',
        'resources/assets/js/notification/setup/show.js'
    ], 'public/js/notification/setup.js')


    .js([
        'resources/assets/js/notification/history/index.js',
    ], 'public/js/notification/history.js')


    .js([
        'resources/assets/js/activity/index.js'
    ], 'public/js/activity.js')

    .js([
        'resources/assets/js/registrasi/index.js',
    ], 'public/js/registrasi.js');


mix.styles([
    'resources/assets/canvas/css/bootstrap.css',
    'resources/assets/canvas/style.css',
    'resources/assets/canvas/css/dark.css',
    'resources/assets/canvas/css/font-icons.css',
    'resources/assets/canvas/css/animate.css',
    'resources/assets/canvas/css/magnific-popup.css',
    'resources/assets/canvas/css/responsive.css'
], 'public/canvas/css/store.css');

mix.copy([
    'resources/assets/canvas/js/jquery.js',
], 'public/canvas/js/jquery.js');

mix.copy([
    'resources/assets/canvas/js/plugins.js',

], 'public/canvas/js/plugins.js');

mix.copy([
    'resources/assets/canvas/js/functions.js',
], 'public/canvas/js/functions.js');

mix.sass('resources/assets/sass/app.scss', 'public/css');

mix.version();