<?php

declare(strict_types=1);
require_once("classKnowledgeUnit.php");

/**
 * ランダムな知識ユニットを出力するクラス
 */

class RandomKnowledgeUnitGetter
{
    public function countKnowledgeUnitNumber()
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
        $query = "SELECT COUNT(*) FROM $tableName";
        $statement = $dbh->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result[0]["COUNT(*)"];
    }
    public function get()
    {
        $count = $this->countKnowledgeUnitNumber();
        $randomInt = mt_rand(0, $count - 1);

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
        $query = "SELECT * FROM $tableName WHERE id = $randomInt";
        $statement = $dbh->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $title = $result[0]["title"];
        $content = $result[0]["content"];
        $randomKnowledgeUnit = new KnowledgeUnit($title . "……" . $content);
        return $randomKnowledgeUnit;
    }
}
