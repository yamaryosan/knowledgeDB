<?php

declare(strict_types=1);

require_once("classKnowledgeUnit.php");

/**
 * 知識ユニットをDBから得るクラス
 * @param int $knowledgeId 知識ユニットのID
 */

class EachKnowledgeUnitGetter
{
    private int $knowledgeId;
    public function __construct($knowledgeId)
    {
        $this->knowledgeId = $knowledgeId;
    }
    public function getKnowledgeUnit()
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

        $tableName = "knowledge_table";
        $statement = $dbh->prepare("SELECT * FROM $tableName WHERE id = $this->knowledgeId LIMIT 1");
        $statement->execute();
        $result = $statement->fetchAll();
        $title = $result[0]["title"];
        $content = $result[0]["content"];
        $returnKnowledgeUnit = new KnowledgeUnit($title . "……" . $content);
        return $returnKnowledgeUnit;
    }
}
