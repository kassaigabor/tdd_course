<?php

namespace Stackoverflow;

use Stackoverflow\Api\Api;

/**
 * Class MarkDownConverter
 * @package MarkDownConverter
 */
class FirstPopularQuestion
{
    /** @var Api */
    protected $api;

    /**
     * FirstPopularQuestion constructor.
     * @param Api $api
     */
    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    public function getFirstPopularQuestion()
    {
        $questions = $this->getQuestions();
        $firstQuestionId = $this->getFirstQuestionId($questions);
        $answers = $this->getAnswers($firstQuestionId);
        if (!$answers) {
            return [];
        }
        $response = [];
        foreach ($answers->items as $item) {
            $response[] = $item->owner->user_id;
        }
        return $response;
    }

    /**
     * @return bool|mixed
     */
    protected function getQuestions()
    {
        $questions = $this->api->getFeaturedQuestions('desc', 'votes');
        if (!(isset($questions->items))) {
            return false;
        }
        return $questions;
    }

    /**
     * @param $questions
     * @return bool
     */
    protected function getFirstQuestionId($questions)
    {
        if (!$questions) {
            return false;
        }
        return $questions->items[0]->question_id;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    protected function getAnswers($id)
    {
        if (!$id) {
            return false;
        }
        $answers = $this->api->getAnswers($id, 'desc', 'activity');
        if (!(isset($answers->items))) {
            return false;
        }
        return $answers;
    }
}