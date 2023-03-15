<?php

declare(strict_types=1);
/**
 * 知識ユニットのクラス
 * @param array $knowledgeUnitArray 知識ユニットの配列
 */

class KnowledgeSaver
{
    private $knowledgeUnitArray;

    public function __construct(array $knowledgeUnitArray)
    {
        $this->knowledgeUnitArray = $knowledgeUnitArray;
    }

    // データベースに知識ユニットを保存
    public function save()
    {
        $config = require("./config/config.php");

        $host = $config["database"]["host"];
        $db = $config["database"]["database"];
        $user = $config["database"]["username"];
        $pass = $config["database"]["password"];
        try {
            $dbh = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        } catch (PDOException $ex) {
            // アクセスできなかったときの処理
            echo "アクセスできません : " . $ex->getMessage() . PHP_EOL;
            // 切断
            unset($dbh);
            die();
        }
        // テーブルがなければ、DBに作成
        $tableName = "knowledge_table";
        $statement = $dbh->prepare("CREATE TABLE IF NOT EXISTS $tableName(id INT(5), title TEXT, content TEXT);");
        $statement->execute();

        if (count($this->knowledgeUnitArray) === 0) {
            echo "DBにうまく保存できていないかも。" . PHP_EOL;
            die();
        }

        // テーブルにすでにある知識の個数をカウント
        $statement = $dbh->prepare("SELECT COUNT(*) FROM $tableName;");
        $statement->execute();
        $result = $statement->fetchAll();
        $idMinimum = $result[0]["COUNT(*)"] + 1; # IDの最小値

        // テーブルにデータを追加
        $count = $idMinimum;
        foreach ($this->knowledgeUnitArray as $knowledgeUnit) {
            $title = $knowledgeUnit->getTitle();
            $content = $knowledgeUnit->getContent();
            $statement = $dbh->prepare("INSERT INTO knowledge_table (id, title, content) VALUES (:id, :title, :content)");
            $statement->bindParam(":id", $count);
            $statement->bindParam(":title", $title);
            $statement->bindParam(":content", $content);
            $statement->execute();
            $count++;
        }
    }
}
