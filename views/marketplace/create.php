<?php
/* @var $this yii\web\View */
/* @var $model UsedItems */

use yii\helpers\Html;
?>

<h1 class="text-center">Adding used item</h1>
<hr>

<?php
if ($model->hasErrors()) {
    echo Html::tag('div', Html::errorSummary($model), ['class' => 'errorSummary']);
}
?>

<?= $this->render('_create', [
    'model'         => $model,
    'modelPhoto'    => $modelPhoto,
    'categories'    => $categories
]) ?>
