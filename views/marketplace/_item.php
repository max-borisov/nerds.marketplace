<?php
use yii\helpers\Html;
use app\components\HelperBase;
use app\components\HelperUser;

/* @var $data UsedItem */
?>
<div class="row used-item-row">
    <div class="col-md-4">
        <?= Html::a(
            Html::tag('img', '', ['src' => $data->preview, 'alt' => $data->title . ' preview', 'class' => 'img-rounded']),
            '/item/view/' . $data->id
        ) ?>
    </div>
    <div class="col-md-5">
        <h3><?= ucfirst(Html::encode($data->title)) ?></h3>
        <?php if (!HelperUser::isGuest()) { ?>
        <div class="row">
            <div class="col-xs-3">Post author:</div>
            <div class="col-xs-4">
                <strong>
                <?= Html::a(
                    $data->user->username,
                    HelperBase::getForumProfileLink($data->user->id),
                    ['target' => '_blank']
                ) ?>
                </strong>
            </div>
        </div>
        <?php } ?>
        <div class="row">
            <div class="col-xs-3"><?= $data->getAttributeLabel('category_id') ?></div>
            <div class="col-xs-4"><strong><?= $data->category->title ?></strong></div>
        </div>
        <div class="row">
            <div class="col-xs-3"><?= $data->getAttributeLabel('warranty') ?></div>
            <div class="col-xs-4"><?= $data->warranty ? 'Yes' : 'No' ?></div>
        </div>
        <div class="row">
            <div class="col-xs-3"><?= $data->getAttributeLabel('invoice') ?></div>
            <div class="col-xs-4"><?= $data->invoice ? 'Yes' : 'No' ?></div>
        </div>
        <div class="row">
            <div class="col-xs-3"><?= $data->getAttributeLabel('packaging') ?></div>
            <div class="col-xs-4"><?= $data->packaging ? 'Yes' : 'No' ?></div>
        </div>
        <div class="row">
            <div class="col-xs-3"><?= $data->getAttributeLabel('manual') ?></div>
            <div class="col-xs-4"><?= $data->manual ? 'Yes' : 'No' ?></div>
        </div>
        <div class="row">
            <div class="col-xs-3"><?= $data->getAttributeLabel('type_id') ?></div>
            <div class="col-xs-4"><?= $data->type_id ? 'Yes' : 'No' ?></div>
        </div>
        <div class="row">
            <div class="col-xs-3"><?= $data->getAttributeLabel('created_at') ?></div>
            <div class="col-xs-4"><?= date('d/m/Y H:i', $data->created_at) ?></div>
        </div>
        <p class="item-description"><?= Html::encode($data->description) ?></p>
        <p class="more-link"><?= Html::a('More', '/item/view/' . $data->id) ?></p>
    </div>
    <div class="col-md-3">
        <p class="item-price text-center"><?= $data->price, ' ', HelperBase::getParam('currency') ?></p>
        <?php
        // Show action links
        if (isset($showActionLinks) && $showActionLinks == true) {
        ?>
        <div class="item-action-links">
            <?= Html::a('Edit', '/item/edit/' . $data->id, ['class' => 'btn btn-info pull-left']) ?>
            <?= Html::a('Delete', '/item/delete/' . $data->id, ['class' => 'btn btn-danger pull-right']) ?>
        </div>
        <?php } ?>
    </div>
</div>
<hr>