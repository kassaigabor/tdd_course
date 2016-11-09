<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2016.11.08.
 * Time: 11:22
 */

namespace MarkDownConverter\Tests\Parser;

use MarkDownConverter\Parser\Parser;


class ParserTest extends \PHPUnit_Framework_TestCase
{
    /** @var array */
    protected $test = array(
        'text1**text2**text3' => 'text1<strong>text2</strong>text3',
        "text1`text2`text3" => 'text1<pre>text2</pre>text3',
        'text1 _text2_ text3' => 'text1 <i>text2</i> text3',
        'text1[text2](text3)text4' => 'text1<a href="text2">text3</a>text4',
        'text1![text2](text3)text4' => 'text1<img src="text2" alt="text3" />text4',
    );

    /** @var Parser */
    protected $parser;

    public function setUp()
    {
        $this->parser = new Parser();
    }

    public function testParse()
    {
        foreach ($this->test as $content => $check) {
            $this->assertEquals(
                $check,
                $this->parser->parse($content)
            );
        }
    }
}
