<?php

namespace tests\codeception\unit\models\nerds;

use Yii;
use app\models\UsedItemPhoto;
use yii\codeception\DbTestCase;
use Codeception\Specify;
use app\tests\codeception\unit\fixtures\UsedItemPhotoFixture;

class UsedItemPhotoTest extends DbTestCase
{
    use Specify;

    public function fixtures()
    {
        return [
            'photo' => UsedItemPhotoFixture::className(),
        ];
    }

    public function testOk()
    {
        $this->assertTrue(true);
    }
}
