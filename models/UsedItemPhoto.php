<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\web\UploadedFile;
use app\components\HelperBase;
use app\components\HelperMarketPlace;

/**
 * This is the model class for table "used_item_photo".
 *
 * @property integer $id
 * @property integer $item_id
 * @property string  $name
 * @property integer $created_at
 * @property integer $updated_at
 */
class UsedItemPhoto extends \app\components\ActiveRecord
{
    /**
     * @var UploadedFile|Null file attribute
     */
    public $file;

    private $_fileInstances = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '_used_item_photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file'], 'file', 'extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png',],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_id' => 'Item ID',
            'name' => 'Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'file' => 'File:',
        ];
    }

    public function beforeSave($insert)
    {
        if (empty($this->item_id)) {
            throw new Exception('Item id must be specified.');
        }
        $this->name = uniqid($this->item_id);
        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if (!empty($this->file) && $this->file instanceof yii\web\UploadedFile) {
            HelperMarketPlace::saveItemPhoto($this);
        }
    }

    /**
     * Validate uploaded files and set errors to form model
     * @param $modelPhoto UsedItemPhoto model
     * @param $modelForm UsedItem model
     * @return bool
     */
    public function validateUploadedFilesAndPassErrorsToFromModel($modelPhoto, $modelForm)
    {
        $this->_fileInstances = UploadedFile::getInstances($modelPhoto, 'file');

        // Limit for uploaded files amount
        if (count($this->_fileInstances) > HelperBase::getParam('maxUploadImages')) {
            $modelForm->addError('file', 'Max. ' . HelperBase::getParam('maxUploadImages') . ' images can be uploaded for one item.');
            return false;
        }

        // Validate each uploaded image
        foreach ($this->_fileInstances as $file) {
            $_model = new self;
            $_model->file = $file;
            if (!$_model->validate() && $_model->hasErrors()) {
                foreach ($_model->getErrors() as $error) {
                    $modelForm->addError('file', $error[0]);
                }
                break;
            }
        }
        return true;
    }

    public function hasUploadedFiles()
    {
        return !empty($this->_fileInstances);
    }

    /**
     * Add a new table row for each new image
     * @param $itemId Item id images attached to
     * @throws \yii\db\Exception
     */
    public function saveUploadedFileNames($itemId)
    {
        foreach ($this->_fileInstances as $file) {
            $_model = new self;
            $_model->item_id    = $itemId;
            $_model->file       = $file;
            if (!$_model->save(false)) {
                throw new \yii\db\Exception('Item photo could not be saved.');
            }
        }
    }
}