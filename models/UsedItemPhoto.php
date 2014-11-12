<?php

namespace app\models;

use Yii;
//use app\models\Uplo;
use yii\web\UploadedFile;
use app\components\HelperBase;

/**
 * This is the model class for table "used_item_photo".
 *
 * @property integer $id
 * @property integer $item_id
 * @property string $name
 * @property integer $created_at
 * @property integer $updated_at
 */
class UsedItemPhoto extends \app\components\ActiveRecord
{
    /**
     * @var UploadedFile|Null file attribute
     */
    public $file;

//    private static $_validationError;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'used_item_photo';
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

    public static function validateMultipleFiles($model)
    {
//        $this->validateMultiple()

        $files = UploadedFile::getInstances($model, 'file');
//        HelperBase::dump($files);


        /*foreach ($files as $file) {
            $_model = new self;
            $_model->file = $file;
            if (!$_model->validate()) {
                $model->addError('file', $_model->getErrors('file'))
            }
        }*/

    }
}
