<?php
namespace app\tests\codeception\unit\fixtures;

use Yii;
use yii\test\ActiveFixture;

class ItemPhotoFixture extends ActiveFixture
{
    public $modelClass = 'app\models\ItemPhoto';
    public $depends = ['app\tests\codeception\unit\fixtures\ItemFixture'];

    public function init()
    {
        $this->dataFile = Yii::getAlias('@fixtures') . '/data/models/item_photo.php';
        parent::init();
    }
}