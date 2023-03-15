<?php if (count($searchResult) === 0) : ?>
    <p>
        <?php echo "一件もヒットしませんでした。" ?>
    </p>
    <?php require("previewPagefiller.php") ?>
<?php else : ?>
    <p>
        <span>
            <?php echo count($searchResult) ?>
        </span>
        件ヒットしました。
    </p>
<?php endif ?>