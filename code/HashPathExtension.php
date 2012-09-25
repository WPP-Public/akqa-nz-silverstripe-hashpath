<?php

class HashPathExtension extends Extension
{

    public function HashPath($path, $theme = true)
    {
        $path = BASE_PATH . ($theme ? '/themes/' . SSViewer::current_theme() . "/$path" : $path);

        return file_exists($path) ? md5_file($path) : '';
    }

}