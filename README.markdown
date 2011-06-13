Project Goal
============

I've started this project as a simple personal homepage. I didn't feel comfortable about the way Wordpress exposes
itself, so I wrote a frontend and a custom theme for it to mask it's presence. The attempt was a success. I could hide
WP without actually modifying the WP core.

This project is a stripped down generic version of that masking code. It aims to provide blog owners with an additional
layer of security and added-value features like a white label theme skeletton.

Using it
========

To use the code, you need to set up multiple subdomains:

* An administrative domain, where the actual Wordpress installation resides. This should be protected with a password.
* A frontend domain, which holds the frontend code.
* A static domain, where the CSS files and images are served from.
