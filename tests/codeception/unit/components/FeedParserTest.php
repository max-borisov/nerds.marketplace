<?php

use app\components\FeedParser;
use yii\codeception\TestCase;
use Codeception\Specify;

class FeedParserTest extends TestCase
{
    use Specify;

    public function testException()
    {
        $this->specify('Call parser with empty url', function () {
            (new FeedParser())->parse();
        }, ['throws' => 'yii\base\Exception']);

    }

    public function testParser()
    {
        $data = (new FeedParser())->addFeed(Yii::getAlias('@tests') . '/codeception/_data/feed.xml')->parse();
        verify('Data is not empty', $data)->notEmpty();
        verify('Item has title', array_key_exists('title', $data[0]))->true();
        verify('Item has date', array_key_exists('date', $data[0]))->true();
        verify('Item has description', array_key_exists('description', $data[0]))->true();
        verify('Item has link', array_key_exists('link', $data[0]))->true();
        verify('Item has author', array_key_exists('author', $data[0]))->true();
    }
}
