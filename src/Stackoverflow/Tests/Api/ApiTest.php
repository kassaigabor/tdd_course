<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2016.11.16.
 * Time: 12:44
 */

namespace Stackoverflow\Tests;

use Stackoverflow\Api\Api;

class ApiTest extends \PHPUnit_Framework_TestCase
{
    /** @var Api */
    protected $api;

    public function setUp()
    {
        $this->api = $this->getMockBuilder('Stackoverflow\Api\Api')
            ->disableOriginalConstructor()
            ->setMethods(array(
                'getFeaturedQuestions',
                'getAnswers'
            ))
            ->getMock();

        $this->api->expects($this->any())
            ->method('getFeaturedQuestions')
            ->will($this->returnValue(
                json_decode(json_encode(array(
                    'items' => array(0 => array('question_id' => '711'))
                )))
            ));

        $this->api->expects($this->any())
            ->method('getAnswers')
            ->will($this->returnValue(
                json_decode(json_encode(array(
                    'items' => array(
                        0 => array('owner' => array('user_id' => '123')),
                        1 => array('owner' => array('user_id' => '456'))
                    )
                )))
            ));
    }

    public function testGetFeaturedQuestions()
    {
        $this->assertEquals(
            json_decode(json_encode(array(
                'items' => array(0 => array('question_id' => '711'))
            ))),
            $this->api->getFeaturedQuestions('1', '2')
        );
    }

    public function testGetAnswers()
    {
        $this->assertEquals(
            json_decode(json_encode(array(
                'items' => array(
                    0 => array('owner' => array('user_id' => '123')),
                    1 => array('owner' => array('user_id' => '456'))
                )
            ))),
            $this->api->getAnswers('1', '2', '3')
        );
    }
}
