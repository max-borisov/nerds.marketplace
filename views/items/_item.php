<?php
use yii\helpers\Html;
use app\components\HelperBase;
use app\components\HelperUser;
use app\components\HelperMarketPlace;

$itemLink = '/item/view/' . $data->id;

/* @var $data Item */
?>
<div class="row used-item-row">
    <div class="col-md-4">
        <?= Html::a(
            Html::tag('img', '', ['src' => $data->preview, 'alt' => $data->title . ' preview', 'class' => 'img-rounded']),
            $itemLink
        ) ?>
    </div>
    <div class="col-md-5">
        <h3><?= Html::a(ucfirst(Html::encode($data->title)), $itemLink) . ' - [' . $data->type->title . ']' ?></h3>
        <?php if (!HelperUser::isGuest()) { ?>
        <div class="row">
            <div class="col-xs-3">Post author:</div>
            <div class="col-xs-4">
                <strong>
                <?php
                if ($data->user) {
                    $userName = $data->user->username;
                    $href = HelperBase::getForumProfileLink($data->user->id);
                } else {
                    $userName = $data->s_user;
                    $href = '#';
                }
                echo Html::a($userName, $href, ['target' => '_blank']);
                ?>
                </strong>
            </div>
        </div>
        <?php } ?>
        <div class="row">
            <div class="col-xs-3"><?= $data->getAttributeLabel('category_id') ?></div>
            <div class="col-xs-4">
                <strong>
                    <?php
                    if (!empty($data->s_type)) {
                        echo $data->s_type;
                    } else {
                        echo $data->category->title;
                    }
                    ?>
                </strong></div>
        </div>
        <div class="row">
            <div class="col-xs-3"><?= $data->getAttributeLabel('warranty') ?></div>
            <div class="col-xs-4"><?= HelperBase::getYesNoNaLabel($data->warranty) ?></div>
        </div>
        <div class="row">
            <div class="col-xs-3"><?= $data->getAttributeLabel('invoice') ?></div>
            <div class="col-xs-4"><?= HelperBase::getYesNoNaLabel($data->invoice) ?></div>
        </div>
        <div class="row">
            <div class="col-xs-3"><?= $data->getAttributeLabel('packaging') ?></div>
            <div class="col-xs-4"><?= HelperBase::getYesNoNaLabel($data->packaging) ?></div>
        </div>
        <div class="row">
            <div class="col-xs-3"><?= $data->getAttributeLabel('manual') ?></div>
            <div class="col-xs-4"><?= HelperBase::getYesNoNaLabel($data->manual) ?></div>
        </div>
        <div class="row">
            <div class="col-xs-3"><?= $data->getAttributeLabel('s_date') ?></div>
            <div class="col-xs-4">
                <?php
                echo HelperBase::isZeroDate($data->s_date) ? HelperBase::formatDate($data->created_at, true) : HelperBase::formatDate($data->s_date);
                ?>
            </div>
        </div>
        <p class="item-description">
            <?= Html::encode(HelperMarketPlace::makeShortDescription(
                $data->description,
                HelperBase::getParam('itemDescriptionMaxLength')))
            ?>
        </p>
        <p class="more-link"><?= Html::a('More', $itemLink) ?></p>
    </div>
    <div class="col-md-3">
        <p class="item-price text-center"><?= $data->price, ' ', HelperBase::getParam('currency') ?></p>
        <?php
        // Show action links
        if (isset($showActionLinks) && $showActionLinks == true) {
        ?>
        <div class="item-action-links">
            <?= Html::a('Edit', '/item/edit/' . $data->id, ['class' => 'btn btn-info pull-left']) ?>
            <?= Html::a('Delete', '/item/delete/' . $data->id, ['class' => 'btn btn-danger pull-right item-delete']) ?>
        </div>
        <?php } ?>
    </div>
</div>
<hr>