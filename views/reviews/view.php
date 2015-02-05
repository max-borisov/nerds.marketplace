<?php
use app\components\HelperBase;

$this->params['isReviewsPage'] = true;
?>
<div>
    <?= $this->render('../shared/backButton', ['link' => '/reviews']) ?>
    <div class="row">
        <div class="col-md-10 col-lg-offset-1">
            <h1 class="text-center"><?= $review->title ?></h1>

            <?php if ($review->af ) { ?>
                <p class="news-af text-center">Af: <?= $review->af ?></p>
            <?php } ?>

            <?php if (!HelperBase::isZeroDate($review->post_date)) { ?>
                <p class="text-center"><span><?= HelperBase::formatDate($review->post_date) ?></span></p>
            <?php } ?>

            <?php if ($review->notice ) { ?>
                <p class="bg-info text-center"><?= $review->notice ?></p>
            <?php } ?>

            <hr>
            <div class="news-post"><?= $review->post ?></div>
        </div>
    </div>
</div>