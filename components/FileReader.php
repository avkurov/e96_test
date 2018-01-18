<?php

namespace app\components;

use Exception;

/**
 * Class FileReader
 * @package app\components
 * @description Reads from the file a word by a word
 */
final class FileReader
{
    const FILE_CHUNK_SIZE = 1000000; //may be tuned

    private static $DELIMITERS = [' ', "\t", "\n", "\r"];

    private $filename;

    private $fileHandle;

    /**
     * FileReader constructor.
     * @param string $filename
     */
    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    /**
     * @throws Exception
     * @description Returns the iterator that can be used in a foreach loop
     */
    public function getWords()
    {
        $chunk = $this->getChunk();
        $wordBuffer = '';

        while ($chunk !== false) {
            foreach (str_split($chunk) as $symbol) {
                if (!in_array($symbol, self::$DELIMITERS, true)) {
                    $wordBuffer .= $symbol;
                    continue;
                }

                if ($wordBuffer !== '') {
                    yield $wordBuffer;
                    $wordBuffer = '';
                }
            }

            $chunk = $this->getChunk();
        }

        if ($wordBuffer) {
            yield $wordBuffer;
        }
    }

    /**
     * @throws Exception
     * @description Reads a chunk from the file
     */
    private function getChunk()
    {
        $fileHandle = $this->getFileHandler();

        $chunk = fgets($fileHandle, self::FILE_CHUNK_SIZE);
        if ($chunk === false) {
            $this->closeFile();
        }

        return $chunk;
    }

    /**
     * @return resource
     * @throws Exception
     * @description Opens the file if necessary, and return the file handle
     */
    private function getFileHandler()
    {
        if (!$this->fileHandle) {
            $this->fileHandle = fopen($this->filename, 'r');

            if (!$this->fileHandle) {
                //this exception will be thrown if the PHP warnings is disabled
                throw new Exception('File is not available');
            }
        }

        return $this->fileHandle;
    }

    /**
     * @description Closes the file
     */
    private function closeFile()
    {
        fclose($this->fileHandle);
        $this->fileHandle = null;
    }
}