---
layout: default
section: documentation_content
---

## Directory Structure

By default, Phin gives you a standard directory structure similar
to what Laravel or other frameworks would.
* `public/` - Base directory where site is served from.
	* `index.php` - Loads application and handles routing.
	* `.htaccess` - Setup to use PHP 5.6 handler, produce clean urls, and setup asset caching (satisfies Google Speed Test analysis).
	* `img/` - Storage for images.
	* `css/`,`js/`,`build/` - Output files from Elixir go here. They are ignore by git by default.
	* Feel free to create other directories here as you need.
* `resources/` - Top-level resource directory
	* `assets/` - `js` and `sass` built by Elixir.
	* `views/` - Blade templates and page files.
* `site/` - Default location for site's controllers and routes.
	* `routes.php` - Specify routes for the site (like Laravel)
	> To change the site directory or namespace, use configuration value `site.namespace` and `site.directory`.
* `config.php` - Configuration file.