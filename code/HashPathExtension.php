<?php

class HashPathExtension extends Extension
{

    public function HashFile($path, $theme = true)
    {
        $path = $theme ? $this->getPath($path) : $path;
        return file_exists($path) ? md5_file($path) : '';
    }

    public function HashPath($path, $theme = true)
    {
        $filepath = $this->getPath($path);
        $hash = $this->HashFile($filepath, false);
        $path_parts = pathinfo($filepath);
        return str_replace(BASE_PATH, '', $path_parts['dirname']) . '/' . basename($path, ".{$path_parts['extension']}") . ".v.$hash.{$path_parts['extension']}";
    }

    protected function getPath($path, $theme = true)
    {
        return BASE_PATH . ($theme ? '/themes/' . SSViewer::current_theme() . "/$path" : $path);
    }
    
}