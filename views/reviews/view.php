<?php
use app\components\HelperBase;

$this->params['isReviewsPage'] = true;
?>
<div>
    <?= $this->render('../shared/backButton', ['link' => '/reviews']) ?>
    <div class="row">
        <div class="col-md-10 col-lg-offset-1">
            <h1 class="text-center"><?= $review->title ?></h1>
            <p class="news-af text-center">Af: <?= $review->af, '<span>[', HelperBase::formatDate($review->post_date) ,']</span>' ?></p>
            <p class="bg-info"><?= $review->notice ?></p>
            <div class="news-post"><?= $review->post ?></div>
        </div>
    </div>
</div>