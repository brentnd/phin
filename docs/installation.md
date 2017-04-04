---
layout: default
---

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