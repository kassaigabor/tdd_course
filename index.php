<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once ('src/MarkDownConverter/MarkDownConverter.php');
require_once ('src/MarkDownConverter/FileReader.php');
require_once ('src/MarkDownConverter/FileWriter.php');
require_once ('src/MarkDownConverter/Parser/Parser.php');

use MarkDownConverter\MarkDownConverter;
use MarkDownConverter\FileReader;
use MarkDownConverter\FileWriter;
use MarkDownConverter\Parser\Parser;

class run
{
    public function __construct()
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
}
new run();