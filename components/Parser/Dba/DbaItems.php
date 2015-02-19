<?php
namespace app\components\parser\recordere;

use Yii;
use app\components\parser\Base;
use app\models\ExternalSite;
use app\models\Item;
use app\components\HelperBase;
use yii\base\Exception;

require_once __DIR__ . '/../Base.php';

class DbaItems extends Base
{
    private $_baseUrl = 'http://www.dba.dk/bla-bla-bla/id-{id}';
    private $_catalogUrl = 'http://www.recordere.dk/nyheder/';
    private $_prevCatalogUrl = 'http://www.recordere.dk/nyheder/nyhedsliste.aspx';

    private $_itemId = 0;

    public function parsePage($id)
    {
        $this->_itemId = $id;
        $page = str_replace('{id}', $id, $this->_baseUrl);
        $html = $this->tidy($page, 'utf8');
//        return false;

        $topContainer   = $this->_getTopContainer($html);
        $category       = $this->_getCategory($topContainer);
        $subCategory    = $this->_getSubCategory($topContainer);
        $title          = $this->_getTitle($html);
        $price          = $this->_getPrice($html);
        $date           = $this->_getPubDate($html);
        $preview        = $this->_getPreview($html);
        $post           = $this->_getPostText($html);
        $footer         = $this->_getFooter($html);
        $brand          = $this->_getBrand($footer);
        $model          = $this->_getModel($footer);
        $producer       = $this->_getProducer($footer);
        $watt           = $this->_getWatt($footer);
        $type           = $this->_getType($footer);
        $product        = $this->_getProduct($footer);

        $contactInfoBlock = $this->_getContactInfoBlock($html);
        $username = $this->_getUserName($contactInfoBlock);
        $location = $this->_getLocation($contactInfoBlock);

        $data = [
            'category'      => $category,
            'subCategory'   => $subCategory,
            'title'         => $title,
            'price'         => $price,
            'date'          => $date,
            'preview'       => $preview,
            'post'          => $post,
            'brand'         => $brand,
            'model'         => $model,
            'producer'      => $producer,
            'watt'          => $watt,
            'type'          => $type,
            'product'       => $product,
            'username'      => $username,
            'location'      => $location,
        ];

        HelperBase::dump($data);
    }

    public function _getTopContainer($html)
    {
        $pattern = '|<div\s+class="container">(.*?)</div>|is';
        preg_match_all($pattern, $html, $matches);
        if (isset($matches[1], $matches[1][1])) {
            return trim($matches[1][1]);
        } else {
            throw new Exception('Could not get top container. Page id ' . $this->_itemId);
        }
    }

