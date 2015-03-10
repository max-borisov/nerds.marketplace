<?php
use app\components\HelperBase;
?>
<div>
    <?= $this->render('../shared/backButton', ['link' => $backLink]) ?>
    <div class="row">
        <div class="col-md-10 col-lg-offset-1">
            <h1 class="text-center"><?= $data->title ?></h1>

            <?php if (!empty($data->af)) { ?>
                <p class="news-af text-center">Af: <?= $data->af ?></p>
            <?php } ?>

            <?php if (!HelperBase::isZeroDate($data->post_date)) { ?>
                <p class="text-center"><span><?= HelperBase::formatDate($data->post_date) ?></span></p>
            <?php } ?>

            <?php if (!empty($data->notice)) { ?>
                <p class="bg-info text-center"><?= $data->notice ?></p>
            <?php } ?>

            <hr>
            <div class="news-post"><?= $data->post ?></div>
        </div>
    </div>
</div