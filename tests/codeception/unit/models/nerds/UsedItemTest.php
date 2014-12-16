<?php

namespace tests\codeception\unit\models\nerds;

use app\models\UsedItemPhoto;
use app\tests\codeception\unit\fixtures\UsedItemPhotoFixture;
use Yii;
use app\models\UsedItem;
use yii\codeception\DbTestCase;
use Codeception\Specify;
use app\tests\codeception\unit\fixtures\UsedItemFixture;

class UsedItemTest extends DbTestCase
{
    use Specify;

    public function fixtures()
    {
        return [
            'item' => UsedItemFixture::className(),
            'photo' => UsedItemPhotoFixture::className(),
        ];
    }

    public function testValidation()
    {
        $this->fail();
    }

    public function testGetCategory()
    {
        $this->specify('item belongs to category', function () {
            expect('item category is not empty', UsedItem::findOne($this->item('has_photos')->id)->category)->notEmpty();
        });
    }

    public function testGetPhotos()
    {
        $this->specify('item has attached photos', function () {
            expect('item photos list is not empty', UsedItem::findOne($this->item('has_photos')->id)->photos)->notEmpty();
        });

        $this->specify('item does not have photos', function () {
            expect('item photos list is empty', UsedItem::findOne($this->item('has_no_photos')->id)->photos)->isEmpty();
        });
    }

    public function testGetUser()
    {
        $this->specify('item belongs to a user', function () {
            expect('item owner(user) is not null', UsedItem::findOne($this->item('has_photos')->id)->user)->notNull();
        });
    }

    public function testGetType()
    {
        $this->specify('item has a particular type', function () {
            expect('item type is not null', UsedItem::findOne($this->item('has_photos')->id)->type)->notNull();
        });
    }

    public function testItemPreview()
    {
        $this->specify('item has a preview', function () {
            expect('item preview contains http protocol', UsedItem::findOne($this->item('has_photos')->id)->preview)->contains('http');
        });
    }

    public function testSearch()
    {
        $this->specify('search items with filter parameters', function () {
            $model = new UsedItem;
            $model->setScenario('search');

            $_GET['UsedItem']['search_text'] = 'bla bla bla oops';
            $_GET['UsedItem']['price_min'] = '';
            $_GET['UsedItem']['price_max'] = '';
            expect('search result is empty', $model->search(Yii::$app->request->get()))->isEmpty();

            $_GET['UsedItem']['search_text'] = '';
            $_GET['UsedItem']['price_min'] = 1;
            $_GET['UsedItem']['price_max'] = 10000;
            expect('search result is not empty', $model->search(Yii::$app->request->get()))->notEmpty();
        });
    }

    public function testDelete()
    {
        $itemId = $this->item('delete_item')->id;
        $item = UsedItem::findOne($itemId);

        $this->specify('item has photos', function () use ($item) {
            expect('photos list is not empty', $item->photos)->notEmpty();
        });

        $photoId = $item->photos[0]->id;

        $this->assertTrue((bool)$item->delete());
        $item = UsedItem::findOne($itemId);

        $this->specify('item is not exists', function () use ($itemId) {
            expect('item is null', UsedItem::findOne($itemId))->Null();
        });

        $this->specify('item does not have photos', function () use ($photoId) {
            expect('item is null', UsedItemPhoto::findOne($photoId))->Null();
        });
    }

}
