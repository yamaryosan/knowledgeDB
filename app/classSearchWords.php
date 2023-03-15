<?php

declare(strict_types=1);
/**
 * 検索語群のクラス
 * 
 * @param array $words 検索語群
 */
class SearchWords
{
    private array $words;

    public function __construct($postWords)
    {
        $normalizedString = $this->normalize($postWords);
        $sanitizedString = $this->sanitize($normalizedString);
        $SearchWordsArray = $this->splitByComma($sanitizedString);
        $this->words = $this->format($SearchWordsArray);
    }

    public function getWords()
    {
        return $this->words;
    }

    public function getStringByComma()
    {
        $string = "";
        foreach ($this->words as $word) {
            $string .= $word . ",";
        }
        // 最後のコンマは除いて返す
        return rtrim($string, ",");
    }

    // 表記ゆれ解消
    public function normalize(string $string)
    {
        $stringWithComma = str_replace("、", ",", $string);
        return mb_convert_kana($stringWithComma, "asK", "UTF-8");
    }

    // サニタイジング
    public function sanitize(string $string)
    {
        return htmlspecialchars($string, ENT_QUOTES);
    }

    // コンマで区切る
    public function splitByComma(string $string)
    {
        $wordsArray = explode(",", $string);
        return $wordsArray;
    }

    // 検索語群の様式を整える
    function format(array $wordsArray)
    {
        foreach ($wordsArray as $key => $value) {
            // スペースを削除
            $wordsArray[$key] = trim($value);
            // 文字数がゼロの要素を削除
            if (strlen($wordsArray[$key]) === 0) {
                unset($wordsArray[$key]);
            }
        }
        return $wordsArray;
    }
}
