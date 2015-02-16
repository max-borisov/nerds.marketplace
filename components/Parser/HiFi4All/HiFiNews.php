<?php
namespace app\components\parser\hifi;

use Yii;
use yii\base\Exception;
use app\components\parser\Base;
use app\models\ExternalSite;
use app\models\News;
use app\components\HelperBase;

require_once __DIR__ . '/../Base.php';

class HiFiNews extends Base
{
    private $_baseUrl = 'http://hifi4all.dk/content/templates/nyheder.asp?articleid=';
    private $_baseCatalogUrl = 'http://hifi4all.dk/content/nyheder_new.asp?side=';

    private $_newsId = 0;

    public function parsePage($id)
    {
        $this->_newsId = $id;
        $html = $this->tidy($this->_baseUrl . $id);
        $data = [];
        $data['id'] = $id;

        // Root block
        $root = $this->_getRootBlock($html);

        // Title
        $data['title'] = $this->_getTitle($root);

        // Af
        $data['af'] = $this->_getAf($root);

        // Date
        $data['date'] = $this->_getDate($root);

        // Notification
        $data['notice'] = $this->_getNotification($root);

        // Notification
        $data['img'] = $this->_getImages($root);

        // Post text
        $data['post'] = $this->_getPostText($root);

        return $data;
    }

    public function saveItem($data)
    {
        $item = new News();
        $item->site_id      = ExternalSite::HIFI4ALL;
        $item->news_id      = $data['id'];
        $item->title        = $data['title'];
        $item->af           = $data['af'];
        $item->notice       = $data['notice'];
        $item->post         = $data['post'];
        $item->post_date    = $data['date'];

        if ($item->save(false)) {
            return $item->id;
        } else {
            throw new Exception('News data could not be saved. News id ' . $data['id']);
        }
    }

    /**
     * Parse catalog to get links to news pages
     * @param integer $side Catalog page number
     * @return mixed
     * @throws \yii\base\Exception
     */
    public function getCatalogLinks($side)
    {
        $html = $this->tidy($this->_baseCatalogUrl . $side);
        $pattern = '|<td\s+width="336">(?:.*?)(\d{4})(?:.*?)</td>|is';
        preg_match_all($pattern, $html, $matches);
        if (isset($matches[1], $matches[1][0])) {
            return array_unique($matches[1]);
        } else {
            throw new Exception('Could not retrieve news ids from catalog page. Page id ' . $side);
        }
    }

    public function run()
    {
        set_time_limit(0);

        $before = $this->getExistingRowsCount('news', ExternalSite::HIFI4ALL);
        for ($side = 1; $side <= 8; $side++) {
            $existingNews = $this->getExistingNews(ExternalSite::HIFI4ALL);
            $ids = $this->getCatalogLinks($side);
            foreach ($ids as $newsId) {
                if (in_array($newsId, $existingNews)) continue;
                $data = $this->parsePage($newsId);
                $this->saveItem($data);
//                break;
                usleep(1000);
            }
        }
        $after = $this->getExistingRowsCount('news', ExternalSite::HIFI4ALL);
        $this->done('HiFiNews', $before, $after);
    }

    private function _getRootBlock($html)
    {
        $pattern = '|<td\s+width="604"\s+valign="top">(.*)</td>|is';
        preg_match_all($pattern, $html, $matches);
        if (isset($matches[0], $matches[0][0])) {
            return $matches[0][0];
        } else {
            throw new Exception('Could not get root block. News id ' . $this->_newsId);
        }
    }

    private function _getTitle($html)
    {
        $pattern = '|<span\s+class="bigfontNews">([^>]+)</span>|is';
        preg_match_all($pattern, $html, $matches);
        if (isset($matches[1], $matches[1][0])) {
            return trim($matches[1][0]);
        } else {
            throw new Exception('Could not get title attribute. News id ' . $this->_newsId);
        }
    }

    private function _getAf($html)
    {
        $pattern = '|Af:\s+([^<]+)|is';
        preg_match_all($pattern, $html, $matches);
        if (isset($matches[1], $matches[1][0])) {
            return trim(str_replace('&nbsp;', '', $matches[1][0]));
        } else {
            throw new Exception('Could not get Af attribute. News id ' . $this->_newsId);
        }
    }

    private function _getDate($html)
    {
        $pattern = '|<font\s+color="#999999">(.*?)</font>|is';
        preg_match_all($pattern, $html, $matches);
        if (isset($matches[1], $matches[1][0])) {
            $date = str_replace(['[', ']'], '', $matches[1][0]);
            return preg_replace('|(\d{2}).(\d{2}).(\d{4})|is', '$3-$2-$1', $date);
        } else {
            throw new Exception('Could not get date attribute. News id ' . $this->_newsId);
        }
    }

    private function _getNotification($html)
    {
        $pattern = '|<b>([^<]+)</b>|is';
        preg_match_all($pattern, $html, $matches);
        if (isset($matches[1], $matches[1][0])) {
            return trim($matches[1][0]);
        } else {
            throw new Exception('Could not get notification message. News id ' . $this->_newsId);
        }
    }

    private function _getImages($html)
    {
        $pattern = '|src="(http://www.hifi4all.dk[^"]+)"|is';
        preg_match_all($pattern, $html, $matches);
        if (isset($matches[1])) {
            return $matches[1];
        } else {
            throw new Exception('Could not get post images. News id ' . $this->_newsId);
        }
    }

    private function _getPostText($html)
    {
        $pattern = '|<td\s+width="100%"\s+valign="top">(.*?)</td>|is';
        preg_match_all($pattern, $html, $matches);
        if (isset($matches[1], $matches[1][0])) {
            $post = trim(strip_tags($matches[1][0], '<p>, <ul>, <li>, <a>, <b>, <u>, <img>, <br>, <strong>'));
            return preg_replace('|\s+|', ' ', $post);
        } else {
            throw new Exception('Could not get post text. News id ' . $this->_newsId);
        }
    }
}