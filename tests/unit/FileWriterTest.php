<?php


use app\components\FileWriter;

class FileWriterTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    // tests

    /**
     * @throws Exception
     */
    public function testWritingLines()
    {
        $testFilePath = Yii::getAlias('@app/runtime/test_file_writer.txt');
        $fileWriter = new FileWriter($testFilePath);
        $fileWriter->writeLines(['test' => 4, 'test2' => 2, 'test4' => 1]);
        $expected = "test - 4\ntest2 - 2\ntest4 - 1\n";

        $this->assertStringEqualsFile($testFilePath, $expected);
    }

    /**
     * @throws Exception
     */
    public function testTryToOpenNonWritableFile()
    {
        $testFilePath = 'non_existing://path';
        $this->expectException(Exception::class);

        $fileWriter = new FileWriter($testFilePath);
        $fileWriter->writeLines([]);
    }
}