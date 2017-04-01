# Phin

Phin is a simple collection of PHP packages which ties together Illuminate components to make simple PHP sites.

## Components included
* [Illuminate Routing](https://github.com/illuminate/routing)
* [Illuminate Support](https://github.com/illuminate/support)
* [Illuminate View](https://github.com/illuminate/view) - Blade Template Rendering
* [Illuminate Translation](https://github.com/illuminate/translation)
* Custom [Bootstrap Sass](http://getbootstrap.com/css/#sass) import
* [Jquery-easing](http://gsgd.co.uk/sandbox/jquery/easing/) for single-page sites
* Updating Copyright date
* Gulp integration with [Laravel Elixir](https://github.com/laravel/elixir) including minification and versioning
* Faker for generating sample content
* [FontAwesome](http://fontawesome.io/) icon set
* Http Client ([guzzle](https://github.com/guzzle/guzzle))

## TODO
* Deployment control
* Other common sections
* Bootswatch theme selector?
* Google Analytics
* Clean install (no controllers/views?)

## Dependencies
* PHP 5.6
* [composer](https://getcomposer.org/)
* [node.js](https://nodejs.org/en/)

## Installation
Pull in package with composer
`composer require brentnd/phin`

### Initialize
Starting a new Phin site takes just a few easy steps

```bash
mkdir newsite && cd newsite
composer require brentnd/phin
./vendor/bin/phin init
npm install
gulp
```

## Phin Commands

### Serve
Serve your site locally with PHP at `localhost:8000`

```bash
./vendor/bin/phin serve
```