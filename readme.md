# Phin

Simple setup which uses Illuminate components to make simple PHP sites.

## Components included
* Illuminate Routing
* Illuminate Support
* Illuminate Views (Blade Template Rendering)
* Illuminate Translations
* Custom Bootstrap Sass import
* Jquery-easing for single-page sites
* Updating Copyright date
* Gulp integration with Laravel Elixir including minification and versioning
* Faker for generating sample content
* Fontawesome icon set

## TODO
* Deployment control
* Other common sections
* SocialMedia provider?
* Bootswatch theme selector?
* Google Analytics

## Installation

Just a few easy steps to get up and running

```bash
mkdir newsite && cd newsite
composer require brentnd/phin
./vendor/bin/phin init
npm install
gulp
```

Serve your site locally with PHP at `localhost:8000`

```bash
./phin serve
```