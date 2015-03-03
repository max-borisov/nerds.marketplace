<?php
/* @var $data app\models\Item */
/* @var $this yii\web\View */

use yii\helpers\Html;

?>
<table class="table table-striped item-info-table">
    <tbody>
        <?= $this->render('_data_common', ['data' => $data]) ?>
        <?= $this->render('_data_hifi_rec', ['data' => $data]) ?>
        <?= $this->render('_data_dba', ['data' => $data]) ?>
        <tr>
            <td colspan="2" class="text-center">
                <?= nl2br(Html::encode($data->description)) ?>
            </td>
        </tr>
    </tbody>
</table>
