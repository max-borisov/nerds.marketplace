<?php
/* @var $data app\models\Item */
/* @var $this \yii\web\View */

use yii\helpers\Html;

$this->params['isItemPage'] = true;

echo $this->render('../shared/backButton', ['link' => '/']);
echo $this->render('../shared/header', ['header' => Html::encode($data->title)]);
?>

<div class="row item-view-info">
    <div class="col-md-4">
        <img src="<?= $data->preview ?>" alt="<?= $data->title, ' preview' ?>" class="img-thumbnail">
    </div>
    <div class="col-md-8"><?= $this->render('_view', ['data' => $data]) ?></div>
</div>

<!--Prepare block for lightbox -->
<?= $data->photos ? $this->render('_previews', ['previews' => $data->photos]) : '' ?>