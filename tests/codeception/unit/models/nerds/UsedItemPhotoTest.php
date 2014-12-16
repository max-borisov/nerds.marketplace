<?php

namespace tests\codeception\unit\models\nerds;

use Yii;
use app\models\UsedItemPhoto;
use yii\codeception\DbTestCase;
use Codeception\Specify;
use app\tests\codeception\unit\fixtures\UsedItemFixture;
use app\tests\codeception\unit\fixtures\UsedItemPhotoFixture;

class UsedItemPhotoTest extends DbTestCase
{
    use Specify;

    public function fixtures()
    {
        return [
            'item'  => UsedItemFixture::className(),
            'photo' => UsedItemPhotoFixture::className(),
        ];
    }

    public function testSave()
    {
        $photoModel = new UsedItemPhoto();

        $this->specify('exception thrown if image name is empty', function () use ($photoModel) {
            $photoModel->save(false);
        }, ['throws' => 'yii\base\Exception']);

        $photoModel->name = 'test';
        $this->specify('exception thrown if item id is empty', function () use ($photoModel) {
            $photoModel->save(false);
        }, ['throws' => 'yii\base\Exception']);

        $photoModel->item_id = $this->item('item_1')->id;
        $this->specify('photo model has been saved successfully', function () use ($photoModel) {
            expect('save is ok', $photoModel->save(false))->true();
        });
    }

    public function testAfterFind()
    {
        $photoModel = UsedItemPhoto::findOne($this->photo('photo_1')->id);

        $this->specify('photo model has `thumb` filed', function () use ($photoModel) {
            expect('`thumb` field contains image name', $photoModel->thumb)->contains($photoModel->name);
        });

        $this->specify('photo model has `original` field', function () use ($photoModel) {
            expect('`original` param contains image name', $photoModel->original)->contains($photoModel->name);
        });
    }

    public function testDelete()
    {
        $photoModel = new UsedItemPhoto();
        $photoModel->name = 'test';
        $photoModel->item_id = 123;
        $this->assertTrue($photoModel->save(false));

        $this->specify('delete photo model', function () use ($photoModel) {
            expect('return true', (bool)$photoModel->delete())->true();
        });
    }
}
