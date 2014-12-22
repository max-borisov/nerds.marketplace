<?php
use yii\helpers\Html;
?>
<div class="row text-center item-previews-block">
    <ul class="list-inline">
    <?php
    foreach ($model->photos as $photo) {
        echo '<li>',Html::img($photo->thumb, ['alt' => '', 'class' => 'img-rounded'])  ,'</li>';
    }
    ?>
    </ul>
</div>