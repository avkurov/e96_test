<?php


use app\components\FileReader;

class FileReaderTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    // tests

    /**
     * @throws Exception
     */
    public function testReadWords()
    {
        $testFilePath = Yii::getAlias('@app/runtime/test_file_reader.txt');
        $this->createTestingFile($testFilePath);
        $fileReader = new FileReader($testFilePath);
        $result = [];

        foreach ($fileReader->getWords() as $word) {
            $result[] = $word;
        }

        $expected = ['werwer', 'йцу', 'sdfsdf', 'cvbcvb', 'oiu', 'iyu'];

        $this->assertEquals($expected, $result);
    }

    /**
     * @throws Exception
     */
    public function testOpenNonExistingFile()
    {
        $testFilePath = Yii::getAlias('@app/runtime/$non_existing_file$.not_ext');
        $this->expectException(Exception::class);

        $fileReader = new FileReader($testFilePath);
        $iterator = $fileReader->getWords();
        $iterator->next();
    }

    /**
     * @param string $testFilePath
     * @throws Exception
     */
    private function createTestingFile(string $testFilePath): void
    {
        $fileHandle = fopen($testFilePath, 'w');

        if (!$fileHandle) {
            throw new Exception('Cannot create the test file for testing FileReader components');
        }

        fputs($fileHandle, "werwer йцу sdfsdf cvbcvb\n");
        fputs($fileHandle, 'oiu iyu');

        fclose($fileHandle);
    }
}