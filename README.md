#Heyday Hash Path

Hash path allows you to produce a file path in SilverStripe which includes a hash of the file, enabling you to use the hash to bust the browser cache

##License

Hash Path is licensed under an [MIT license](http://heyday.mit-license.org/)

##Installation

###Composer

Installing from composer is easy, 

Create or edit a `composer.json` file in the root of your SilverStripe project, and make sure the following is present.

```json
{
    "repositories": [
        {
            "type": "composer",
            "url": "http://packages.heyday.net.nz/"
        }
    ],
    "require": {
        "composer/installers": "1.0.0",
        "heyday/silverstripe-hashpath": "dev-master"
    }
}
```

After completing this step, navigate in Terminal or similar to the SilverStrippe root directory and run `composer install` or `composer update` depending on whether or not you have composer already in use.

###.htaccess

The following is required in your root `.htaccess` file.

```
<IfModule mod_rewrite.c>
    SetEnv HTTP_MOD_REWRITE On
    RewriteEngine On
    RewriteBase /

    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.+)\.(v\.[\w]+)\.(js|css|png|jpg|gif)$ $1.$3 [L]
</IfModule>
```

##How to use

Provided when your template runs the correct theme is set, you can simply pass in the asset path relative to the theme root.

For example, if the file is located at `themes/my-theme/js/general.js` and the `my-theme` theme is current, using:

    <script src="{$HashPath(js/general.js)}"></script>

will result in:

    <script src="/themes/my-theme/js/general.v.54473acf909c645bb14f011d86a47733.js"></script>



##Unit Testing

##Contributing

###Code guidelines

This project follows the standards defined in:

* [PSR-1](https://github.com/pmjones/fig-standards/blob/psr-1-style-guide/proposed/PSR-1-basic.md)
* [PSR-2](https://github.com/pmjones/fig-standards/blob/psr-1-style-guide/proposed/PSR-2-advanced.md)