<?php

use yii\helpers\Html;

// Data from DBA
?>
<?php if ($data->s_brand) { ?>
    <tr>
        <td class="item-param-name"><?= $data->getAttributeLabel('s_brand') ?></td>
        <td><?= Html::encode($data->s_brand) ?></td>
    </tr>
<?php } ?>
<?php if ($data->s_model) { ?>
    <tr>
        <td class="item-param-name"><?= $data->getAttributeLabel('s_model') ?></td>
        <td><?= Html::encode($data->s_model) ?></td>
    </tr>
<?php } ?>
<?php if ($data->s_producer) { ?>
    <tr>
        <td class="item-param-name"><?= $data->getAttributeLabel('s_producer') ?></td>
        <td><?= Html::encode($data->s_producer) ?></td>
    </tr>
<?php } ?>
<?php if ($data->s_watt) { ?>
    <tr>
        <td class="item-param-name"><?= $data->getAttributeLabel('s_watt') ?></td>
        <td><?= Html::encode($data->s_watt) . 'W' ?></td>
    </tr>
<?php } ?>
<?php if ($data->s_product) { ?>
    <tr>
        <td class="item-param-name"><?= $data->getAttributeLabel('s_product') ?></td>
        <td><?= Html::encode($data->s_product) ?></td>
    </tr>
<?php } ?>