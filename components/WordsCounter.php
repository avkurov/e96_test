<?php

namespace app\components;

/**
 * Class WordsCounter
 * @package app\components
 * @description Builds a sorted array of a words occurrence from the given iterable
 */
final class WordsCounter
{
    public function countWords(iterable $words): array
    {
        $result = [];

        foreach ($words as $word) {
            $word = $this->normalizeWord($word);
            $result[$word] = ($result[$word] ?? 0) + 1;
        }

        arsort($result);

        return $result;
    }

    private function normalizeWord(string $word): string
    {
        preg_match('/^\p{L}+/u', $word, $matches);
        $word = $matches[0];

        return mb_strtolower($word, 'utf-8');
    }
}