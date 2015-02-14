<?php
/* @var $this yii\web\View */
/* @var $model Item */

use yii\helpers\Html;
use app\components\HelperPage;

echo $this->render('../shared/header', ['header' => HelperPage::NEW_ITEM_PAGE_HEADER]);

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
