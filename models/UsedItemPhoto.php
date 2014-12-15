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
 * @property integer $thumb
 * @property integer $original
 */
class UsedItemPhoto extends \app\components\ActiveRecord
{
    /**
     * @var UploadedFile|Null file attribute
     */
    public $file;

    private $_fileInstances = [];

    // Thumb image url
    public $thumb       = '';

    // Original image  url
    public $original    = '';

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
        $this->name = uniqid($this->item_id) . HelperBase::getParam('thumb')['extension'];
        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if (!empty($this->file) && $this->file instanceof yii\web\UploadedFile) {
            HelperMarketPlace::saveItemPhoto($this);
        }
    }

    public function afterFind()
    {
        parent::afterFind();

        $this->thumb    = Yii::getAlias('@photo_thumb_url') . '/' . $this->name;
        $this->original = Yii::getAlias('@photo_original_url') . '/' . $this->name;
    }

    public function beforeDelete()
    {
        // Delete item photos from the system

        // Get path to the files
        $thumb      = Yii::getAlias('@photo_thumb_path') . '/' . $this->name;
        $original   = Yii::getAlias('@photo_original_path') . '/' . $this->name;

        // Try to delete thumb photo
        if (file_exists($thumb) && !unlink($thumb)) {
            HelperBase::logger(
                'Photo thumb could not be deleted',
                '',
                ['fileName' => $this->name, 'path' => $thumb]
            );
        }

        // Try to delete original photo
        if (file_exists($original) && !unlink($original)) {
            HelperBase::logger(
                'Photo original could not be deleted',
                '',
                ['fileName' => $this->name, 'path' => $original]
            );
        }

        return parent::beforeDelete();
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
        if (!empty($this->_fileInstances)) {
            // File name could not be empty (This error occur while functional testing)
            foreach ($this->_fileInstances as $file) {
                if (empty($file->name)) {
                    return false;
                }
            }
            return true;
        }
        return false;
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
