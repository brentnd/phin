# Phin

Phin is a simple collection of PHP packages which ties together Illuminate components to make simple PHP sites.

## Components included
* [Illuminate Routing](https://github.com/illuminate/routing)
* [Illuminate Support](https://github.com/illuminate/support)
* [Illuminate View](https://github.com/illuminate/view) - Blade Template Rendering
* [Illuminate Config](https://github.com/illuminate/config)
* Custom [Bootstrap Sass](http://getbootstrap.com/css/#sass) import
* [Jquery-easing](http://gsgd.co.uk/sandbox/jquery/easing/) for single-page sites
* Updating Copyright date
* Gulp integration with [Laravel Elixir](https://github.com/laravel/elixir) including minification and versioning
* Faker for generating sample content
* [FontAwesome](http://fontawesome.io/) icon set
* Http Client ([guzzle](https://github.com/guzzle/guzzle))
* Google Analytics

## TODO
* Deployment control
* Other common sections
* Bootswatch theme selector?

## Installation

Phin requires PHP 5.6+ to be installed along with
[Composer](https://getcomposer.org/). Optionally
[Node.js](https://nodejs.org/en/) and NPM are needed to use Elixir to compile CSS and Javascript.

### Quick install
```bash
mkdir quick-site && cd quick-site
composer require brentnd/phin
./vendor/bin/phin init
npm install
gulp
./vendor/bin/phin serve
```

### Installing Globally
Install Phin globally via Composer:
```
$ composer global require brentnd/phin
```
> Make sure `~/.composer/vendor/bin` is in your `$PATH`

### Installing Locally
If you run into issues when trying to install Phin globally, or just don't want to
you can always install it locally on a per-site basis.
> If you install locally, all calls to `phin` should be `./vendor/bin/phin`

Install Phin via Composer in your site directory:
```
$ composer require brentnd/phin
```

## Site setup and initialization
Setting up a new Phin site with the default structure is painless after Phin is installed.

Create a new site:
```
$ phin init my-site
```
This will create a new directory `my-site` where Phin is initialized.

Initialize Phin from an existing directory:
```
$ phin init
```
This will setup your current directory as a Phin site.

## Directory structure
By default, Phin gives you a standard directory structure similar
to what Laravel or other frameworks would.
* `bootstrap/` - Main loader for the Phin application. Used by index.php and `phin` command
* `public/` - Base directory where site is served from. Contains `index.php` which loads application and handles routing. `.htaccess` is setup to use PHP 5.6 handler, produce clean urls, and setup asset caching (satisfies Google Speed Test analysis).
	* `img/` - Storage for images.
	* `css/`,`js/`,`build/` - Output files from Elixir go here. They are ignore by git by default.
	* Feel free to create other directories here as you need.
* `resources/` - Top-level resource directory
	* `assets/` - `js` and `sass` built by Elixir.
	* `views/` - Blade templates and page files.
* `site/` - Default location for site's controllers and routes.
	* `routes.php` - Specify routes for the site (like Laravel)
	* > To change the site directory or namespace, use configuration value `site.namespace` and `site.directory`.
* `config.php` - Configuration file.

## Compiling Assets
The default setup for Phin has placeholders for sass and js in the `resources/assets/` directory. To compile, minify, and version these assets, Phin uses Elixir. Recommend use node version lts/boron (v6.9.0)

Install node modules from package.json:
```
$ npm install
```

Now that the node modules are installed, assets can be compiled.

Compile, minify, and version assets:
```
$ gulp
```
> Before deploying, use `gulp --production`.
> During development, use `gulp watch` to rebuild as assets change.

## Previewing
Phin comes with a built in command to run PHP's server.

Serve site locally:
```
$ phin serve
```
> Optionally specify `--host` and `--port`

A browser pointed at http://localhost:8000 should show the default Phin site.

## Blade
See [Laravel's Blade Docs](https://laravel.com/docs/5.4/blade)
> TODO: explain standard layout and pages directories

## Routing
See [Laravel's Routing Docs](https://laravel.com/docs/5.4/routing)
> TODO: add sample routes

## Controllers
See [Laravel's Controller Docs](https://laravel.com/docs/5.4/controllers)
> TODO: add controller examples

## Deploying
Using git (hopefully), deploy the Phin site to a server. Run standard production installs for composer deps, node modules, and compile assets with gulp.

Because the Phin site doesn't have an `index.php` at the root of the repo, the easiest way to set it up is to have a git `post-receive` hook checkout the project (outside of `public_html`) to `~/projects/my-site` and then create a sym-link from `public_html` or `public_html/my-sub-site` to `~/projects/my-site/public`. This is possible to do on shared and private hosting and doesn't expose any site files (outside of `my-site/public`) to viewers.