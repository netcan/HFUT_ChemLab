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
        'app.js'
    ], 'public/js/app.js');

    mix.browserify('app_config.js', 'public/js/app_config.js');

    mix.version([
        'css/app.css',
        'js/app.js',
        'js/app_config.js'
    ]);
    mix.copy('node_modules/font-awesome/fonts', 'public/build/fonts');
});
