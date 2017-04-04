---
layout: default
section: documentation_content
---

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