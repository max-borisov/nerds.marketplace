<?php
/* @var $this yii\web\View */
/* @var $model Item */

use yii\helpers\Html;
use app\components\HelperPage;

echo $this->render('../shared/backButton', ['link' => '/items']);
echo $this->render('../shared/header', ['header' => HelperPage::EDIT_ITEM_PAGE_HEADER]);

if (Yii::$app->session->hasFlash('edit_item_upload_photo_success')) {
    echo $this->render(
        '../shared/flashSuccess',
        ['message' => Yii::$app->session->getFlash('edit_item_upload_photo_success')]
    );
}

if (Yii::$app->session->hasFlash('edit_item_upload_photo_error')) {
    echo $this->render(
        '../shared/flashError',
        ['message' => Yii::$app->session->getFlash('edit_item_upload_photo_error')]
    );
}

if (Yii::$app->session->hasFlash('item_preview_delete_success')) {
    echo $this->render(
        '../shared/flashSuccess',
        ['message' => Yii::$app->session->getFlash('item_preview_delete_success')]
    );
}

if (Yii::$app->session->hasFlash('item_preview_delete_error')) {
    echo $this->render(
        '../shared/flashError',
        ['message' => Yii::$app->session->getFlash('item_preview_delete_error')]
    );
}

if ($model->hasErrors()) {
    echo Html::tag('div', Html::errorSummary($model), ['class' => 'error-summary']);
}
?>

<?= $this->render('_create', [
    'model'         => $model,
    'categories'    => $categories,
    'adData'        => $adData
]) ?>

<?= $this->render('_upload', ['model' => $modelPhoto, 'item' => $model] ) ?>
<?= $model->photos ? $this->render('_images', ['model' => $model]) : '' ?>
