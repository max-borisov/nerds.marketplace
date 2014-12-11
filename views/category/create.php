<?php
/* @var $model UsedItem */
/* @var $this yii\web\View */

use app\components\HelperPage;
?>

<?= $this->render('../_common/header', ['header' => HelperPage::ADD_NEW_CATEGORY_PAGE_HEADER]) ?>
<?= $this->render('_form', ['model' => $model]) ?>
