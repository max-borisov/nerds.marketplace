<?php
use yii\helpers\Html;
?>
<div class="row text-center item-previews-block">
    <ul class="list-inline">
    <?php
    foreach ($model->photos as $photo) {
        echo '<li>',
            Html::img($photo->thumb, ['alt' => '', 'class' => 'img-rounded']),
            Html::tag('div', Html::a('Delete', '/item/preview/delete/' . $photo['id'], ['class' => 'delete-item-image']))
        ,'</li>';
    }
    ?>
    </ul>
</div>