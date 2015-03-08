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
<?php if ($data->media_title) { ?>
    <tr>
        <td class="item-param-name"><?= $data->getAttributeLabel('media_title') ?></td>
        <td><?= Html::encode($data->media_title) ?></td>
    </tr>
<?php } ?>
<?php if ($data->media_genre) { ?>
    <tr>
        <td class="item-param-name"><?= $data->getAttributeLabel('media_genre') ?></td>
        <td><?= Html::encode($data->media_genre) ?></td>
    </tr>
<?php } ?>
<?php if ($data->media_type) { ?>
    <tr>
        <td class="item-param-name"><?= $data->getAttributeLabel('media_type') ?></td>
        <td><?= Html::encode($data->media_type) ?></td>
    </tr>
<?php } ?>
<?php if ($data->media_producer) { ?>
    <tr>
        <td class="item-param-name"><?= $data->getAttributeLabel('media_producer') ?></td>
        <td><?= Html::encode($data->media_producer) ?></td>
    </tr>
<?php } ?>
<?php if ($data->music_artist) { ?>
    <tr>
        <td class="item-param-name"><?= $data->getAttributeLabel('music_artist') ?></td>
        <td><?= Html::encode($data->music_artist) ?></td>
    </tr>
<?php } ?>
<?php if ($data->media_features) { ?>
    <tr>
        <td class="item-param-name"><?= $data->getAttributeLabel('media_features') ?></td>
        <td><?= Html::encode($data->media_features) ?></td>
    </tr>
<?php } ?>
<?php if ($data->media_inches) { ?>
    <tr>
        <td class="item-param-name"><?= $data->getAttributeLabel('media_inches') ?></td>
        <td><?= Html::encode($data->media_inches) ?></td>
    </tr>
<?php } ?>
<?php if ($data->media_size) { ?>
    <tr>
        <td class="item-param-name"><?= $data->getAttributeLabel('media_size') ?></td>
        <td><?= Html::encode($data->media_size) ?></td>
    </tr>
<?php } ?>
<?php if ($data->eq_capacity) { ?>
    <tr>
        <td class="item-param-name"><?= $data->getAttributeLabel('eq_capacity') ?></td>
        <td><?= Html::encode($data->eq_capacity) ?></td>
    </tr>
<?php } ?>
<?php if ($data->hd_capacity) { ?>
    <tr>
        <td class="item-param-name"><?= $data->getAttributeLabel('hd_capacity') ?></td>
        <td><?= Html::encode($data->hd_capacity) ?></td>
    </tr>
<?php } ?>
<?php if ($data->camera_resolution) { ?>
    <tr>
        <td class="item-param-name"><?= $data->getAttributeLabel('camera_resolution') ?></td>
        <td><?= Html::encode($data->camera_resolution) ?></td>
    </tr>
<?php } ?>
<?php if ($data->optical_zoom) { ?>
    <tr>
        <td class="item-param-name"><?= $data->getAttributeLabel('optical_zoom') ?></td>
        <td><?= Html::encode($data->optical_zoom) ?></td>
    </tr>
<?php } ?>
<?php if ($data->speaker) { ?>
    <tr>
        <td class="item-param-name"><?= $data->getAttributeLabel('speaker') ?></td>
        <td><?= Html::encode($data->speaker) ?></td>
    </tr>
<?php } ?>
<?php if ($data->speaker_type) { ?>
    <tr>
        <td class="item-param-name"><?= $data->getAttributeLabel('speaker_type') ?></td>
        <td><?= Html::encode($data->speaker_type) ?></td>
    </tr>
<?php } ?>
<?php if ($data->channels) { ?>
    <tr>
        <td class="item-param-name"><?= $data->getAttributeLabel('channels') ?></td>
        <td><?= Html::encode($data->channels) ?></td>
    </tr>
<?php } ?>
