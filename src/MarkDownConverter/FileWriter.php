<?php

namespace MarkDownConverter;

/**
 * Class FileWriter
 * @package MarkDownConverter
 */
class FileWriter
{
    /**
     * @param $file
     * @param $content
     * @return int
     */
    public function write($file, $content)
    {
        $return = file_put_contents($file, $content);
        if ($return) {
            return true;
        }
        return false;
    }
}