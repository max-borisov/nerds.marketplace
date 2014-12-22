<?php
/* @var $this yii\web\View */
/* @var $model UsedItem */

use yii\helpers\Html;
use app\components\HelperPage;

echo $this->render('../_common/backButton', ['link' => '/items']);
echo $this->render('../_common/header', ['header' => HelperPage::EDIT_ITEM_PAGE_HEADER]);

if (Yii::$app->session->hasFlash('edit_item_upload_photo_success')) {
    echo $this->render(
        '../_common/flashSuccess',
        ['message' => Yii::$app->session->getFlash('edit_item_upload_photo_success')]
    );
}

if (Yii::$app->session->hasFlash('edit_item_upload_photo_error')) {
    echo $this->render(
        '../_common/flashError',
        ['message' => Yii::$app->session->getFlash('edit_item_upload_photo_error')]
    );
}

if ($model->hasErrors()) {
    echo Html::tag('div', Html::errorSummary($model), ['class' => 'error-summary']);
}
?>

<?= $this->render('_create', [
    'model'         => $model,
    'categories'    => $categories,
    'typeData'      => $typeData
]) ?>

<?= $this->render('_upload', ['model' => $modelPhoto, 'item' => $model] ) ?>
<?= $model->photos ? $this->render('_images', ['model' => $model]) : '' ?>
