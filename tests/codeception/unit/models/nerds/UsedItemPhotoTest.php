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
        $this->specify('image title is empty', function () {
            $photoModel = new UsedItemPhoto();
            $photoModel->save(false);
        }, ['throws' => 'yii\base\Exception']);

        $this->specify('item id for image is empty', function () {
            $photoModel = new UsedItemPhoto();
            $photoModel->name = 'test';
            $photoModel->save(false);
        }, ['throws' => 'yii\base\Exception']);

        $this->specify('set title and item id for image', function () {
            $photoModel = new UsedItemPhoto();
            $photoModel->name = 'test';
            $photoModel->item_id = $this->item('has_photos')->id;
            expect('save success', $photoModel->save(false))->true();
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