    public function _getFooter($html)
    {
        $pattern = '|<div\s+class="vip-matrix-data">(.*?)</div>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim($matches[1]);
        } else {
            throw new Exception('Could not get footer. Page id ' . $this->_itemId);
        }
    }

    public function _getCategory($html)
    {
        $pattern = '|<span\s+itemprop="title">([^<]+)</span>|is';
        preg_match_all($pattern, $html, $matches);
        if (isset($matches[1], $matches[1][2])) {
            $category = preg_replace('|\s+|', ' ', $matches[1][2]);
            return trim($category);
        } else {
            throw new Exception('Could not get item category. Page id ' . $this->_itemId);
        }
    }

    public function _getSubCategory($html)
    {
        $pattern = '|<h1\s+itemprop="title">(.*?)</h1>|is';
        preg_match_all($pattern, $html, $matches);
        if (isset($matches[1], $matches[1][0])) {
            $matches = trim(strip_tags($matches[1][0]));
            return preg_replace('|\s+|', ' ', $matches);
        } else {
            throw new Exception('Could not get sub category. Page id ' . $this->_itemId);
        }
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

    private function _getPrice($html)
    {
        $pattern = '|<span\s+class="price-tag">([^<]+)</span>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim($matches[1]);
        } else {
            throw new Exception('Could not get price attribute. Page id ' . $this->_itemId);
        }
    }

    private function _getPubDate($html)
    {
        $pattern = '|<span\s+class="time-stamp">([^<]+)</span>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim($matches[1]);
        } else {
            throw new Exception('Could not get date attribute. Page id ' . $this->_itemId);
        }
    }

    private function _getContactInfoBlock($html)
    {
        $pattern = '|<div\s+class="vip-contact-information[^"]+">(.*?)</div>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim(preg_replace('|\s+|', ' ', $matches[1]));
        } else {
            throw new Exception('Could not get contact info block. Page id ' . $this->_itemId);
        }
    }

    private function _getUserName($html)
    {
        $pattern = '|<h2>([^<]+)</h2>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim(preg_replace('|\s+|', ' ', $matches[1]));
        } else {
            throw new Exception('Could not get user name. Page id ' . $this->_itemId);
        }
    }

    private function _getLocation($html)
    {
        $pattern = '|<span\s+class="line">(.*?)</span>|is';
        preg_match_all($pattern, $html, $matches);
//        if (isset($matches[1], $matches[1][0], $matches[1][1])) {
        if (isset($matches[1], $matches[1][0])) {
            $location = $matches[1][0];
            if (isset($matches[1][1])) {
                $location .= '<br />' . $matches[1][1];
            }
            $location = strip_tags($location, '<br>');
            return trim(preg_replace('|\s+|', ' ', $location));
        } else {
            throw new Exception('Could not get item location. Page id ' . $this->_itemId);
        }
    }

    public function run()
    {
        set_time_limit(0);

        /*$before = $this->getExistingRowsCount('news', ExternalSite::RECORDERE);
        $catalogLinks = $this->getCatalogLinks();
        $prevCatalogLinks = $this->getPrevCatalogLinks();
        $allLinks = array_merge($catalogLinks, $prevCatalogLinks);
//        $allLinks = $catalogLinks;
        $allLinks = array_unique($allLinks);
        $existingNews = $this->getExistingNews(ExternalSite::RECORDERE);
        foreach ($allLinks as $newsId) {
            if (in_array($newsId, $existingNews)) continue;
            $data = $this->parsePage($newsId);
            $this->saveItem($data);
            usleep(1000);
        }
        $after = $this->getExistingRowsCount('news', ExternalSite::RECORDERE);
        $this->done('RecNews', $before, $after);*/
    }

    private function _getTitle($html)
    {
        $pattern = '|<div\s+class="row-fluid">\s+<h1>([^<]+)</h1>\s+</div>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim(preg_replace('|\s+|', ' ', $matches[1]));
        } else {
            throw new Exception('Could not get title attribute. Page id ' . $this->_itemId);
        }
    }

    private function _getPostText($html)
    {
        $pattern = '|<div\s+class="vip-additional-text">(.*?)</div>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim(preg_replace('|\s+|', ' ', $matches[1]));
        } else {
            throw new Exception('Could not get post text. Page id ' . $this->_itemId);
        }
    }

    private function _getPreview($html)
    {
        $pattern = '|src="(http://dbastatic.dk/pictures/[^"]+)"|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return $matches[1];
        } else {
            throw new Exception('Could not get item preview. Page id ' . $this->_itemId);
        }
    }

    private function _getBrand($html)
    {
        $pattern = '|<td>\s*Mærke\s*</td>\s*<td>([^<]+)</td>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim(preg_replace('|\s+|', ' ', $matches[1]));
        } else {
            return '';
        }
    }

    private function _getModel($html)
    {
        $pattern = '|<td>\s*Model\s*</td>\s*<td>([^<]+)</td>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim(preg_replace('|\s+|', ' ', $matches[1]));
        } else {
            return '';
        }
    }

    private function _getProducer($html)
    {
        $pattern = '|<td>\s*Producent\s*</td>\s*<td>([^<]+)</td>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim(preg_replace('|\s+|', ' ', $matches[1]));
        } else {
            return '';
        }
    }

    private function _getWatt($html)
    {
        $pattern = '|<td>\s*Watt\s*</td>\s*<td>([^<]+)</td>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim(preg_replace('|\s+|', ' ', $matches[1]));
        } else {
            return '';
        }
    }

    private function _getType($html)
    {
        $pattern = '|<td>\s*Type\s*</td>\s*<td>([^<]+)</td>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim(preg_replace('|\s+|', ' ', $matches[1]));
        } else {
            return '';
        }
    }

    private function _getProduct($html)
    {
        $pattern = '|<td>\s*Produkt\s*</td>\s*<td>([^<]+)</td>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim(preg_replace('|\s+|', ' ', $matches[1]));
        } else {
            return '';
        }
    }
}