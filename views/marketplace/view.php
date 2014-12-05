<?php
/* @var $data app\models\UsedItem */
/* @var $this \yii\web\View */

use yii\helpers\Html;

//use app\components\HelperBase;
//HelperBase::dump($data->photos);
?>

<p><?= Html::a('Back', '/', ['class' => 'btn btn-default']) ?></p>
<h1 class="text-center"><?= Html::encode($data->title) ?></h1>

<div class="row item-view-info">
    <div class="col-md-4">
        <img src="<?= $data->preview ?>" alt="<?= $data->title, ' preview' ?>" class="img-thumbnail">
    </div>
    <div class="col-md-8"><?= $this->render('_itemInfoTable', ['data' => $data]) ?></div>
</div>

