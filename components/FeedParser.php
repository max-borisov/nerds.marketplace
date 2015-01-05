<?php
namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\Exception;

class FeedParser extends Component
{
    private $_feed = '';

    public function addFeed($feed)
    {
        $this->_feed = $feed;
        return $this;
    }

    public function parse()
    {
        if (empty($this->_feed)) {
            throw new Exception('Feed url must be set.');
        }
        $rss = simplexml_load_file($this->_feed);
        $data = [];
        foreach ($rss->channel->item as $item) {
            $data[] = [
                'title'         => (string)$item->title,
                'date'          => (string)$item->pubDate,
                'description'   => (string)$item->description,
                'link'          => (string)$item->link,
                'author'        => (string)$item->author,
            ];
        }
        return $data;
    }
}