<?php
namespace app\components\parser\hifi;

use yii\base\Exception;
use app\components\parser\Base;
use app\components\HelperBase;
use app\models\Reviews;
use app\models\ExternalSite;
use app\models\ReviewsTypes;

require_once __DIR__ . '/../Base.php';

class HiFiReviews extends Base
{
    private $_baseUrl       = 'http://hifi4all.dk/content/templates/anmeldelser.asp?articleid=';
    private $_catalogUrl    = 'http://hifi4all.dk/content/anmeldelser.asp';
    private $_reviewId      = 0;

    public function parsePage($id)
    {
        $this->_reviewId = $id;
        $html = $this->tidy($this->_baseUrl . $id);
        $data = [];
        $data['id'] = $id;

        // Title
        $data['title'] = $this->_getTitle($html);

        // Af
        $data['af'] = $this->_getAf($html);

        // Date
        $data['date'] = $this->_getDate($html);

        // Notification
        $data['notice'] = $this->_getNotification($html);

        // Post text
        $data['post'] = $this->_getPostText($html);

        return $data;
    }

    private function _getBlocksHtml()
    {
        $html = $this->tidy($this->_catalogUrl);
        $pattern = '|<table\s+border="0"\s+width="100%"\s+bgcolor="#F5F5F5"\s+height="100%"\s+cellspacing="1">(.*?)</table>|is';
        preg_match_all($pattern, $html, $matches);
        if (isset($matches[1], $matches[1][0])) {
            return $matches[1];
        } else {
            throw new Exception('Could not retrieve reviews ids from catalog page.');
        }
    }

    private function _getBlockIds($html)
    {
        $pattern = '|a=(\d+)|is';
        preg_match_all($pattern, $html, $matches);
        if (isset($matches[1], $matches[1][0])) {
            return array_unique($matches[1]);
        } else {
            throw new Exception('Could not retrieve block ids from catalog page.');
        }
    }

    private function _prepareBlocks($blocks)
    {
        $data = [];
        $data[ReviewsTypes::AMPLIFIER]      = $this->_getBlockIds($blocks[0]); // Amplifier Forstærker
        $data[ReviewsTypes::SPEAKER]        = $this->_getBlockIds($blocks[1]); // Speaker Højtaler
        $data[ReviewsTypes::DIGITAL]        = $this->_getBlockIds($blocks[2]); // Digital Digital
        $data[ReviewsTypes::CABLE]          = $this->_getBlockIds($blocks[3]); // Cable Kabel
        $data[ReviewsTypes::ANALOG]         = $this->_getBlockIds($blocks[4]); // Analog Analog
        $data[ReviewsTypes::ACCESSORIES]    = $this->_getBlockIds($blocks[5]); // Accessories Tilbehør
        $data[ReviewsTypes::SURROUND]       = $this->_getBlockIds($blocks[6]); // Surround Surround
        $data[ReviewsTypes::DVD]            = $this->_getBlockIds($blocks[7]); // DVD
        $data[ReviewsTypes::IMAGE]          = $this->_getBlockIds($blocks[8]); // Image Billede
        return $data;
    }

    public function getCatalogLinks()
    {
        $blocksHtml = $this->_getBlocksHtml();
        return $this->_prepareBlocks($blocksHtml);
    }

    public function saveItem($data, $reviewType)
    {
        $item = new Reviews();
        $item->site_id          = ExternalSite::HIFI4ALL;
        $item->review_id        = $data['id'];
        $item->review_type_id   = $reviewType;
        $item->title            = $data['title'];
        $item->af               = $data['af'];
        $item->notice           = $data['notice'];
        $item->post             = $data['post'];
        $item->post_date        = $data['date'];

        if ($item->save(false)) {
            return $item->id;
        } else {
            throw new Exception('Review data could not be saved. Review id ' . $data['id']);
        }
    }

    public function run()
    {
        $before = $this->getExistingRowsCount('_reviews', ExternalSite::HIFI4ALL);
        $blocks = $this->getCatalogLinks();
        foreach ($blocks as $reviewType => $blockIds) {
            $existingReviews = $this->getExistingReviews(ExternalSite::HIFI4ALL);
            foreach ($blockIds as $id) {
                if (in_array($id, $existingReviews)) continue;
                $reviewData = $this->parsePage($id);
                $this->saveItem($reviewData, $reviewType);
                usleep(1000);
            }
//            break;
        }
        $after = $this->getExistingRowsCount('_reviews', ExternalSite::HIFI4ALL);
        $this->done('HiFiReviews', $before, $after);
    }

    private function _getTitle($html)
    {
        $pattern = '|<span\s+class="bigfontNews">([^>]+)</span>|is';
        preg_match_all($pattern, $html, $matches);
        if (isset($matches[1], $matches[1][0])) {
            return trim($matches[1][0]);
        } else {
            throw new Exception('Could not get title attribute. Review id ' . $this->_reviewId);
        }
    }

    private function _getDate($html)
    {
        $pattern = '|<font\s+color="#999999">([^<]+)</font>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            $date = str_replace(['[', ']'], '', $matches[1]);
            return preg_replace('|(\d{2}).(\d{2}).(\d{4})|is', '$3-$2-$1', $date);
        } else {
            return 0;
//            throw new Exception('Could not get date attribute. Review id ' . $this->_reviewId);
        }
    }

    private function _getAf($html)
    {
        $pattern = '|Af:\s+([^<]+)|is';
        preg_match_all($pattern, $html, $matches);
        if (isset($matches[1], $matches[1][0])) {
            return trim(str_replace('&nbsp;', '', $matches[1][0]));
        } else {
            throw new Exception('Could not get Af attribute. Review id ' . $this->_reviewId);
        }
    }

    private function _getNotification($html)
    {
        $pattern = '|<b>([^<]+)</b>|is';
        preg_match_all($pattern, $html, $matches);
        if (isset($matches[1], $matches[1][0])) {
            $notice = trim($matches[1][0]);
            return preg_replace('|\s+|is', ' ', $notice);
        } else {
            throw new Exception('Could not get notification message. Review id ' . $this->_reviewId);
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
            throw new Exception('Could not get review text. Review id ' . $this->_reviewId);
        }
    }
}