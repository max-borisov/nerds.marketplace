<?php
/* @var $data app\models\Item */

use yii\helpers\Html;
use app\components\HelperBase;

?>
<tr>
    <td class="item-param-name"><?= $data->getAttributeLabel('warranty') ?></td>
    <td><?= HelperBase::getYesNoNaLabel($data->warranty) ?></td>
</tr>
<tr>
    <td class="item-param-name"><?= $data->getAttributeLabel('invoice') ?></td>
    <td><?= HelperBase::getYesNoNaLabel($data->invoice) ?></td>
</tr>
<tr>
    <td class="item-param-name"><?= $data->getAttributeLabel('packaging') ?></td>
    <td><?= HelperBase::getYesNoNaLabel($data->packaging) ?></td>
</tr>
<tr>
    <td class="item-param-name"><?= $data->getAttributeLabel('manual') ?></td>
    <td><?= HelperBase::getYesNoNaLabel($data->manual) ?></td>
</tr>
<tr>
    <td class="item-param-name"><?= $data->getAttributeLabel('price') ?></td>
    <td><?= $data->price, ' ', HelperBase::getParam('currency') ?></td>
</tr>
<tr>
    <td class="item-param-name"><?= $data->getAttributeLabel('category_id') ?></td>
    <td><?= $data->category->title ?></td>
</tr>
<tr>
    <td class="item-param-name"><?= $data->getAttributeLabel('ad_type_id') ?></td>
    <td><?= Html::encode($data->type->title) ?></td>
</tr>