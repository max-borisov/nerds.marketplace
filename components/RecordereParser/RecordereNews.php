<?php
namespace app\components\recordere;

use app\components\recordere\RecordereBase;
use app\models\ExternalSite;
use app\models\News;
use Yii;
use app\components\HelperBase;
use yii\base\Exception;

require_once __DIR__ . '/RecordereBase.php';

class RecordereNews extends RecordereBase
{
    private $_baseUrl = 'http://www.recordere.dk/indhold/templates/design.aspx?articleid=';
    private $_catalogUrl = 'http://www.recordere.dk/nyheder/';
    private $_prevCatalogUrl = 'http://www.recordere.dk/nyheder/nyhedsliste.aspx';

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
//        $data['title'] = $this->iconv($this->_getTitle($root));

        // Date
        $dateAndUser = $this->_getDateAndUser($root);
        $data['user'] = $this->iconv(trim($dateAndUser['user']));
        $data['date'] = trim($dateAndUser['date']);

        // Post text
//        $data['post'] = $this->iconv($this->_getPostText($root));
        $data['post'] = $this->_getPostText($root);

        return $data;
    }

    public function getExistingRecords($siteId)
    {
        $data = (new \yii\db\Query())
            ->select('news_id')
            ->from('_news')
            ->where('site_id = :sid', ['sid' => $siteId])
            ->all();

        if ($data) {
            $tmp = [];
            foreach ($data as $item) {
                $tmp[] = $item['news_id'];
            }
            $data = $tmp;
        }
        return $data;
    }

    public function saveItem($data)
    {
        $item = new News();
        $item->site_id      = ExternalSite::RECORDERE;
        $item->news_id      = $data['id'];
        $item->title        = $data['title'];
        $item->af           = '';
        $item->notice       = '';
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
     * @return mixed
     * @throws \yii\base\Exception
     */
    public function getCatalogLinks()
    {
        $html = $this->tidy($this->_catalogUrl);
        $pattern = '|/?a=(\d+)|is';
        preg_match_all($pattern, $html, $matches);
        if (isset($matches[1])) {
            return array_unique($matches[1]);
        } else {
            throw new Exception('Could not retrieve news ids from main catalog page.');
        }
    }

    public function getPrevCatalogLinks()
    {
        $html = $this->tidy($this->_prevCatalogUrl);
        $pattern = '|/?a=(\d+)|is';
        preg_match_all($pattern, $html, $matches);
        if (isset($matches[1])) {
            return array_unique($matches[1]);
        } else {
            throw new Exception('Could not retrieve news ids from previous catalog page.');
        }
    }

    public function run()
    {
        set_time_limit(0);

        $catalogLinks = $this->getCatalogLinks();
//        $prevCatalogLinks = $this->getPrevCatalogLinks();
//        $allLinks = array_merge($catalogLinks, $prevCatalogLinks);
        $allLinks = $catalogLinks;

        $counter = 0;
        foreach ($allLinks as $newsId) {
//            if (in_array($newsId, $existingRecords)) continue;
            $data = $this->parsePage($newsId);
//            HelperBase::dump($data, true);
//            echo $data['post'];
//            echo '<hr>';

//            if ($counter++ > 50) break;

//            HelperBase::dump($data);
            $this->saveItem($data);
            break;
            usleep(1000);
        }
        echo "DONE!\r\n";
    }

    private function _getRootBlock($html)
    {
        $pattern = '|<div\s+id="content">(.*)</div>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return $matches[1];
        } else {
            throw new Exception('Could not get root block. News id ' . $this->_newsId);
        }
    }

    private function _getTitle($html)
    {
        $pattern = '|<span\s+class="frontheadline">\s*<big>([^>]+)</big>\s*</span>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim($matches[1]);
        } else {
            throw new Exception('Could not get title attribute. News id ' . $this->_newsId);
        }
    }

    private function _getDateAndUser($html)
    {
        $pattern = '|<font\s+color="#555555">([^<]+)</font>|is';
        preg_match_all($pattern, $html, $matches);
        if (isset($matches[1], $matches[1][1])) {
            $str = $matches[1][1];
            $data = [];
            list($data['date'], $data['user']) = explode('-', $str);
            return $data;
        } else {
            throw new Exception('Could not get date and user attributes. News id ' . $this->_newsId);
        }
    }

    private function _getPostText($html)
    {
        $pattern = '|<td>\s+<div\s+id="bodytext">(.*?)</div>\s+</td>|is';
        preg_match_all($pattern, $html, $matches);
        if (isset($matches[1], $matches[1][0])) {
//            return trim(strip_tags($matches[1][0], '<p>, <a>, <ul>, <li>, <strong>, <span>, <em>, <img>, <b>, <br>'));
//            return trim($matches[1][0], '<p>, <a>, <ul>, <li>, <strong>, <span>, <em>, <img>, <b>, <br>');
            return trim($matches[1][0]);
        } else {
            throw new Exception('Could not get post text. News id ' . $this->_newsId);
        }
    }
}