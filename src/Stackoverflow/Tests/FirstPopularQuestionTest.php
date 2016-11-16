<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2016.11.16.
 * Time: 11:28
 */

namespace Stackoverflow\Tests;

use Stackoverflow\Api\Api;
use Stackoverflow\FirstPopularQuestion;


class FirstPopularQuestionTest extends \PHPUnit_Framework_TestCase
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

    public function testGetQuestions()
    {
        $firstPopularQuestion = new FirstPopularQuestion($this->api);
        $this->assertEquals(
            json_decode(json_encode(array(
                'items' => array(0 => array('question_id' => '711'))
            ))),
            $firstPopularQuestion->getQuestions()
        );
    }

    public function testGetFirstQuestionId()
    {
        $firstPopularQuestion = new FirstPopularQuestion($this->api);
        $this->assertEquals(
            '711',
            $firstPopularQuestion->getFirstQuestionId(
                json_decode(json_encode(array(
                    'items' => array(0 => array('question_id' => '711'))
                )))
            )
        );
    }

    public function testGetAnswers()
    {
        $firstPopularQuestion = new FirstPopularQuestion($this->api);
        $this->assertEquals(
            json_decode(json_encode(array(
                'items' => array(
                    0 => array('owner' => array('user_id' => '123')),
                    1 => array('owner' => array('user_id' => '456'))
                )
            ))),
            $firstPopularQuestion->getAnswers('711')
        );
    }

    public function testGetFirstPopularQuestion()
    {
        $firstPopularQuestion = new FirstPopularQuestion($this->api);
        $this->assertEquals(
            array('123, 456'),
            $firstPopularQuestion->getFirstPopularQuestion()
        );
    }

}
