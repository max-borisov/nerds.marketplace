<?php
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->params['isUsedItemsPage'] = true;
?>
<h1 class="text-center">Used items catalog</h1>
<hr>

<p>
    <?= Html::a('Add new item', '/marketplace/create', ['type' => 'button', 'class' => 'btn btn-primary']) ?>
</p>

<?= $this->render('_search', ['model' => $model]) ?>

<?php

if (Yii::$app->session->hasFlash('item_create_success')) {
    echo '<div class="alert alert-success" role="alert">' . Yii::$app->session->getFlash('item_create_success') . '</div>';
}

if ($data) {
    echo '<p class="lead">There is <span class="badge">' . count($data) . '</span> items found</p>';
    foreach ($data as $usedItem) {
        echo $this->render('_item', ['data' => $usedItem]);
    }
} else {
    echo Html::tag('p', 'There are no items appropriate for the filter.', ['class' => 'bg-info col-md-9 text-center']);
}

?>