# Hash Path

Hash Path provides a function in SilverStripe templates which, given a path to an asset, returns a modified path with a file hash appended. In combination with a web server rewrite rule, browser caching can be completely mitigated as the file URL sent to the browser changes whenever the file does.

```php
// Template:
$HashPath(css/style.css)

// Rendered:                          ↙ File hash
/themes/my-theme/css/style.vpOQ8F6ybteKQQYND5dzZQ.css
```


The latest version is only compatible with SilverStripe `4`.

For a SilverStripe `3` compatible version see branch `2.1`.

For a SilverStripe `2.4` compatible version see branch `1.1`.


## License

Hash Path is licensed under an [MIT license](http://heyday.mit-license.org/)

## Installation

### Composer

Installing from composer is easy, 

Create or edit a `composer.json` file in the root of your SilverStripe project, and make sure the following is present.

```json
{
    "require": {
        "heyday/silverstripe-hashpath": "^3.0.0"
    }
}
```

After completing this step, navigate in Terminal or similar to the SilverStripe root directory and run `composer install` or `composer update` depending on whether or not you have composer already in use.

### Web server config

As Hash Path returns paths that don't exist on disk, a rewrite rule needs to be added to your web server in order to return the file that was originally given to Hash Path. The URL format is `.v[hash]` inserted before the file extension, so you end up with `.v[hash].[extension]`.

#### Apache

The following is required in your `.htaccess` file or virtual host config.

```
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /

    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.+)\.(v[A-Za-z0-9]+)\.(js|css|png|jpg|gif)$ $1.$3 [L]
</IfModule>
```

#### Nginx

```
# Hashpath module
location /themes {
	rewrite "^(.+)\.(?:v\w{10,32})\.(js|css|png|jpg|gif)$" $1.$2 last;
	try_files $uri =404;
}
```

## How to use

Provided the correct theme is set, you can simply call `$HashPath` with the asset location relative to the current theme as the first argument.

For example, for a file located at `themes/my-theme/js/general.js` and with `my-theme` current, using:

```html
<script src="$HashPath("js/general.js")"></script>
```

will result in:

```html
<script src="/themes/my-theme/js/general.v54473acf909c645bb14f011d86a47733.js"></script>
```

If you are wanting to use an asset that is not relative to the current theme, use:

```html
<script src="$HashPath("/my-module/js/general.js", 0)"></script>
```

## Unit Testing

PHP Unit now comes with SS

### Running the unit tests

From the command line:
    
    vendor/bin/phpunit silverstripe-hashpath/tests



## Contributing

### Code guidelines

This project follows the standards defined in:

* [PSR-1](http://www.php-fig.org/psr/psr-1/)
* [PSR-2](http://www.php-fig.org/psr/psr-1/)
