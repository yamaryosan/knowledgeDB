<?php

declare(strict_types=1);
require_once("./app/classEachKnowledgeUnitGetter.php");
require_once("./app/classSearchWords.php");

$knowledgeId = (int)$_GET["article_id"];
$eachKnowledgeUnitGetter = new EachKnowledgeUnitGetter($knowledgeId);
$knowledgeUnit = $eachKnowledgeUnitGetter->getKnowledgeUnit();
?>

<!DOCTYPE html>
<html>

<head>
    <title>プログラミング備忘録</title>
    <link rel="stylesheet" href="./css/style_common.css">
    <link rel="stylesheet" href="./css/style_detail.css">
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
                <div class="title_container">
                    <h3>
                        <?php echo $knowledgeUnit->getTitle() ?>
                    </h3>
                </div>
                <div class="content_container">
                    <?php $contentString = $knowledgeUnit->getContent() ?>
                    <p><?php echo $contentString ?></p>
                </div>
                <?php require("./app/previewPagefiller.php") ?>
            </div>
            <div class="side_column">
                <?php require("sideColumn.php") ?>
            </div>
            <div class="back_btn_container">
                <a href="javascript:history.back()" class="back_btn">
                    <img src="./images/backBtnIcon.png">
                </a>
            </div>
        </main>
    </div>
</body>

</html>