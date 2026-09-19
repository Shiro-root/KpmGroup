<?php
// app/helpers.php

if (! function_exists('imgv')) {
  
    function imgv(string $filename): string
    {
        $path = base_path('images/' . $filename);
        $version = file_exists($path) ? filemtime($path) : time();

        return asset('images/' . $filename) . '?v=' . $version;
    }
}