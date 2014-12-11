<?php
use yii\helpers\Html;
use app\components\HelperUser;

$this->params['isUsedItemPage'] = true;
?>
<h1 class="text-center">Used items catalog</h1>
<hr>

<?php
if (HelperUser::isGuest()) {
    echo '<p class="lead">You can add items after login.</p>';
} else {
    echo Html::tag(
        'p',
        Html::a('Add new item', '/marketplace/create', ['type' => 'button', 'class' => 'btn btn-primary'])
    );
}
?>

<?= $this->render('_search', ['model' => $model]) ?>
<?= $this->render('_sort') ?>

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