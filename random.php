<?php

require_once("./app/classRandomKnowledgeUnitGetter.php");

// キャッシュを使わせない(クッキーを利用するため)
header("Cache-Control: no-cache, must-revalidate");

$randomKnowledgeUnitGetter = new RandomKnowledgeUnitGetter();
$knowledgeUnit = $randomKnowledgeUnitGetter->get();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>結果表示</title>
    <link rel="stylesheet" href="./css/style_common.css">
    <link rel="stylesheet" href="./css/style_random.css">
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
                <p>更新ボタンを押すだけでも新しい知識が更新されます</p>
                <div class="title_container">
                    <h3>
                        <?php echo $knowledgeUnit->getTitle() ?>
                    </h3>
                </div>
                <div class="content_container">
                    <p><?php echo $knowledgeUnit->getContent() ?></p>
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