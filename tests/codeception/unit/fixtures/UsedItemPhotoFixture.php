<?php
namespace app\tests\codeception\unit\fixtures;

use Yii;
use yii\test\ActiveFixture;

class UsedItemPhotoFixture extends ActiveFixture
{
    public $modelClass = 'app\models\UsedItemPhoto';
    public $depends = ['app\tests\codeception\unit\fixtures\UsedItemFixture'];

    public function init()
    {
        $this->dataFile = Yii::getAlias('@fixtures') . '/data/models/used_item_photo.php';
        parent::init();
    }
}