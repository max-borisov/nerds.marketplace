<?php
/* @var $this yii\web\View */
/* @var $model UsedItem */

use yii\helpers\Html;
?>

<h1 class="text-center">Adding used item</h1>
<hr>

<?php
if ($model->hasErrors()) {
    echo Html::tag('div', Html::errorSummary($model), ['class' => 'error-summary']);
}
?>

<?= $this->render('_create', [
    'model'         => $model,
    'modelPhoto'    => $modelPhoto,
    'categories'    => $categories,
    'typeData'      => $typeData
]) ?>
