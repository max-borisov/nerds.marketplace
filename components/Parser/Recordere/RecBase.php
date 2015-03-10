<?php
namespace app\components\parser\recordere;

use Yii;
use app\components\parser\Base;
use yii\base\Exception;
use app\models\ExternalSite;
use app\components\HelperBase;

require_once __DIR__ . '/../Base.php';

abstract class RecBase extends Base
{
    protected $_articleId = 0;

    /**
     * Parse catalog page to get articles links
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
            throw new Exception('Could not retrieve articles ids from catalog page.');
        }
    }

    private function _getRootBlock($html, $pageId)
    {
        $pattern = '|<div\s+id="content">(.*)</div>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return $matches[1];
        } else {
            throw new Exception('Could not get root block. News id ' . $pageId);
        }
    }

    private function _getTitle($html, $pageId)
    {
        $pattern = '|<span\s+class="frontheadline">\s*<big>([^>]+)</big>\s*</span>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim($matches[1]);
        } else {
            throw new Exception('Could not get title attribute. News id ' . $pageId);
        }
    }

    private function _getPostText($html, $pageId)
    {
        $pattern = '|<td>\s+<div\s+id="bodytext">(.*?)</div>\s+</td>|is';
        preg_match_all($pattern, $html, $matches);
        if (isset($matches[1], $matches[1][0])) {
//            return trim($matches[1][0], '<p>, <a>, <ul>, <li>, <strong>, <span>, <em>, <img>, <b>, <br>');
            $post = trim($matches[1][0]);
            return preg_replace('|\s+|', ' ', $post);
        } else {
            throw new Exception('Could not get post text. News id ' . $pageId);
        }
    }

    public function parsePage($id = 0, $block = '')
    {
        $this->_articleId = $id;
        $html = $this->tidy($this->_baseUrl . $id);
        $data = [];
        $data['id'] = $id;

        // Root block
        $root = $this->_getRootBlock($html, $id);

        // Title
        $data['title'] = $this->_getTitle($root, $id);

        // Date
        $date = $this->_recGetDate($root);
        $data['date'] = $this->formatDate($date, $block, $id);

        // Post text
        $data['post'] = $this->_getPostText($root, $id);

        return $data;
    }

    protected function _processAndSave($links, $records, $type)
    {
        foreach ($links as $articleId) {
            if (in_array($articleId, $records)) continue;
            $data = $this->parsePage($articleId, $type);
            $this->saveItem($data);
            usleep(100);
        }
        return true;
    }

    protected function _beforeSaveNewsReviews($model, $data)
    {
        $model->site_id     = ExternalSite::RECORDERE;
        $model->title       = $data['title'];
        $model->af          = '';
        $model->notice      = '';
        $model->post        = $data['post'];
        $model->post_date   = $data['date'];
        return $model;
    }

    protected function _beforeSave($model, $data)
    {
        $model->site_id     = ExternalSite::RECORDERE;
        $model->article_id  = $data['id'];
        $model->title       = $data['title'];
        $model->post        = $data['post'];
        $model->post_date   = $data['date'];
        return $model;
    }

    public function getExistingArticles($table, $siteId)
    {
        $data = (new \yii\db\Query())
            ->select('article_id')
            ->from($table)
            ->where('site_id = :site_id', ['site_id' => $siteId])
            ->all();

        if ($data) {
            $tmp = [];
            foreach ($data as $item) {
                $tmp[] = $item['article_id'];
            }
            $data = $tmp;
        }
        return $data;
    }
}