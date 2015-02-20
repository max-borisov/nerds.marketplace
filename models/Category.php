<?php

namespace app\models;

use Yii;
use app\models\Item;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $title
 * @property integer $created_at
 * @property integer $updated_at
 */
class Category extends \app\components\ActiveRecord
{
    const AMPLIFIERS    = 3;
    const HIFI4ALL      = 5;

    const SPEAKERS_HIFI     = 6; // Højttalere, hi-fi
    const STEREO_SYSTEM     = 7; // Stereoanlæg
    const HEADPHONES        = 8; // Hovedtelefoner
    const RADIO             = 9; // Radioer
    const TURNTABLE         = 10; // Pladespillere
    const CD_PLAYER         = 11; // Cd-afspillere
    const MP3_MP4_PLAYERS   = 12; // Mp3/Mp4-afspillere
    const TAPE_RECORDER     = 13; // Båndoptagere
    const MP3_ACCESSORIES   = 14; // Tilbehør til MP3-afspilllere
    const MINI_DISC_PLAYER  = 15; // Minidisc-afspillere

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['title'], 'unique']
        ];
    }

    /**
     * Retrieve data for drop down list
     * @return array
     */
    public function prepareDropDown()
    {
        $data = (new \yii\db\Query())
            ->select('id, title')
            ->from($this->tableName())
            ->orderBy('id ASC')
            ->all();
        return ArrayHelper::map($data, 'id', 'title');
    }

    /**
     * Build relation with Item model
     * @return ActiveQuery
     */
    public function getAttachedItems()
    {
        return $this->hasMany(Item::className(), ['category_id' => 'id'])->orderBy('updated_at DESC');
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title:',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function afterDelete()
    {
        parent::afterDelete();

        // Set category as zero for all related items
        $sql = 'UPDATE item SET category_id = 0, updated_at = :time WHERE category_id = :category_id';
        $command = Yii::$app->db->createCommand($sql);
        $command->bindValue(':category_id', $this->id);
        $command->bindValue(':time', time());
        $command->execute();
    }
}
