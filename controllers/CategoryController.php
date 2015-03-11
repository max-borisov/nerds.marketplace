<?php

namespace app\controllers;

use Yii;
use yii\helpers;
use app\models\Category;
use yii\filters\AccessControl;

class CategoryController extends \app\controllers\AppController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create', 'update', 'delete'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $data = Category::find()->orderBy('id ASC')->all();
        return $this->render('index', ['data' => $data]);
    }

    public function actionCreate()
    {
        $model = new Category();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->save(false)) {
                Yii::$app->session->setFlash('category_create_success', 'A new category has been created.');
                $this->redirect('/category');
            }
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = Category::find()->where('id = :id', [':id' => $id])->one();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->save(false)) {
                Yii::$app->session->setFlash('category_update_success', 'Category title has been updated.');
                $this->redirect('/category');
            }
        }
        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        // Category id should be valid
        if (!$category = Category::findOne($id)) {
            Yii::$app->session->setFlash('category_delete_error', 'Invalid category.');
            $this->redirect('/category');
        }

        $transaction = Yii::$app->db->beginTransaction();
        try {
            if ($category->delete()) {
                Yii::$app->session->setFlash('category_delete_success', 'Category has been deleted.');
            } else {
                Yii::$app->session->setFlash('category_delete_error', 'Category could not be deleted.');
            }
            $transaction->commit();
            $this->redirect('/category');
        } catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }
}
