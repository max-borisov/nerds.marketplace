<?php
use yii\helpers\Html;
?>
<div class="row text-center item-previews-block">
    <?php
    foreach ($model->photos as $photo) {
        echo
            '<div class="col-md-4">',
            Html::img($photo->thumb, ['alt' => '', 'class' => 'img-rounded']),
            Html::tag('div', Html::a('Delete', '/item/preview/delete/' . $photo['id'], ['class' => 'delete-item-image'])),
            '</div>';
    }
    ?>
</div>