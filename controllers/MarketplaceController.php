<?php

namespace app\controllers;

use Yii;
use yii\helpers;
use app\components\HelperBase;
use app\components\HelperMarketPlace;
use app\models\UsedItems;
use app\models\UsedItemPhoto;
use app\models\Category;
use yii\web\Controller;
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
            // Search items according to received GET parameters
            $data = $model->search(Yii::$app->request->get());
        } else {
            // Get items with specified order
            $data = UsedItems::find()->orderBy(HelperMarketPlace::getSortParamForItemsList())->all();
        }
        return $this->render('index', ['data' => $data, 'model' => $model]);
    }

    public function actionCreate()
    {
        $model      = new UsedItems();
        $modelPhoto = new UsedItemPhoto();
        $model->setScenario('create');

//        HelperBase::dump($_POST);

        HelperBase::dump(UploadedFile::getInstances($modelPhoto, 'file'));
//        $files = UploadedFile::getInstances($modelPhoto, 'file');
//        var_dump($files);

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {

//            $model->file = UploadedFile::getInstance($model, 'file');
//            HelperBase::dump(UploadedFile::getInstances($modelPhoto, 'file'));

//            UsedItemPhoto::validateMultipleFiles($modelPhoto);


            if ($model->validate() && $model->save(false)) {
                Yii::$app->session->setFlash('item_create_success', 'A new item has been added.');
                $this->redirect('/');
            }
        }
        $categories = (new Category())->prepareDropDown();
        return $this->render('create', [
            'model'         => $model,
            'modelPhoto'    => $modelPhoto,
            'categories'    => $categories
        ]);
    }
}
