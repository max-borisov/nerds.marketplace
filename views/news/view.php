<?php
use app\components\HelperBase;

$this->params['isNewsPage'] = true;
?>
<div>
    <?= $this->render('../shared/backButton', ['link' => '/news']) ?>
    <div class="row">
        <div class="col-md-10 col-lg-offset-1">
            <h1 class="text-center"><?= $news->title ?></h1>
            <p class="news-af text-center">Af: <?= $news->af, '<span>[', HelperBase::formatDate($news->post_date) ,']</span>' ?></p>
            <p class="bg-info"><?= $news->notice ?></p>
            <div class="news-post"><?= $news->post ?></div>
        </div>
    </div>
</div>