<?php

namespace app\controllers;

use Yii;
use yii\helpers;
use app\components\HelperMarketPlace;
use app\components\HelperUser;
use app\models\UsedItem;
use app\models\UsedItemType;
use app\models\UsedItemPhoto;
use app\models\Category;
use app\models\PhpbbUser;
use yii\web\Controller;
use yii\filters\AccessControl;

use app\components\HelperBase;

class MarketplaceController extends Controller
{
    public $layout = 'marketplace';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create', 'items', 'delete'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => ['?', '@'],
                    ],
                ],
            ],
        ];
    }

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
        $model = new UsedItem();
        // Search request
        if (Yii::$app->request->get('UsedItem')) {
            $model->setScenario('search');
            // Search items according to received GET parameters
            $data = $model->search(Yii::$app->request->get());
        } else {
            // Get items with specified order
            $data = UsedItem::find()->orderBy(HelperMarketPlace::getSortParamForItemsList())->all();
        }
        return $this->render('index', ['data' => $data, 'model' => $model]);
    }

    public function actionCreate()
    {
        $model      = new UsedItem();
        $modelPhoto = new UsedItemPhoto();
        $model->setScenario('create');
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            $modelPhoto->validateUploadedFilesAndPassErrorsToFromModel($modelPhoto, $model);
            if ($model->validate(null, false) && $model->save(false)) {
                if ($modelPhoto->hasUploadedFiles()) {
                    $modelPhoto->saveUploadedFileNames($model->id);
                }
                Yii::$app->session->setFlash('item_create_success', 'A new item has been added.');
                $this->redirect('/');
            }
        }
        $categories = (new Category())->prepareDropDown();
        return $this->render('create', [
            'model'         => $model,
            'modelPhoto'    => $modelPhoto,
            'categories'    => $categories,
            'typeData'      => (new UsedItemType())->prepareList()
        ]);
    }

    public function actionView($id)
    {
        $item = UsedItem::find()->where('id = :id', [':id' => $id])->one();
        if (!$item) {
            $this->redirect('/');
        }
        return $this->render('view', ['data' => $item]);
    }

    public function actionItems()
    {
        // Only users who posted any items should have access
        if (!(new PhpbbUser)->hasItems(HelperUser::uid())) {
            $this->redirect('/');
        }
        $items = PhpbbUser::findUser(HelperUser::uid())->items;
        return $this->render('userItems', ['data' => $items]);
    }

    public function actionDelete($id)
    {
        // Item must be in database
        if (!$item = UsedItem::findOne($id)) {
            $this->redirect('/');
        }

        // User can only delete items which have been added by himself
        if ($item->user_id != HelperUser::uid()) {
            $this->redirect('/');
        }

        if ($item->delete()) {
            Yii::$app->session->setFlash('item_delete_success', 'Item has been deleted.');
            $this->refresh();
        }

        HelperBase::dump($item);
    }
}
