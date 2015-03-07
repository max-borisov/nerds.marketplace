<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "top_category".
 *
 * @property integer $id
 * @property string $title
 * @property integer $created_at
 * @property integer $updated_at
 */
class TopCategory extends \app\components\ActiveRecord
{
    const MOVIE                                 = 1; // Film
    const MUSIC_CD_LP_TAPE                      = 2; // Musik cd, lp og bånd
    const HIFI_ACCESSORIES                      = 3; // Hi-fi og tilbehør
    const TV_ACCESSORIES                        = 4; // Tv og tilbehør
    const PHOTO_EQUIPMENT                       = 5; // Fotoudstyr
    const DVD_VCR_PROJECTOR_ACCESSORIES         = 6; // Dvd-afspillere, videomaskiner, projektorer og tilbehør
    const VIDEO_CAM_FILM_EQUIPMENT_BINOCULARS   = 7; // Videokameraer, smalfilmsudstyr og kikkerter
    const DIGITAL_CAMERAS                       = 8; // Digitale kameraer
    const HIFI_SURROUNDS_ACCESSORIES            = 9; // Hi-fi surround og tilbehør
    const SATELLITE_DISHES_ANTENNAS_ACCESSORIES = 10; // Paraboler, antenner og tilbehør
    const ANALOG_CAMERAS                        = 11; // Analoge kameraer

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'top_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
