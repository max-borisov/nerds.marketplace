<?php
/* @var $model UsedItem */

use app\components\HelperPage;
?>

<?= $this->render('../_common/header', ['header' => HelperPage::UPDATE_CATEGORY_PAGE_HEADER]); ?>
<?= $this->render('_form', ['model' => $model]) ?>