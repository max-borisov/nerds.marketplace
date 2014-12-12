<?php
/* @var $this yii\web\View */
/* @var $model UsedItem */

use yii\helpers\Html;
use app\components\HelperPage;

echo $this->render('../_common/backButton', ['link' => '/items']);
echo $this->render('../_common/header', ['header' => HelperPage::EDIT_ITEM_PAGE_HEADER]);

if ($model->hasErrors()) {
    echo Html::tag('div', Html::errorSummary($model), ['class' => 'error-summary']);
}
?>

<?= $this->render('_create', [
    'model'         => $model,
    'categories'    => $categories,
    'typeData'      => $typeData
]) ?>
