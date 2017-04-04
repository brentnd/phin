---
layout: default
section: documentation_content
---

## Upgrading
After getting an update from composer for Phin, upgrade the files in your site that need to change for the latest version.

Upgrade to Phin in `vendor/`:
```
$ phin upgrade
```

This process will get the latest:
* `public/`
	* `index.php`
	* `.htaccess`

These files shouldn't change often so this isn't required with every update.