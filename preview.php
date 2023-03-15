<?php

declare(strict_types=1);

require_once("./app/classSearchWords.php");
require_once("./app/classSearcher.php");

$searchWordString = $_POST["search_word"];
$searchWords = new SearchWords($searchWordString);
$searchWordByComma = $searchWords->getStringByComma();
$searchTarget = $_POST["select_box"];

// 検索語が空の場合やり直しさせる
if (empty($searchWords->getWords())) {
    echo "<script>alert('検索語を入力してください。'); history.back();</script>";
    exit;
}

// 検索
$searcher = new Searcher($searchWords);
$searchResult = $searcher->search($searchTarget);

// ヒット数があまりに多い場合、やり直させる
$requestRetryHitNumber = 400;
if (count($searchResult) > $requestRetryHitNumber) {
    $alertJSFilePath = "./js/alertMessage.js";
    $jsCode = "<script src='$alertJSFilePath'></script>;";
    echo $jsCode;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>プレビュー</title>
    <link rel="stylesheet" href="./css/style_common.css">
    <link rel="stylesheet" href="./css/style_preview.css">
    <link rel="stylesheet" href="./css/style_side_column.css">
</head>

<body>
    <div class="wrapper">
        <header>
            <a href="top">プログラミング備忘録</a>
            <a href="top" class="mini_message">東京砂漠に生きる週末SE。<br>ここに備忘録を記します。</a>
        </header>
        <main>
            <div class="main_column">
                <!-- ヒット数 -->
                <div class="hit_number_text_container">
                    <?php require("./app/functionSearchResultAbstract.php") ?>
                </div>
                <!-- 結果 -->
                <div class="results_container">
                    <?php require("./app/functionSearchResult.php") ?>
                </div>
            </div>
            <div class="side_column">
                <?php require("sideColumn.php") ?>
            </div>
        </main>
    </div>
    <div class="page_lower_back_btn_container">
        <a href="top" class="page_lower_back_btn">戻る</a>
    </div>
    <div class="back_btn_container">
        <a href="top" class="back_btn">
            <img src="./images/backBtnIcon.png">
        </a>
    </div>
    <div class="to_top_btn_container">
        <a href="#" class="to_top_btn">
            <img src="./images/toTopIcon.png">
        </a>
    </div>
    <script type="module" src="./js/previewPageMoveController.js"></script>
    <script src="./js/toTopButtonScroll.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/0.7.0/marked.js"></script>
</body>

</html>