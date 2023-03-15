<?php

/**
 *  NewDirectoryCreator 新しいディレクトリを作成するクラス
 * @param string $directoryName ディレクトリ名
 */

class NewDirectoryCreator
{
    private string $directoryName;
    public function __construct(string $directoryName)
    {
        $this->directoryName = $directoryName;
    }
    public function create()
    {
        if (!is_dir($this->directoryName)) {
            mkdir($this->directoryName, 0775, true);
        }
    }
}
