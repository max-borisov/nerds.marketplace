<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use app\components\HelperPage;
use app\components\HelperUser;

$this->params['isItemPage'] = true;

echo $this->render('../shared/header', ['header' => HelperPage::FRONT_PAGE_HEADER]);

if (HelperUser::isGuest()) {
    echo '<p class="lead">You can add items after login.</p>';
} else {
    echo Html::tag(
        'p',
        Html::a('Add new item', '/item/create', ['type' => 'button', 'class' => 'btn btn-primary'])
    );
}
?>

<?= $this->render('_search', ['model' => $model]) ?>
<?= $this->render('_sort') ?>

<?php
if (Yii::$app->session->hasFlash('item_create_success')) {
    echo $this->render(
        '../shared/flashSuccess',
        ['message' => Yii::$app->session->getFlash('item_create_success')]
    );
}

if ($data) {
    echo '<p class="lead">There is <span class="badge">' . $allItemsCount . '</span> items found</p>';
    echo $this->render('../shared/linkPager', ['pages' => $pages]);
    foreach ($data as $usedItem) {
        echo $this->render('_item', ['data' => $usedItem]);
    }
    echo $this->render('../shared/linkPager', ['pages' => $pages]);

} else {
    echo Html::tag('p', 'There are no items appropriate for the filter.', ['class' => 'bg-info col-md-9 text-center']);
}
?>