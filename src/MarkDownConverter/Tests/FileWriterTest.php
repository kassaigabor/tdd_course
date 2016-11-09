<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2016.11.08.
 * Time: 11:20
 */

namespace MarkDownConverter\Tests;

use MarkDownConverter\FileWriter;


class FileWriterTest extends \PHPUnit_Framework_TestCase
{
    /** @var FileWriter */
    protected $writer;

    public function setUp()
    {
        $this->writer = new FileWriter();
    }

    public function testWrite()
    {
        $file = '../../data/test/writeTest.html';
        $this->writer->write($file, 'test');
        $content = file_get_contents($file);
        $this->assertEquals(
            'test',
            $content
        );
    }
}
