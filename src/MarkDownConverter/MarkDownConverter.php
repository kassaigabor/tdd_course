<?php

namespace MarkDownConverter;

use MarkDownConverter\Parser\Parser;

/**
 * Class MarkDownConverter
 * @package MarkDownConverter
 */
class MarkDownConverter
{
    /** @var FileReader */
    protected $reader;

    /** @var FileWriter */
    protected $writer;

    /** @var Parser */
    protected $parser;

    /**
     * MarkDownConverter constructor.
     * @param FileReader $reader
     * @param FileWriter $writer
     * @param Parser $parser
     */
    public function __construct(FileReader $reader, FileWriter $writer, Parser $parser)
    {
        $this->reader = $reader;
        $this->writer = $writer;
        $this->parser = $parser;
    }

    /**
     * @param $source
     * @param $output
     * @return bool
     */
    public function convert($source, $output)
    {
        $content = $this->reader->read($source);
        $content = $this->parser->parse($content);
        return $this->writer->write($output, $content);
    }
}