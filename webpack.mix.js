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

mix
// themes assset js

    .js(['resources/assets/js/app.js'], 'public/js')
    .js(['resources/assets/js/socket.js'], 'public/js/socket.js')

    .js([
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
    ], 'public/js/registrasi.js')

    .sass('resources/assets/sass/app.scss', 'public/css');
