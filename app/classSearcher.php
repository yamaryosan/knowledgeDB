<?php

declare(strict_types=1);
/**
 * 検索を行うクラス
 * @param SearchWords $searchWords
 * 
 */
class Searcher
{
    private $searchWords;
    public function __construct(SearchWords $searchWords)
    {
        $this->searchWords = $searchWords;
    }
    function search(string $searchTarget)
    {
        $config = require("./config/config.php");

        $host = $config["database"]["host"];
        $db = $config["database"]["database"];
        $user = $config["database"]["username"];
        $pass = $config["database"]["password"];
        try {
            $dbh = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        } catch (PDOException $ex) {
            echo "アクセスできません : " . $ex->getMessage() . PHP_EOL;
            unset($dbh);
            die();
        }
        // 検索語でヒットする知識ユニットだけをDBから取得
        $table = "knowledge_table";

        // 検索場所や検索方法に対応してSQLを書き換える
        $statement = $this->createSearchSQLStatement($dbh, $table, $this->searchWords, $searchTarget);
        $statement->execute();
        $searchResultArray = $statement->fetchAll();
        return $searchResultArray;
    }

    // 検索方法に対応したSQL文のステートメントを生成
    public function createSearchSQLStatement(PDO $dbh, string $table, SearchWords $searchWords, string $searchTarget)
    {
        // クエリの前半の部分
        $SQLFirstPart = "SELECT * FROM $table WHERE ";
        // クエリの後半の部分
        $SQLLatterPart = "";
        $count = 1;
        foreach ($searchWords->getWords() as $word) {
            // タイトル検索、本文検索
            if ($searchTarget === "title") {
                $SQLSearchTarget = "title";
                $SQLLatterPart .= "$SQLSearchTarget LIKE :word$count OR ";
            } elseif ($searchTarget === "content") {
                $SQLSearchTarget = "content";
                $SQLLatterPart .= "$SQLSearchTarget LIKE :word$count OR ";
            } elseif ($searchTarget === "both") {
                $SQLLatterPart .= "title LIKE :word$count OR content LIKE :word$count OR ";
            }
            $count++;
        }
        // 一番最後の OR だけ不要なので取り除く
        $SQLLatterPart = rtrim($SQLLatterPart, " OR ");
        $SQLQuery = $SQLFirstPart . $SQLLatterPart;
        $statement = $dbh->prepare($SQLQuery);
        // プレースホルダーを置換
        $count = 1;
        foreach ($searchWords->getWords() as $word) {
            $statement->bindValue(":word$count", "%" . $word . "%");
            $count++;
        }
        return $statement;
    }
}
