<?php
use yii\helpers\Html;

/* @var $data UsedItems */
?>
<div class="row used-item-row">
    <div class="col-xs-3"><img src="http://placehold.it/150x150" alt="blank" class="img-rounded"></div>
    <div class="col-xs-5">
        <h3><?= ucfirst(Html::encode($data->title)) ?></h3>
        <div class="row">
            <div class="col-xs-2"><?= $data->getAttributeLabel('category_id') ?></div>
            <div class="col-xs-4"><strong><?= $data->category->title ?></strong></div>
        </div>
        <div class="row">
            <div class="col-xs-2"><?= $data->getAttributeLabel('warranty') ?></div>
            <div class="col-xs-4"><?= $data->warranty ? 'Yes' : 'No' ?></div>
        </div>
        <div class="row">
            <div class="col-xs-2"><?= $data->getAttributeLabel('invoice') ?></div>
            <div class="col-xs-4"><?= $data->invoice ? 'Yes' : 'No' ?></div>
        </div>
        <div class="row">
            <div class="col-xs-2"><?= $data->getAttributeLabel('packaging') ?></div>
            <div class="col-xs-4"><?= $data->packaging ? 'Yes' : 'No' ?></div>
        </div>
        <div class="row">
            <div class="col-xs-2"><?= $data->getAttributeLabel('manual') ?></div>
            <div class="col-xs-4"><?= $data->manual ? 'Yes' : 'No' ?></div>
        </div>
        <div class="row">
            <div class="col-xs-2"><?= $data->getAttributeLabel('type_id') ?></div>
            <div class="col-xs-4"><?= $data->type_id ? 'Yes' : 'No' ?></div>
        </div>

        <p class="item-description"><?= Html::encode($data->description) ?></p>

    </div>
    <div class="col-xs-4">
        <p class="item-price"><?= '$', $data->price ?></p>
    </div>
</div>
<hr>