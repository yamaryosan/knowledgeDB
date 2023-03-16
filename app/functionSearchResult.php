<?php for ($i = 0; $i <= count($searchResult) - 1; $i++) : ?>
    <?php $knowledgeId = $searchResult[$i]["id"] ?>
    <?php $titleString = $searchResult[$i]["title"] ?>
    <?php $showingCharactersNumber = 200 ?>
    <?php $wordCount = mb_strlen($searchResult[$i]["content"]) ?>
    <?php $contentString = mb_substr($searchResult[$i]["content"], 0, $showingCharactersNumber) ?>
    <?php $link = "detail?&article_id=$knowledgeId" ?>
    <div class="unit_container">
        <a href=<?php echo $link ?> class="clickable_area">
            <div class="title_container">
                <h3>
                    <?php echo $titleString ?>
                </h3>
            </div>
            <div class="content_container">
                <?php if ($wordCount > $showingCharactersNumber) : ?>
                    <p><?php echo $contentString . "……" ?></p>
                <?php else : ?>
                    <p><?php echo $contentString ?></p>
                <?php endif ?>
                <p><?php require("previewPagefiller.php") ?></p>
            </div>
        </a>
    </div>
<?php endfor ?> <br>