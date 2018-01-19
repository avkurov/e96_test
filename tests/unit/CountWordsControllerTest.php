<?php

use app\commands\CountWordsController;

class CountWordsControllerTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    // tests
    public function testSomeFeature()
    {
        $inputFilePath = Yii::getAlias('@app/runtime/test_count_words_controller_input.txt');
        $outputFilePath = Yii::getAlias('@app/runtime/test_count_words_controller_output.txt');
        $this->createInputFile($inputFilePath);

        $params = [$inputFilePath, $outputFilePath];
        $controller = new CountWordsController('id', Yii::$app);
        $controller->run('', $params);

        $expected = "test - 3\nttt - 2\ntett - 1\n";

        $this->assertStringEqualsFile($outputFilePath, $expected);
    }

    private function createInputFile(string $inputFilePath): void
    {
        file_put_contents($inputFilePath, "tett ttt test\ntest34 ttt test%14");
    }
}