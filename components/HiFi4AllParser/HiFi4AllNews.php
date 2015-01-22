<?php
namespace app\components\hifi4all;

use app\components\hifi4all\HiFi4AllBase;
use Yii;
use app\components\HelperBase;
use yii\base\Exception;

require_once __DIR__ . '/HiFi4AllBase.php';

class HiFi4AllNews extends HiFi4AllBase
{
    private $_baseUrl = 'http://hifi4all.dk/content/templates/nyheder.asp?articleid=';

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

        HelperBase::dump($data);

    }

    public function saveItem($data)
    {

    }

    public function run()
    {

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
}