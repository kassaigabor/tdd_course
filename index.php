<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'vendor/autoload.php';

use MarkDownConverter\MarkDownConverter;
use MarkDownConverter\FileReader;
use MarkDownConverter\FileWriter;
use MarkDownConverter\Parser\Parser;

use Stackoverflow\FirstPopularQuestion;
use Stackoverflow\Api\Api;

class run
{
    public function __construct($index)
    {
        if ($index == 0) {
            $this->runMarkDownConverter();
        }
        $this->runFirstPopularQuestion();
    }

    protected function runMarkDownConverter()
    {
        $converter = new MarkDownConverter(
            new FileReader(),
            new FileWriter(),
            new Parser()
        );
        if ($converter->convert('data/ExampleContent.txt', 'data/ExampleContent.html')) {
            echo file_get_contents('data/ExampleContent.html');
        }
    }

    protected function runFirstPopularQuestion()
    {
        $api = new Api();
        $firstPopularQuestion = new FirstPopularQuestion($api);
        var_dump($firstPopularQuestion->getFirstPopularQuestion());
    }
}
new run(1);