<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers;
use app\models\UsedItems;
use app\models\Category;
use yii\web\UploadedFile;
use yii\imagine\Image;

use app\components\Utility;

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
            $data = $model->search(Yii::$app->request->get());
        } else {
            $data = UsedItems::find()->orderBy('id DESC')->all();
        }
        return $this->render('index', ['data' => $data, 'model' => $model]);
    }

    public function actionCreate()
    {
        $model = new UsedItems();
        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

//            Utility::dump($model->file);

            $model->file->saveAs(Yii::getAlias('@photo_original') . '/1'  . '.' . $model->file->extension);

            Image::thumbnail(Yii::getAlias('@photo_original') . '/1.jpg', 150, 100)
                ->save(Yii::getAlias('@photo_thumb') . '/1.jpg', ['quality' => 50]);

            /*if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if ($model->save(false)) {

                    Yii::$app->session->setFlash('item_create_success', 'A new item has been added.');
                    $this->redirect('/');
                }
            }*/
        }
        $categories = (new Category())->prepareDropDown();
        return $this->render('create', ['model' => $model, 'categories' => $categories]);
    }
}
