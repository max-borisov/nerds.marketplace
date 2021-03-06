<?php

namespace tests\codeception\unit\models\nerds;

use app\models\ItemPhoto;
use app\tests\codeception\unit\fixtures\ItemPhotoFixture;
use Yii;
use app\models\Item;
use yii\codeception\DbTestCase;
use Codeception\Specify;
use app\tests\codeception\unit\fixtures\ItemFixture;

class ItemTest extends DbTestCase
{
    use Specify;

    public function fixtures()
    {
        return [
            'item' => ItemFixture::className(),
            'photo' => ItemPhotoFixture::className(),
        ];
    }

    public function testValidation()
    {
        $model = new Item();
        $model->scenario = 'create';
        $this->specify('validate model with empty attributes', function () use ($model) {
            expect('validation errors', $model->validate())->false();
        });

        $this->specify('set models attributes before validation', function () use ($model) {
            $model->warranty    = 1;
            $model->invoice     = 1;
            $model->packaging   = 1;
            $model->manual      = 1;
            $model->price       = 100;
            $model->category_id = 1;
            $model->title       = 'test';
            $model->ad_type_id  = 1;
            $model->description = 'text';
            expect('validation success', $model->validate())->true();
        });

        $this->specify('remove tags from item description', function () use ($model) {
            $model->warranty    = 1;
            $model->invoice     = 1;
            $model->packaging   = 1;
            $model->manual      = 1;
            $model->price       = 100;
            $model->category_id = 1;
            $model->title       = 'test';
            $model->ad_type_id  = 1;
            $model->description = 'text<p></p>';
            $model->validate();
            expect('no tags in description', $model->description)->notContains('<');
        });
    }

    public function testSave()
    {
        $this->specify('save item with all attributes', function () {
            $model = new Item();
            $model->scenario    = 'create';
            $model->user_id     = 1;
            $model->warranty    = 1;
            $model->invoice     = 1;
            $model->packaging   = 1;
            $model->manual      = 1;
            $model->price       = 100;
            $model->category_id = 1;
            $model->title       = 'auto created';
            $model->ad_type_id     = 1;
            $model->description = 'text<p></p>';
            expect('save successful', $model->save(true))->true();
        });
    }

    public function testEdit()
    {
        $this->specify('update item', function () {
            $item = Item::findOne($this->item('edit_item')->id);
            $item->scenario = 'edit';
            $item->warranty = 0;
            $item->price    = 670;
            $item->description = 'new updated text';
            expect('update successful', $item->save(true))->true();
        });
    }

    public function testGetCategory()
    {
        $this->specify('item belongs to category', function () {
            expect('item category is not empty', Item::findOne($this->item('has_photos')->id)->category)->notEmpty();
        });
    }

    public function testGetPhotos()
    {
        $this->specify('item has attached photos', function () {
            expect('item photos list is not empty', Item::findOne($this->item('has_photos')->id)->photos)->notEmpty();
        });

        $this->specify('item does not have photos', function () {
            expect('item photos list is empty', Item::findOne($this->item('has_no_photos')->id)->photos)->isEmpty();
        });
    }

    public function testGetUser()
    {
        $this->specify('item belongs to a user', function () {
            expect('item owner(user) is not null', Item::findOne($this->item('has_photos')->id)->user)->notNull();
        });
    }

    public function testGetType()
    {
        $this->specify('item has a particular type', function () {
            expect('item type is not null', Item::findOne($this->item('has_photos')->id)->type)->notNull();
        });
    }

    public function testItemPreview()
    {
        $this->specify('item has a preview', function () {
            expect('item preview contains http protocol', Item::findOne($this->item('has_photos')->id)->preview)->contains('http');
        });
    }

    public function testSearch()
    {
        $this->specify('search items with filter parameters', function () {
            $model = new Item;
            $model->setScenario('search');

            $_GET['Item']['search_text'] = 'bla bla bla oops';
            $_GET['Item']['price_min'] = '';
            $_GET['Item']['price_max'] = '';
            expect('search result is empty', $model->search(Yii::$app->request->get())->all())->isEmpty();

            $_GET['Item']['search_text'] = '';
            $_GET['Item']['price_min'] = 1;
            $_GET['Item']['price_max'] = 10000;
            expect('search result is not empty', $model->search(Yii::$app->request->get())->all())->notEmpty();
        });
    }

    public function testDelete()
    {
        $itemId = $this->item('delete_item')->id;
        $item = Item::findOne($itemId);

        $this->specify('item has photos', function () use ($item) {
            expect('photos list is not empty', $item->photos)->notEmpty();
        });

        $photoId = $item->photos[0]->id;

        $this->assertTrue((bool)$item->delete());
        $item = Item::findOne($itemId);

        $this->specify('item is not exists', function () use ($itemId) {
            expect('item is null', Item::findOne($itemId))->Null();
        });

        $this->specify('item does not have photos', function () use ($photoId) {
            expect('item is null', ItemPhoto::findOne($photoId))->Null();
        });
    }

}
