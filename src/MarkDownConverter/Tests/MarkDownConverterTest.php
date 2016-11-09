<?php

namespace MarkDownConverter\Tests;

use MarkDownConverter\MarkDownConverter;
use MarkDownConverter\FileReader;
use MarkDownConverter\FileWriter;
use MarkDownConverter\Parser\Parser;

/**
 * Created by PhpStorm.
 * User: root
 * Date: 2016.11.08.
 * Time: 9:57
 */
class MarkDownConverterTest extends \PHPUnit_Framework_TestCase
{
    /** @var MarkDownConverter */
    protected $converter;

    public function setUp()
    {
        $this->converter = new MarkDownConverter(
            new FileReader(),
            new FileWriter(),
            new Parser()
        );
    }

    public function testConvert()
    {
        $this->assertEquals(
            true,
            $this->converter->convert(
                '../../data/test/test.txt',
                '../../data/test/test.html'
            )
        );
    }
}
