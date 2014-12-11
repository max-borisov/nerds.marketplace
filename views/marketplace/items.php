<?php
/* @var $item app\models\UsedItem */
/* @var $this \yii\web\View */

use app\components\HelperPage;

echo $this->render('../_common/header', ['header' => HelperPage::USER_ITEMS_PAGE_HEADER]);

if (Yii::$app->session->hasFlash('item_delete_success')) {
    echo $this->render(
        '../_common/flashSuccess',
        ['message' => Yii::$app->session->getFlash('item_delete_success')]
    );
}

if (Yii::$app->session->hasFlash('item_delete_error')) {
    echo $this->render(
        '../_common/flashError',
        ['message' => Yii::$app->session->getFlash('item_delete_error')]
    );
}

foreach ($data as $item) {
    echo $this->render('_item', ['data' => $item, 'showActionLinks' => true]);
}