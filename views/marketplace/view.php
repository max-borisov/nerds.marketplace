<?php
/* @var $data app\models\UsedItem */

use yii\helpers\Html;

//use app\components\HelperBase;
//HelperBase::dump($data->photos);
?>

<p><?= Html::a('Back', '/', ['class' => 'btn btn-default']) ?></p>
<h1 class="text-center"><?= Html::encode($data->title) ?></h1>

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
        <td><?= $data->price, ' DK' ?></td>
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
        <td><?= $data->type_id ?></td>
    </tr>
    <tr><td colspan="2" class="text-center"><?= $data->description ?></td></tr>
    </tbody>
</table>