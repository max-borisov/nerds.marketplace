<?php
use app\components\HelperBase;

$this->params['isNewsPage'] = true;
?>
<div>
    <?= $this->render('../shared/backButton', ['link' => '/news']) ?>
    <div class="row">
        <div class="col-md-10 col-lg-offset-1">
            <h1 class="text-center"><?= $news->title ?></h1>

            <?php if ($news->af ) { ?>
                <h4 class="news-af text-center">Af: <?= $news->af ?></h4>
            <?php } ?>

            <?php if (!HelperBase::isZeroDate($news->post_date)) { ?>
                <p class="text-center"><span>[<?= HelperBase::formatDate($news->post_date) ?>]</span></p>
            <?php } ?>

            <?php if ($news->notice ) { ?>
                <p class="bg-info text-center"><?= $news->notice ?></p>
            <?php } ?>

            <hr>
            <div class="news-post"><?= $news->post ?></div>
        </div>
    </div>
</div>