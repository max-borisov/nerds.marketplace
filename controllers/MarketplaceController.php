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
                        'actions' => ['create', 'items', 'delete', 'edit'],
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

    // Front page with catalog and search form
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

    // Create item page
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
        return $this->render('create', [
            'model'         => $model,
            'modelPhoto'    => $modelPhoto,
            'categories'    => (new Category())->prepareDropDown(),
            'typeData'      => (new UsedItemType())->prepareList()
        ]);
    }

    // View item page
    public function actionView($id)
    {
        $item = UsedItem::find()->where('id = :id', [':id' => $id])->one();
        if (!$item) {
            $this->redirect('/');
        }
        return $this->render('view', ['data' => $item]);
    }

    // View items added by a current user
    public function actionItems()
    {
        // Only users who posted any items should have access
        if (!(new PhpbbUser)->hasItems(HelperUser::uid())) {
            $this->redirect('/');
        }
        $items = PhpbbUser::findUser(HelperUser::uid())->items;
        return $this->render('items', ['data' => $items]);
    }

    // Delete an item
    public function actionDelete($id)
    {
        $item = UsedItem::findOne($id);
        // Item must be in database
        // User can only delete items which have been added by himself
        if (empty($item) || $item->user_id != HelperUser::uid()) {
            $this->redirect('/');
            return false;
        }
        if ($item->delete()) {
            Yii::$app->session->setFlash('item_delete_success', 'Item has been deleted.');
        } else {
            Yii::$app->session->setFlash('item_delete_error', 'Item could not be deleted.');
        }
        $this->redirect('/items');
    }

    // Edit item
    public function actionEdit($id)
    {
        $model = UsedItem::findOne($id);
        $model->setScenario('edit');
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->save(false)) {
                Yii::$app->session->setFlash('item_edit_success', 'Item data has been updated.');
                $this->redirect('/items');
            }
        }
        return $this->render('edit', [
            'model'         => $model,
            'categories'    => (new Category())->prepareDropDown(),
            'typeData'      => (new UsedItemType())->prepareList()
        ]);
    }
}