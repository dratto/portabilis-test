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
    mix.copy('bower_components/bootstrap/dist/fonts', 'public/assets/fonts');
    mix.copy('bower_components/fontawesome/fonts', 'public/assets/fonts');
    mix.styles([
        'bower_components/bootstrap/dist/css/bootstrap.css',
        'bower_components/fontawesome/css/font-awesome.css',
        'resources/assets/css/styles.css'
    ], 'public/assets/stylesheets/styles.css', './');
    mix.scripts([
        'bower_components/jquery/dist/jquery.js',
        'bower_components/jQuery-Mask-Plugin/dist/jquery.mask.js',
        'bower_components/bootstrap/dist/js/bootstrap.js',
        'bower_components/metisMenu/dist/metisMenu.js',
        'resources/assets/js/scripts.js',
        'resources/assets/js/crud-actions.js',
        'resources/assets/js/mask.js'
    ], 'public/assets/scripts/scripts.js', './');
});
