var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass([
        'app.scss'
    ]).browserify([
        'app.js',
    ], 'public/js/');

    mix.browserify('app_config.js', 'public/js/app_config.js');

    // mix.version([
    //     'css/app.css',
    //     'js/app.js',
    //     'js/app_config.js'
    // ]);
    mix.copy('node_modules/font-awesome/fonts', 'public/fonts');
    mix.copy([
        'node_modules/jquery/dist/jquery.min.js',
        'node_modules/jquery-ui-dist/jquery-ui.min.js',
        'node_modules/datatables.net/js/jquery.dataTables.js',
        'node_modules/datatables.net-bs/js/dataTables.bootstrap.js'
        ], 'public/js');
    mix.copy([
        'node_modules/jquery-ui-dist/jquery-ui.min.css',
        'node_modules/datatables.net-bs/css/dataTables.bootstrap.css'
    ], 'public/css');

    mix.copy('node_modules/jquery-ui-dist/images', 'public/css/images');
    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/', 'public/fonts/bootstrap');
    mix.browserSync({
        proxy: 'chemlab.app'
    });
});
