<?php

namespace app\controllers;

use app\components\HelperBase;
use app\components\HelperMarketPlace;
use Yii;
use yii\web\Controller;
use yii\helpers;
use app\models\UsedItems;
use app\models\Category;
use yii\web\UploadedFile;

class MarketplaceController extends Controller
{
    public $layout = 'marketplace';

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new UsedItems();

        // Search request
        if (Yii::$app->request->get('UsedItems')) {
            $model->setScenario('search');
            $data = $model->search(Yii::$app->request->get());
        } else {
            $data = UsedItems::find()->orderBy(HelperMarketPlace::getSortParamForItemsList())->all();
        }
        return $this->render('index', ['data' => $data, 'model' => $model]);
    }

    public function actionCreate()
    {
        $model = new UsedItems();
        $model->setScenario('create');
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->validate() && $model->save(false)) {
                Yii::$app->session->setFlash('item_create_success', 'A new item has been added.');
                $this->redirect('/');
            }
        }
        $categories = (new Category())->prepareDropDown();
        return $this->render('create', ['model' => $model, 'categories' => $categories]);
    }
}
