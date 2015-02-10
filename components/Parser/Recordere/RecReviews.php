<?php
namespace app\components\parser\recordere;

use Yii;
use app\models\Reviews;
use app\models\ReviewsTypes;
use app\components\parser\Base;
use app\models\ExternalSite;
use app\components\HelperBase;
use yii\base\Exception;

require_once __DIR__ . '/../Base.php';

class RecReviews extends Base
{
    private $_baseUrl = 'http://www.recordere.dk/indhold/templates/design.aspx?articleid=';
    private $_catalogUrl = 'http://www.recordere.dk/anmeldelser/';
    private $_reviewId = 0;

    public function parsePage($id)
    {
        $this->_reviewId = $id;
        $html = $this->tidy($this->_baseUrl . $id);
        $data = [];
        $data['id'] = $id;

        // Root block
        $root = $this->_getRootBlock($html);

        // Title
        $data['title'] = $this->_getTitle($root);

        // Date
        $date = $this->_recGetDate($root);
        $data['date'] = $this->formatDate($date, 'Reviews', $this->_reviewId);

        // Post text
        $data['post'] = $this->_getPostText($root);

        return $data;
    }

    public function saveItem($data)
    {
        $item = new Reviews();
        $item->site_id          = ExternalSite::RECORDERE;
        $item->review_id        = $data['id'];
        $item->review_type_id   = ReviewsTypes::UNKNOWN;
        $item->title            = $data['title'];
        $item->af               = '';
        $item->notice           = '';
        $item->post             = $data['post'];
        $item->post_date        = $data['date'];

        if ($item->save(false)) {
            return $item->id;
        } else {
            throw new Exception('Review data could not be saved. Review id ' . $data['id']);
        }
    }

    /**
     * Parse catalog to get links to reviews pages
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
            throw new Exception('Could not retrieve reviews ids from catalog page.');
        }
    }

    public function run()
    {
        set_time_limit(0);
        $before = $this->getExistingRowsCount('_reviews', ExternalSite::RECORDERE);
        $catalogLinks = $this->getCatalogLinks();
        $existingReviews = $this->getExistingReviews(ExternalSite::RECORDERE);
        foreach ($catalogLinks as $reviewId) {
            if (in_array($reviewId, $existingReviews)) continue;
            $data = $this->parsePage($reviewId);
            $this->saveItem($data);
//            break;
            usleep(1000);
        }
        $after = $this->getExistingRowsCount('_reviews', ExternalSite::RECORDERE);
        $this->done('RecReviews', $before, $after);
    }

    private function _getRootBlock($html)
    {
        $pattern = '|<div\s+id="content">(.*)</div>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return $matches[1];
        } else {
            throw new Exception('Could not get root block. Reviews id ' . $this->_reviewId);
        }
    }

    private function _getTitle($html)
    {
        $pattern = '|<span\s+class="frontheadline">\s*<big>([^>]+)</big>\s*</span>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim($matches[1]);
        } else {
            throw new Exception('Could not get title attribute. Reviews id ' . $this->_reviewId);
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
            throw new Exception('Could not get post text. Reviews id ' . $this->_reviewId);
        }
    }
}