<?php
/* @var $data app\models\UsedItem */
/* @var $this \yii\web\View */

use yii\helpers\Html;

echo $this->render('../_common/backButton', ['link' => '/']);
echo $this->render('../_common/header', ['header' => Html::encode($data->title)]);
?>

<div class="row item-view-info">
    <div class="col-md-4">
        <img src="<?= $data->preview ?>" alt="<?= $data->title, ' preview' ?>" class="img-thumbnail">
    </div>
    <div class="col-md-8"><?= $this->render('_itemInfoTable', ['data' => $data]) ?></div>
</div>

<!--Prepare block for lightbox -->
<?= $data->photos ? $this->render('_previews', ['previews' => $data->photos]) : '' ?>