<?php

namespace MarkDownConverter;

/**
 * Class FileReader
 * @package MarkDownConverter
 */
class FileReader
{
    /**
     * @param $file
     * @return string
     */
    public function read($file)
    {
        if (is_file($file)) {
            return file_get_contents($file);
        }
        return '';
    }
}