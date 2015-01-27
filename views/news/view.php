<div class="row">
    <div class="col-md-10 col-lg-offset-1">
        <h1><?= $news->title ?></h1>
        <p class="news-af">Af: <?= $news->af, '<span>[', $news->post_date ,']</span>' ?></p>
        <p class="bg-info"><?= $news->notice ?></p>
        <div class="news-post"><?= $news->post ?></div>
    </div>
</div>