<?php


use app\components\WordsCounter;

class WordsCounterTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    // tests
    public function testSortingAndCounting()
    {
        $wordsCounter = new WordsCounter();
        $result = $wordsCounter->countWords(['test', 'tost12', 'tsT', 'Test', 'tost', 'test', 'tstt', 'йцу%1', 'чсм', 'йцу']);

        $expected = ['test' => 3, 'tost' => 2, 'йцу' => 2, 'tstt' => 1, 'tst' => 1, 'чсм' => 1];

        $this->assertEquals($expected, $result);
    }
}