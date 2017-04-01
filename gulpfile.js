var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your site. By default, we are compiling the Sass file for our application.
 |
 */

elixir(function(mix) {
    mix.sass([
        'site.scss'
    ], 'public/css/site.css');
    mix.scripts([
        'site.js',
    ], 'public/js/site.js');
    mix.version([
        'public/css/site.css',
        'public/js/site.js'
    ]);
});
