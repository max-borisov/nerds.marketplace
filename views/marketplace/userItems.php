<?php
/* @var $item app\models\UsedItem */
/* @var $this \yii\web\View */

use app\components\HelperPage;

echo $this->render('../_common/header', ['header' => HelperPage::USER_ITEMS_PAGE_HEADER]);

foreach ($data as $item) {
    echo $this->render('_item', ['data' => $item, 'showActionLinks' => true]);
}