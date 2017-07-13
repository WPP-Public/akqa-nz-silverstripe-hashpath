<?php

namespace Heyday\HashPath;

use SilverStripe\Core\Config\Config;
use SilverStripe\Core\Extension;
use SilverStripe\View\SSViewer;

/**
 * Class HashPathExtension
 */
class HashPathExtension extends Extension
{
    /**
     * The format of the web path
     * @var string
     */
    protected static $format = '%s/%s.v%s.%s';
    /**
     * Whether or not to output links as relative
     * @var boolean
     */
    protected static $relativeLinks = false;

    /**
     * Set the format for use in producing the web path
     * @param string $format The format to set
     */
    public static function setFormat($format)
    {
        self::$format = $format;
    }

    /**
     * Output links as relative
     * @param boolean $val Whether or not to output links as relative
     */
    public static function setRelativeLinks($val = true)
    {
        self::$relativeLinks = $val;
    }

    /**
     * Returns an md5 hash of a file
     * @param  string $path Relative or absolute path to file
     * @param  boolean $theme Whether or not to take current theme into account
     * @return string  The md5 of the file
     */
    public function HashFile($path, $theme = true)
    {
        $path = $theme ? $this->getPath($path) : $path;

        if (file_exists($path)) {
            $hash = md5_file($path);
            return str_replace(array('/', '+', '='), '', base64_encode(pack('H*', $hash)));
        }

        return '';
    }

    /**
     * Template function to return new web path to asset which includes
     * md5 hash
     * @param  string $path Relative or absolute path to file
     * @param  boolean $theme Whether or not to take current theme into account
     * @return string  The web path include the md5 hash
     */
    public function HashPath($path, $theme = true)
    {
        $filepath = $this->getPath($path, $theme);
        $path_parts = pathinfo($filepath);

        return sprintf(
            self::$format,
            str_replace(BASE_PATH . (self::$relativeLinks ? '/' : ''), '', $path_parts['dirname']),
            basename($path, ".{$path_parts['extension']}"),
            $this->HashFile($filepath, false),
            $path_parts['extension']
        );
    }

    /**
     * Returns the absolute path to a file based on whether or not
     * the input is relative to the current theme
     * @param  string $path Relative or absolute path to file
     * @param  boolean $theme Whether or not to take current theme into account
     * @return string  The absolute path to the file
     */
    protected function getPath($path, $theme = true)
    {
        if ($theme) {
            $themes = SSViewer::get_themes();
            if (is_array($themes)) {
                $themePath = $themes[0];
            } else {
                $themePath = 'simple';
            }
            $path = '/themes/' . $themePath . "/$path";
        }

        return BASE_PATH . $path;
    }

}
