<?php
/* @var $item app\models\UsedItem */
/* @var $this \yii\web\View */

use app\components\HelperPage;

echo $this->render('../shared/header', ['header' => HelperPage::USER_ITEMS_PAGE_HEADER]);

if (Yii::$app->session->hasFlash('item_delete_success')) {
    echo $this->render(
        '../shared/flashSuccess',
        ['message' => Yii::$app->session->getFlash('item_delete_success')]
    );
}

if (Yii::$app->session->hasFlash('item_edit_success')) {
    echo $this->render(
        '../shared/flashSuccess',
        ['message' => Yii::$app->session->getFlash('item_edit_success')]
    );
}

if (Yii::$app->session->hasFlash('item_delete_error')) {
    echo $this->render(
        '../shared/flashError',
        ['message' => Yii::$app->session->getFlash('item_delete_error')]
    );
}

foreach ($data as $item) {
    echo $this->render('_item', ['data' => $item, 'showActionLinks' => true]);
}