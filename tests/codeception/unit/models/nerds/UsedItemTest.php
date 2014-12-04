<?php

namespace tests\codeception\unit\models\nerds;

use app\models\UsedItem;
use yii\codeception\DbTestCase;
use Codeception\Specify;
use Yii;

class UsedItemTest extends DbTestCase
{
    use Specify;

    public function testGetCategory()
    {
        $this->specify('test specific item belongs to category', function () {
            expect('item category is not empty', UsedItem::findOne(1)->category)->notEmpty();
        });
    }

    public function testGetPhotos()
    {
        $this->specify('test specific item has attached photos', function () {
            expect('item photos list is not empty', UsedItem::findOne(1)->photos)->notEmpty();
        });

        $this->specify('test specific item does not have photos', function () {
            expect('item photos list is empty', UsedItem::findOne(2)->photos)->isEmpty();
        });
    }

    public function testGetUser()
    {
        $this->specify('test specific item belongs to a user', function () {
            expect('item belongs to a user', UsedItem::findOne(1)->user)->notNull();
        });
    }

    public function testItemPreview()
    {
        $this->specify('item has a preview', function () {
            expect('item preview', UsedItem::findOne(1)->preview)->equals('http://placehold.it/250x200');
        });
    }

    public function testSearch()
    {
        $this->specify('search items according to filter parameters', function () {
            $model = new UsedItem;
            $model->setScenario('search');

            $_GET['UsedItem']['search_text'] = 'bla bla bla oops';
            $_GET['UsedItem']['price_min'] = '';
            $_GET['UsedItem']['price_max'] = '';
            expect('empty search result', $model->search(Yii::$app->request->get()))->isEmpty();

            $_GET['UsedItem']['search_text'] = '';
            $_GET['UsedItem']['price_min'] = 1;
            $_GET['UsedItem']['price_max'] = 10000;
            expect('empty search result', $model->search(Yii::$app->request->get()))->notEmpty();
        });
    }
}
