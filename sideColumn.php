<form class="search_form_container" name="search_form_container" action=<?php echo "preview" ?> method="POST">
    <div class="search_target_selection_container">
        <p>検索部位指定 : </p>
        <?php require("./app/functionSearchTarget.php") ?>
        <p>から検索</p>
    </div>
    <div class="search_window_container">
        <p>サイト内検索</p>
        <input type="text" name="search_word">
        <a href="javascript:search_form_container.submit()" id="search_btn">
            <img src="./images/glassIcon.png">
        </a>
    </div>
</form>
<div class="random_page_btn_container">
    <div class="btn">
        <a href="random">at random</a>
    </div>
</div>
<div class="recommend_article_container">
    <p>オススメ記事</p>
    <a href="top" class="clickable_area">
        <div class="article_unit_container">
            <img src="./images/noImageIcon.png">
            <p class="article_title">Pythonでスクレイピング入門 SeleniumとBS4を用いた業務自動化</p>
            <p class="article_date">2019.11.01</p>
        </div>
    </a>
    <a href="top" class="clickable_area">
        <div class="article_unit_container">
            <img src="./images/noImageIcon.png">
            <p class="article_title">Pythonで親ディレクトリからモジュールをimportする方法</p>
            <p class="article_date">2022.03.31</p>
        </div>
    </a>
    <a href="top" class="clickable_area">
        <div class="article_unit_container">
            <img src="./images/noImageIcon.png">
            <p class="article_title">【初心者必見】Excel VBAを使いこなすための基礎設定</p>
            <p class="article_date">2017.06.05</p>
        </div>
    </a>
</div>