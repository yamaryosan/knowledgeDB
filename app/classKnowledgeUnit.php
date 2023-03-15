<?php

declare(strict_types=1);
/**
 * 知識ユニットのクラス
 * @param string $title タイトル
 * @param string $content 本文
 * 
 */

class KnowledgeUnit
{
    private $title, $content;

    public function __construct(string $string)
    {
        // "title……content"の形式に分割
        $lineArray = explode("……", $string);
        // 連想配列に格納
        $this->title = trim($lineArray[0]);
        $this->content = trim($lineArray[1]);
    }

    public function getTitle()
    {
        return $this->title;
    }
    public function getContent()
    {
        return $this->content;
    }
}
