<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2016.11.08.
 * Time: 11:19
 */

namespace MarkDownConverter\Tests;

use MarkDownConverter\FileReader;


class FileReaderTest extends \PHPUnit_Framework_TestCase
{
    /** @var FileReader */
    protected $reader;

    public function setUp()
    {
        $this->reader = new FileReader();
    }

    public function testRead()
    {
        $this->assertEquals(
            'Hello world!',
            $this->reader->read('../../data/test/test.txt')
        );
    }

    public function testException() {
        $this->assertEquals(
            '',
            $this->reader->read('notExist')
        );
    }
}
