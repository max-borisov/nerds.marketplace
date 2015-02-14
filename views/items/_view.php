<?php

use yii\helpers\Html;
use app\components\HelperBase;

?>
<table class="table table-striped item-info-table">
    <tbody>
    <tr>
        <td class="item-param-name"><?= $data->getAttributeLabel('warranty') ?></td>
        <td><?= $data->warranty ? 'Yes' : 'No' ?></td>
    </tr>
    <tr>
        <td class="item-param-name"><?= $data->getAttributeLabel('invoice') ?></td>
        <td><?= $data->invoice ? 'Yes' : 'No' ?></td>
    </tr>
    <tr>
        <td class="item-param-name"><?= $data->getAttributeLabel('packaging') ?></td>
        <td><?= $data->packaging ? 'Yes' : 'No' ?></td>
    </tr>
    <tr>
        <td class="item-param-name"><?= $data->getAttributeLabel('manual') ?></td>
        <td><?= $data->manual ? 'Yes' : 'No' ?></td>
    </tr>
    <tr>
        <td class="item-param-name"><?= $data->getAttributeLabel('price') ?></td>
        <td><?= $data->price, ' ', HelperBase::getParam('currency') ?></td>
    </tr>
    <tr>
        <td class="item-param-name"><?= $data->getAttributeLabel('warranty') ?></td>
        <td><?= $data->warranty ? 'Yes' : 'No' ?></td>
    </tr>
    <tr>
        <td class="item-param-name"><?= $data->getAttributeLabel('category_id') ?></td>
        <td><?= $data->category->title ?></td>
    </tr>
    <tr>
        <td class="item-param-name"><?= $data->getAttributeLabel('type_id') ?></td>
        <td><?= Html::encode($data->type->title) ?></td>
    </tr>


    <!-- Show parsed data -->
    <?php if ($user = $data->s_user) { ?>
    <tr>
        <td class="item-param-name"><?= $data->getAttributeLabel('s_user') ?></td>
        <td><?= Html::encode($data->s_user) ?></td>
    </tr>
    <?php } ?>
    <?php if ($user = $data->s_location) { ?>
        <tr>
            <td class="item-param-name"><?= $data->getAttributeLabel('s_location') ?></td>
            <td><?= Html::encode($data->s_location) ?></td>
        </tr>
    <?php } ?>
    <?php if ($user = $data->s_phone) { ?>
        <tr>
            <td class="item-param-name"><?= $data->getAttributeLabel('s_phone') ?></td>
            <td><?= Html::encode($data->s_phone) ?></td>
        </tr>
    <?php } ?>
    <?php if ($user = $data->s_email) { ?>
        <tr>
            <td class="item-param-name"><?= $data->getAttributeLabel('s_email') ?></td>
            <td><?= HelperBase::encodeEmail($data->s_email) ?></td>
        </tr>
    <?php } ?>
    <?php if ($user = $data->s_adv) { ?>
        <tr>
            <td class="item-param-name"><?= $data->getAttributeLabel('s_adv') ?></td>
            <td><?= Html::encode($data->s_adv) ?></td>
        </tr>
    <?php } ?>
    <?php if ($user = $data->s_age) { ?>
        <tr>
            <td class="item-param-name"><?= $data->getAttributeLabel('s_age') ?></td>
            <td><?= Html::encode($data->s_age) ?></td>
        </tr>
    <?php } ?>
    <?php if ($user = $data->s_warranty) { ?>
        <tr>
            <td class="item-param-name"><?= $data->getAttributeLabel('s_warranty') ?></td>
            <td><?= Html::encode($data->s_warranty) ?></td>
        </tr>
    <?php } ?>
    <?php if ($user = $data->s_package) { ?>
        <tr>
            <td class="item-param-name"><?= $data->getAttributeLabel('s_package') ?></td>
            <td><?= Html::encode($data->s_package) ?></td>
        </tr>
    <?php } ?>
    <?php if ($user = $data->s_delivery) { ?>
        <tr>
            <td class="item-param-name"><?= $data->getAttributeLabel('s_delivery') ?></td>
            <td><?= Html::encode($data->s_delivery) ?></td>
        </tr>
    <?php } ?>
    <?php if ($user = $data->s_manual) { ?>
        <tr>
            <td class="item-param-name"><?= $data->getAttributeLabel('s_manual') ?></td>
            <td><?= Html::encode($data->s_manual) ?></td>
        </tr>
    <?php } ?>
    <?php if ($user = $data->s_akn) { ?>
        <tr>
            <td class="item-param-name"><?= $data->getAttributeLabel('s_akn') ?></td>
            <td><?= Html::encode($data->s_akn) ?></td>
        </tr>
    <?php } ?>
    <?php if ($user = $data->s_expires) { ?>
        <tr>
            <td class="item-param-name"><?= $data->getAttributeLabel('s_expires') ?></td>
            <td><?= $data->s_expires ?></td>
        </tr>
    <?php } ?>
    <tr>
        <td class="item-param-name"><?= $data->getAttributeLabel('s_date') ?></td>
        <td>
        <?php
            if (HelperBase::isZeroDate($data->s_date)) {
                echo HelperBase::formatDate($data->created_at, true);
            } else {
                echo HelperBase::formatDate($data->s_date);
            }
        ?></td>
    </tr>
    <tr><td colspan="2" class="text-center"><?= nl2br(Html::encode($data->description)) ?></td></tr>
    </tbody>
</table>