#Heyday Hash Path

Hash path provides a function in SilverStripe templates which given a path to an asset returns a path including a hash of the asset, enabling you in combination with some .htaccess to easily mitigate issues with browser caching.

##License

Hash Path is licensed under an [MIT license](http://heyday.mit-license.org/)

##Installation

###Composer

Installing from composer is easy, 

Create or edit a `composer.json` file in the root of your SilverStripe project, and make sure the following is present.

```json
{
    "require": {
        "heyday/silverstripe-hashpath": "1.1.*"
    }
}
```

After completing this step, navigate in Terminal or similar to the SilverStripe root directory and run `composer install` or `composer update` depending on whether or not you have composer already in use.

###.htaccess

The following is required in your root `.htaccess` file.

```
<IfModule mod_rewrite.c>
    SetEnv HTTP_MOD_REWRITE On
    RewriteEngine On
    RewriteBase /

    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.+)\.(v[\w]+)\.(js|css|png|jpg|gif)$ $1.$3 [L]
</IfModule>
```

Please note that if you change the format of the path that `hash path` outputs, you will need to change the `RewriteRule`. 

##How to use

Provided the correct theme is set, you can simply call `$HashPath` with the asset location relative to the current theme as the first argument.

For example, for a file located at `themes/my-theme/js/general.js` and with `my-theme` current, using:

    <script src="$HashPath(js/general.js)"></script>

will result in:

    <script src="/themes/my-theme/js/general.v54473acf909c645bb14f011d86a47733.js"></script>

If you are wanting to use an asset that is not relative to the current theme, use:

    <script src="$HashPath(/my-module/js/general.js, 0)"></script>

##Unit Testing

If you have `phpunit` installed you can run `silverstripe-hashpath`'s unit tests to see if everything is functioning correctly.

###Running the unit tests

From the command line:
    
    ./sake dev/tests/module/silverstripe-hashpath


From your browser:

    http://localhost/dev/tests/module/silverstripe-hashpath


##Contributing

###Code guidelines

This project follows the standards defined in:

* [PSR-1](https://github.com/pmjones/fig-standards/blob/psr-1-style-guide/proposed/PSR-1-basic.md)
* [PSR-2](https://github.com/pmjones/fig-standards/blob/psr-1-style-guide/proposed/PSR-2-advanced.md)