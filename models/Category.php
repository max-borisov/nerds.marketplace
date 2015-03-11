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
//    const AMPLIFIERS    = 3;
    const HIFI4ALL      = 5;

    /*
     * Film / Movies
     */
    const DVD_BLU_RAY_MOVIE = 16; // DVD-film og Blu-ray
    const VIDEO_FILM        = 17; // Videofilm

    /*
     * Musik cd, lp og bånd / Music CD, LP and tape
     */
    const LP        = 18; // Lp
    const MUSIC_CD  = 19; // Musik cd

    /*
     * Hi-fi og tilbehør / Hi-fi and accessories
     */
    const SPEAKERS_HIFI     = 6; // Højttalere, hi-fi
    const STEREO            = 7; // Stereoanlæg
    const HEADPHONES        = 8; // Hovedtelefoner
    const RADIO             = 9; // Radioer
    const AMPLIFIERS_HIFI   = 3; // Forstærkere, hi-fi
    const TURNTABLE         = 10; // Pladespillere
    const CD_PLAYER         = 11; // Cd-afspillere
    const MP3_MP4_PLAYERS   = 12; // Mp3/Mp4-afspillere
    const RECORDERS         = 13; // Båndoptagere
    const MP3_ACCESSORIES   = 14; // Tilbehør til MP3-afspilllere
    const MINI_DISC_PLAYER  = 15; // Minidisc-afspillere

    /*
     * TV and accessories / Tv og tilbehør
     */
    const TV_ACCESSSORIES   = 20; // Tilbehør til tv
    const TV_22_28          = 21; // Tv - 22" - 28"
    const TV_29_41          = 22; // Tv - 29" - 41"
    const TV_OVER_41        = 23; // Tv over 41"
    const TV_15_21          = 24; // Tv - 15" - 21"
    const TV_OTHER          = 25; // Andre tv
    const TV_UNDER_15       = 26; // Tv under 15"

    /*
     * Photo equipment / Fotoudstyr
     */
    const EQUIPMENT_ACCESSORIES = 27; // Andet fotoudstyr og tilbehør
    const LENSES                = 28; // Objektiver/Linser
    const BLITZ                 = 29; // Blitz
    const MEMORY_CARDS          = 30; // Hukommelseskort
    const DARKROOM_EQUIPMENT    = 31; // Mørkekammerudstyr

    /*
     * DVD players, VCRs, projectors and accessories / Dvd-afspillere, videomaskiner, projektorer og tilbehør
     */
    const DVD_PLAYERS               = 32; // Dvd-afspillere m.m.
    const PROJECTOR_ACCESSORIES     = 33; // Projektorer og tilbehør
    const DVD_HARD_DISK_RECORDERS   = 34; // DVD- og harddiskoptagere
    const VIDEO_MACHINES            = 35; // Videomaskiner

    /*
     * Video cameras, film equipment and binoculars / Videokameraer, smalfilmsudstyr og kikkerter
     */
    const CAM_RECORDERS_EQUIPMENT   = 36; // Videokameraer og -udstyr
    const BINOCULARS                = 37; // Kikkerter m.v.
    const CINE_EQUIPMENT            = 38; // Smalfilmsudstyr

    /*
     * Digital cameras / Digitale kameraer
     */
    const CANON_DIGITAL         = 39; // Canon
    const OTHER_DIGITAL_CAMERAS = 40; // Andre digitale kameraer
    const SONY_DIGITAL          = 41; // Sony
    const NIKON_DIGITAL         = 42; // Nikon
    const OLYMPUS_DIGITAL       = 43; // Olympus
    const HP_DIGITAL            = 44; // HP
    const MINOLTA_DIGITAL       = 45; // Minolta

    /*
     * Hi-fi surround and accessories / Hi-fi surround og tilbehør
     */
    const SURROUND_SPEAKERS_SUBWOOFERS  = 46; // Surroundhøjttalere og -subwoofere
    const SURROUND_SYSTEMS              = 47; // Surroundsystemer
    const SURROUND_AMPLIFIERS           = 48; // Surroundforstærkere

    /*
     * Satellite dishes, antennas and accessories / Paraboler, antenner og tilbehør
     */
    const DIGITAL_RECEIVERS         = 49; // Digitale receivere
    const OTHER_EQUIPMENT           = 50; // Andet udstyr
    const SATELLITE_MONITORS_BOWLS  = 51; // Parabolskærme og -skåle
    const ANALOG_RECEIVERS          = 52; // Analoge receivere

    /*
     * Analog cameras / Analoge kameraer
     */
    const OTHER_ANALOG_CAMERAS  = 53; // Andre analoge kameraer
    const CANON_ANALOG          = 54; // Canon
    const NIKON_ANALOG          = 55; // Nikon
    const MINOLTA_ANALOG        = 56; // Minolta
    const OLYMPUS_ANALOG        = 57; // Olympus
    const PENTAX_ANALOG         = 58; // Pentax

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
     * Get amount of related items
     * @return integer
     */
    public function getAttachedItemsCount()
    {
        return $this->hasMany(Item::className(), ['category_id' => 'id'])->count();
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
