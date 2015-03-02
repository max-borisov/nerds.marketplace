<?php

namespace app\controllers;

use app\components\HelperBase;
use Yii;
use yii\data\Pagination;
use yii\db\Exception;
use yii\helpers;
use yii\filters\AccessControl;
use app\components\HelperMarketPlace;
use app\components\HelperUser;
use app\models\Item;
use app\models\AdType;
use app\models\ItemPhoto;
use app\models\Category;
use app\models\User;
use app\controllers\AppController;
use app\models\ExternalSite;

class ItemsController extends AppController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create', 'items', 'delete', 'edit', 'upload', 'deletepreview'],
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

    // Front page with catalog and search form
    public function actionIndex()
    {
        $model = new Item();
        // Search request
        if (Yii::$app->request->get('Item')) {
            $model->setScenario('search');
            // Search items according to received GET parameters
            $query = $model->search(Yii::$app->request->get());
        } else {
            $query = Item::find()
                ->where('category_id > 0')
                ->orderBy(HelperMarketPlace::getSortParamForItemsList());
        }
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $data = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'data'  => $data,
            'pages' => $pages,
            'allItemsCount' => $pages->totalCount,
            'model' => $model
        ]);
    }

    // Create item page
    public function actionCreate()
    {
        $model      = new Item();
        $modelPhoto = new ItemPhoto();
        $model->setScenario('create');
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            $modelPhoto->validateUploadedFiles();
            if ($modelPhoto->hasErrors('file')) {
                $model->addError('file', $modelPhoto->getErrors('file')[0]);
            }
            $model->user_id = HelperUser::uid();
            $model->site_id = ExternalSite::NERDS;
            $model->s_item_id = mt_rand(100, 10000);
            if ($model->validate(null, false) && $model->save(false)) {
                if ($modelPhoto->hasUploadedFiles()) {
                    $modelPhoto->item_id = $model->id;
                    $modelPhoto->saveUploadedFiles();
                }
                Yii::$app->session->setFlash('item_create_success', 'A new item has been added.');
                $this->redirect('/');
            }
        }

        return $this->render('create', [
            'model'         => $model,
            'modelPhoto'    => $modelPhoto,
            'categories'    => (new Category())->prepareDropDown(),
            'adData'        => (new AdType())->prepareList()
        ]);
    }

    // View item page
    public function actionView($id)
    {
        $item = Item::find()->where('id = :id', [':id' => $id])->one();
        if (!$item) {
            $this->redirect('/');
        }
        return $this->render('view', ['data' => $item]);
    }

    // View items added by a current user
    public function actionItems()
    {
        // Only users who posted any items should have access
        if (!(new User())->hasItems(HelperUser::uid())) {
            $this->redirect('/');
        }
        $items = User::findUser(HelperUser::uid())->items;
        return $this->render('items', ['data' => $items]);
    }

    // Delete an item
    public function actionDelete($id)
    {
        $item = Item::findOne($id);
        // Item must be in database
        // User can only delete items which have been added by himself
        if (empty($item) || $item->user_id != HelperUser::uid()) {
            $this->redirect('/');
            return false;
        }

        $transaction = Yii::$app->db->beginTransaction();
        try {
            if ($item->delete()) {
                Yii::$app->session->setFlash('item_delete_success', 'Item has been deleted.');
            } else {
                Yii::$app->session->setFlash('item_delete_error', 'Item could not be deleted.');
            }
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
        $this->redirect('/items');
    }

    // Edit item
    public function actionEdit($id)
    {
        $model = Item::findOne($id);
        $model->setScenario('edit');

        // Add validation error to main model
        if (Yii::$app->session->hasFlash('edit_item_upload_photo_validation_error')) {
            $model->addError('file', Yii::$app->session->getFlash('edit_item_upload_photo_validation_error'));
        }

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->save(false)) {
                Yii::$app->session->setFlash('item_edit_success', 'Item data has been updated.');
                $this->redirect('/items');
            }
        }
        return $this->render('edit', [
            'model'         => $model,
            'modelPhoto'    => new ItemPhoto(),
            'categories'    => (new Category())->prepareDropDown(),
            'adData'        => (new AdType())->prepareList()
        ]);
    }

    // Upload images for items (edit item page)
    public function actionUpload()
    {
        if (Yii::$app->request->isPost) {
            $modelPhoto = new ItemPhoto();
            // Get item id from hidden form input
            $modelPhoto->item_id = Yii::$app->request->post('ItemPhoto')['item_id'];
            $modelPhoto->validateUploadedFiles();
            if ($modelPhoto->hasErrors('file')) {
                Yii::$app->session->setFlash('edit_item_upload_photo_validation_error', $modelPhoto->getErrors('file')[0]);
            } else {
                if ($modelPhoto->saveUploadedFiles()) {
                    Yii::$app->session->setFlash('edit_item_upload_photo_success', 'New images have been added');
                } else {
                    Yii::$app->session->setFlash('edit_item_upload_photo_error', 'New images could not be uploaded');
                }
            }
            $this->redirect('/item/edit/' . $modelPhoto->item_id);
        } else {
            // @todo log action
            $this->redirect('/');
        }
    }

    public function actionDeletepreview($id)
    {
        if (!$preview = ItemPhoto::findOne($id)) {
            throw new Exception('Invalid preview id ' . $id);
        }
        $item = $preview->item;
        // Only user who posted image can delete it
        if ($item->user->id != HelperUser::uid()) {
            throw new Exception('Trying to get access to forbidden records. Preview id ' . $id);
        }
        if ($preview->delete()) {
            Yii::$app->session->setFlash('item_preview_delete_success', 'Preview has been delete');
        } else {
            Yii::$app->session->setFlash('item_preview_delete_error', 'Preview could not be delete');
        }
        $this->redirect('/item/edit/' . $item->id);
    }
}