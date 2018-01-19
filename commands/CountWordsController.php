<?php

namespace app\commands;

use app\components\FileReader;
use app\components\FileWriter;
use app\components\WordsCounter;
use yii\console\Controller;

class CountWordsController extends Controller
{
    /**
     * @param string $inputFile
     * @param string $outputFile
     * @throws \Exception
     */
    public function actionIndex(string $inputFile, string $outputFile)
    {
        $fileReader = new FileReader($inputFile);

        $wordsCounter = new WordsCounter();
        $result = $wordsCounter->countWords($fileReader->getWords());

        $fileWriter = new FileWriter($outputFile);
        $fileWriter->writeLines($result);
    }
}