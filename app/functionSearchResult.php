<?php for ($i = 0; $i <= count($searchResult) - 1; $i++) : ?>
    <?php $knowledgeId = $searchResult[$i]["id"] ?>
    <?php $titleString = $searchResult[$i]["title"] ?>
    <?php $showingCharactersNumber = 200 ?>
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
                <p><?php echo $contentString . "……" ?></p>
                <p><?php require("previewPagefiller.php") ?></p>
            </div>
        </a>
    </div>
<?php endfor ?> <br>