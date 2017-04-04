---
layout: default
section: documentation_content
---

## Deploying

Using git (hopefully), deploy the Phin site to a server. Run standard production installs for composer deps, node modules, and compile assets with gulp.

Because the Phin site doesn't have an `index.php` at the root of the repo, the easiest way to set it up is to have a git `post-receive` hook checkout the project (outside of `public_html`) to `~/projects/my-site` and then create a sym-link from `public_html` or `public_html/my-sub-site` to `~/projects/my-site/public`. This is possible to do on shared and private hosting and doesn't expose any site files (outside of `my-site/public`) to viewers.
