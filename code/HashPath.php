<?php

/**
 * Class HashPath
 */
class HashPath implements TemplateGlobalProvider
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
     * @param  string  $path  Relative or absolute path to file
     * @param  boolean $theme Whether or not to take current theme into account
     * @return string  The md5 of the file
     */
    public static function generateHashForFile($path, $theme = true)
    {
        $path = $theme ? static::getPath($path) : $path;

        if (file_exists($path)) {
            $hash = md5_file($path);
            return str_replace(array('/', '+','='), '', base64_encode(pack('H*', $hash)));
        }

        return '';
    }
    /**
     * Template function to return new web path to asset which includes
     * md5 hash
     * @param  string  $path  Relative or absolute path to file
     * @param  boolean $theme Whether or not to take current theme into account
     * @return string  The web path include the md5 hash
     */
    public static function generateHashForPath($path, $theme = true)
    {
        $filepath = static::getPath($path, $theme);
        $path_parts = pathinfo($filepath);

        return sprintf(
            self::$format,
            str_replace(BASE_PATH . (self::$relativeLinks ? '/' : ''), '', $path_parts['dirname']),
            basename($path, ".{$path_parts['extension']}"),
            static::generateHashForFile($filepath, false),
            $path_parts['extension']
        );
    }
    /**
     * Returns the absolute path to a file based on whether or not
     * the input is relative to the current theme
     * @param  string  $path  Relative or absolute path to file
     * @param  boolean $theme Whether or not to take current theme into account
     * @return string  The absolute path to the file
     */
    protected static function getPath($path, $theme = true)
    {
        return BASE_PATH . (
            $theme ? '/themes/' . Config::inst()->get('SSViewer', 'theme') . "/$path" : $path
        );
    }

    public static function get_template_global_variables()
    {
        return array(
            'HashFile' => 'generateHashForFile',
            'HashPath' => 'generateHashForPath'
        );
    }
}
