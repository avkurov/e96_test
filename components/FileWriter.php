<?php

namespace app\components;

use Exception;

/**
 * Class FileWriter
 * @package app\components
 * @description Writes the iterable to given file
 */
final class FileWriter
{
    private $filename;

    /**
     * FileWriter constructor.
     * @param string $filename
     */
    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    /**
     * @param iterable $lines
     * @throws Exception
     */
    public function writeLines(iterable $lines): void
    {
        $fileHandle = $this->getFileHandle();

        foreach ($lines as $key => $value) {
            fputs($fileHandle, "$key - $value" . PHP_EOL);
        }

        fclose($fileHandle);
    }

    /**
     * @return bool|resource
     * @throws Exception
     */
    private function getFileHandle()
    {
        $fileHandle = fopen($this->filename, 'w');
        if (!$fileHandle) {
            throw new Exception('File to write is not available');
        }

        return $fileHandle;
    }
}