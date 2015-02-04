<?php
namespace app\components\parser\recordere;

use Yii;
use app\components\parser\Base;
use app\models\ExternalSite;
use app\models\News;
use app\components\HelperBase;
use yii\base\Exception;

require_once __DIR__ . '/../Base.php';

class RecNews extends Base
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

        // Date
        $dateAndUser = $this->_getDateAndUser($root);
        $data['user'] = $this->iconv(trim($dateAndUser['user']));
        $data['date'] = $this->_formatDate(trim($dateAndUser['date']));
//        $data['date'] = $dateAndUser['date'];

        // Post text
        $data['post'] = $this->_getPostText($root);

        return $data;
    }

    private function _formatDate($dateStr)
    {
        $months = [
            'januar'    => 1,
            'februar'   => 2,

            'marts'     => 3,
            'march'     => 3,

            'april'     => 4,
            'maj'       => 5,
            'juni'      => 6,
            'juli'      => 7,
            'august'    => 8,
            'september' => 9,

            'oktober'   => 10,
            'okt'       => 10,

            'november'  => 11,
            'december'  => 12,
        ];

        if (strpos($dateStr, '-') !== false || strpos($dateStr, '+') !== false) {
            return 0;
        }
        $dateStr = str_replace('.', '', $dateStr);
        $split = explode(' ', $dateStr);
        if (count($split) < 3) {
//            throw new Exception('Invalid news date format. News id ' . $this->_newsId);
            return 0;
        }

        $d = (int)trim($split[0]);
        $m = (int)$months[strtolower(trim($split[1]))];
        $y = (int)trim($split[2]);
        if (empty($d) || empty($m) || empty($y)) {
            throw new Exception('Could not parse news post date. News id ' . $this->_newsId);
        }
        $timestamp = mktime(0, 0, 0, $m, $d, $y);
        return date('Y-m-d', $timestamp);
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

        $before = $this->getExistingRowsCount('_news', ExternalSite::RECORDERE);
        $catalogLinks = $this->getCatalogLinks();
        $prevCatalogLinks = $this->getPrevCatalogLinks();
        $allLinks = array_merge($catalogLinks, $prevCatalogLinks);
//        $allLinks = $catalogLinks;
        $existingNews = $this->getExistingNews(ExternalSite::RECORDERE);
        foreach ($allLinks as $newsId) {
            if (in_array($newsId, $existingNews)) continue;
            $data = $this->parsePage($newsId);
            $this->saveItem($data);
//            break;
            usleep(1000);
        }
        $after = $this->getExistingRowsCount('_news', ExternalSite::RECORDERE);
        $this->done('RecNews', $before, $after);
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
//            return trim($matches[1][0], '<p>, <a>, <ul>, <li>, <strong>, <span>, <em>, <img>, <b>, <br>');
            $post = trim($matches[1][0]);
            return preg_replace('|\s+|', ' ', $post);
        } else {
            throw new Exception('Could not get post text. News id ' . $this->_newsId);
        }
    }
}