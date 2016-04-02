<?php

/**
 * Class HashPathExtension
 * @deprecated 
 */
class HashPathExtension
{
    public static function setFormat($format) 
    {
        Deprecation::notice('1.0', 'Use HashPath::setFormat instead');
        HashPath::setFormat($format);
    }

    public static function setRelativeLinks($val = true) 
    {
        Deprecation::notice('1.0', 'Use HashPath::setRelativeLinks instead');
        HashPath::setRelativeLinks($val);
    }

    public function HashFile($path, $theme = true) 
    {
        Deprecation::notice('1.0', 'Use HashPath::generateHashForFile instead');
        return HashPath::generateHashForFile($path, $theme);
    }

    public function HashPath($path, $theme = true) 
    {
        Deprecation::notice('1.0', 'Use HashPath::generateHashForPath instead');
        return HashPath::generateHashForPath($path, $theme);
    }
}
