---
layout: default
---

## Configuration

Phin uses dotfiles (`.env`) and `config.php` to configure the application.
An example `.env` file exists in initialized sites as `.env.example`.
`.env` should not be committed to source control but instead should be set from
the example on a per-environment basis. This allows a local environment to have
debugging on while production has debugging disabled, both using the same source code.

`config.php` pulls from the environment with a reasonable set of defaults 
to setup all the necessary values for the application. This file shouldn't need
to be edited except for advanced usage.

Environment file:
```
SITE_ENV=production
SITE_DEBUG=false
SITE_URL=http://newcoolsite.com/
SITE_NAME=New Cool Site

ANALYTICS_ID= UA-000000-2
```