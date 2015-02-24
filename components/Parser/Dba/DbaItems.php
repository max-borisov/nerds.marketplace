<?php
namespace app\components\parser\dba;

use Yii;
use app\components\parser\Base;
use app\models\ExternalSite;
use app\models\Item;
use app\models\ItemDba;
use app\models\ItemCatalog;
use app\models\ItemType;
use app\models\Category;
use app\components\HelperBase;
use yii\base\Exception;

require_once __DIR__ . '/../Base.php';

class DbaItems extends Base
{
    private $_baseUrl       = 'http://www.dba.dk/bla-bla-bla/id-{id}/';
//    private $_catalogUrl    = 'http://www.dba.dk/billede-og-lyd/hi-fi-og-tilbehoer/';
//    private $_catalogUrl    = 'http://www.dba.dk/billede-og-lyd/hi-fi-og-tilbehoer/hoejttalere-hi-fi/';
    private $_catalogUrl    = 'http://www.dba.dk/billede-og-lyd/hi-fi-og-tilbehoer/stereoanlaeg/';
    private $_itemId        = 0;
    private $_year          = 2015;

    public function urlsSet()
    {
        $data = [
            Category::SPEAKERS_HIFI => [
                'url'   => 'http://www.dba.dk/billede-og-lyd/hi-fi-og-tilbehoer/hoejttalere-hi-fi/',
                'types' => [
                    ItemType::SELL      => 96,
                    ItemType::BUY       => 3,
                    ItemType::EXCHANGE  => 1,
                ]
            ],
        ];

    }

    public function parsePage($id)
    {
        $this->_itemId = $id;
        $page = str_replace('{id}', $id, $this->_baseUrl);
        $html = $this->tidy($page, 'utf8');

        $topContainer   = $this->_getTopContainer($html);
        $category       = $this->_getCategory($topContainer);
        $subCategory    = $this->_getSubCategory($topContainer);
        if ($subCategory === false) return false;
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

        // If today
        if (strpos($date, 'dag') !== false) {
            $date = date('Y-m-d');
        } else if (strpos($date, 'går') !== false) {
            // yesterday
            $date = date('Y-m-d', strtotime( '-1 days' ));
        } else {
            $date = $this->_formatDate($date);
        }

        $data = [
            'id'            => $id,
            'categoryMain'  => $category,
            'categorySub'   => $subCategory,
            'categoryId'    => $this->_getCategoryId($subCategory),
            'title'         => $title,
            'price'         => $this->_formatPrice($price),
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
        return $data;
    }

    private function _formatPrice($price)
    {
        return trim(str_replace(['kr', '.', ' '], '', $price));
    }

    private function _getCategoryId($title)
    {
        if (strpos($title, 'Højttalere') !== false) {
            return Category::SPEAKERS_HIFI;
        }
        if (strpos($title, 'Stereoanlæg') !== false) {
            return Category::STEREO_SYSTEM;
        }
        if (strpos($title, 'Hovedtelefoner') !== false) {
            return Category::HEADPHONES;
        }
        if (strpos($title, 'Radioer') !== false) {
            return Category::RADIO;
        }
        if (strpos($title, 'Pladespillere') !== false) {
            return Category::TURNTABLE;
        }
        if (strpos($title, 'Cd') !== false) {
            return Category::CD_PLAYER;
        }
        if (strpos($title, 'Mp3') !== false) {
            return Category::MP3_MP4_PLAYERS;
        }
        if (strpos($title, 'Båndoptagere') !== false) {
            return Category::TAPE_RECORDER;
        }
        if (strpos($title, 'Tilbehør til MP3') !== false) {
            return Category::MP3_ACCESSORIES;
        }
        if (strpos($title, 'Minidisc') !== false) {
            return Category::MINI_DISC_PLAYER;
        }
        return 0;
    }

    private function _formatDate($dateStr)
    {
        $months = $this->getMonthsList();
        preg_match('|^\d+|', $dateStr, $matches);
        if (isset($matches[0])) {
            $day = $matches[0];
        } else {
            throw new Exception('Could not get post day. Page id ' . $this->_itemId);
        }
        preg_match('|[a-z]+|i', $dateStr, $matches);
        if (isset($matches[0])) {
            $month = $matches[0];
        } else {
            throw new Exception('Could not get post month. Page id ' . $this->_itemId);
        }
        if (!isset($months[$month])) {
            throw new Exception('Could not get month number. Page id ' . $this->_itemId);
        }
        $month = $months[$month];
        return date('Y-m-d', mktime(0, 0 , 0, $month, $day, $this->_year));
    }

    private function _getTopContainer($html)
    {
        $pattern = '|<div\s+class="container">(.*?)</div>|is';
        preg_match_all($pattern, $html, $matches);
        if (isset($matches[1], $matches[1][1])) {
            return trim($matches[1][1]);
        } else {
            throw new Exception('Could not get top container. Page id ' . $this->_itemId);
        }
    }

    private function _getFooter($html)
    {
        $pattern = '|<div\s+class="vip-matrix-data">(.*?)</div>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim($matches[1]);
        } else {
            throw new Exception('Could not get footer. Page id ' . $this->_itemId);
        }
    }

    private function _getCategory($html)
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

    private function _getSubCategory($html)
    {
        $pattern = '|<h1\s+itemprop="title">(.*?)</h1>|is';
        preg_match_all($pattern, $html, $matches);
        if (isset($matches[1], $matches[1][0])) {
            $matches = trim(strip_tags($matches[1][0]));
            return preg_replace('|\s+|', ' ', $matches);
        } else {
            HelperBase::logger('DBA parser. Item sub category.', null, ['Page id' => $this->_itemId]);
            return false;
//            throw new Exception('Could not get sub category. Page id ' . $this->_itemId);
        }
    }

    /**
     * Save parsed item data to the database
     * @param $data
     * @return int
     * @throws \yii\base\Exception
     */
    public function saveItem($data)
    {
        $item = new Item();
        $item->user_id      = 112233;
        $item->category_id  = $data['categoryId'];
        $item->type_id      = ItemType::SELL;

        $item->site_id      = ExternalSite::DBA;
        $item->title        = $data['title'];
        $item->s_item_id    = $data['id'];
        $item->s_user       = $data['username'];
        $item->s_location   = $data['location'];

        $item->warranty     = Item::WARRANTY_NA;
        $item->invoice      = Item::INVOICE_NA;
        $item->packaging    = Item::PACKAGING_NA;
        $item->manual       = Item::MANUAL_NA;

//        $item->s_phone      = $data['phone'];
//        $item->s_email      = $data['email'];
//        $item->s_type       = $data['type'];
//        $item->s_adv        = $data['adv'];
        $item->s_date       = $data['date'];
        $item->price        = $data['price'];
//        $item->description  = $data['description'];
        $item->s_preview    = $data['preview'];
//        $item->s_age        = $data['info']['age'];
//        $item->s_warranty   = $data['info']['warranty'];
//        $item->s_package    = $data['info']['package'];
//        $item->s_delivery   = $data['info']['delivery'];
//        $item->s_akn        = $data['info']['ack'];
//        $item->s_manual     = $data['info']['manual'];
//        $item->s_expires    = $data['info']['expires'];
        $item->s_brand      = $data['brand'];
        $item->s_model      = $data['model'];
        $item->s_producer   = $data['producer'];
        $item->s_watt       = $data['watt'];
        $item->s_product    = $data['product'];

        if (!$item->save(false)) {
            throw new Exception('Data could not be saved for DBA. Item id ' . $data['id']);
        }
        return $item->id;
    }

    /**
     * Parse catalog to get links to news pages
     * @return mixed
     * @throws \yii\base\Exception
     */
    public function getCatalogLinks($side = 0)
    {
        $url = $this->_catalogUrl;
        if ($side > 1) {
            $url .= '/side-' . $side . '/';
        }
//        $html = $this->tidy($url);
        $html = file_get_contents($url);
        $pattern = '|<a\s+class="link-to-listing"\s+href="http://www\.dba\.dk/[^/]+/id-(\d+)/"\s*>[^<]+</a>|is';
        preg_match_all($pattern, $html, $matches);
        if (isset($matches[1])) {
            return array_unique($matches[1]);
        } else {
            throw new Exception('Could not retrieve items ids from catalog page.');
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

//        $side = 7;
//        $catalogLinks = $this->getCatalogLinks($side);
//        HelperBase::dump($catalogLinks);
//        HelperBase::end();

        $urlSet = $this->urlsSet();
        for

        return true;

        $before = $this->getExistingRowsCount('item', ExternalSite::DBA);

        $counter = 0;
//        for ($i=1; $i <= 192; $i++) {
//        for ($i=1; $i <= 96; $i++) {
        for ($i=1; $i <= 135; $i++) {
            $catalogLinks = $this->getCatalogLinks($i);
//            HelperBase::dump($catalogLinks, true);

            $counter += count($catalogLinks);

            $track = new ItemCatalog();
            $track->side = $i;
            $track->num = count($catalogLinks);
            $track->save();

            continue;

            $existingItems = $this->getExistingItems(ExternalSite::DBA);
            foreach ($catalogLinks as $itemId) {
                $tracker = new ItemDba();
                $tracker->side = $i;
                $tracker->item_id = $itemId;
                $tracker->is_saved = 0;

                if ($itemId == '122') {
                    $tracker->save();
                    continue;
                }

                if (in_array($itemId, $existingItems)) {
                    $tracker->save();
                    continue;
                }
                $data = $this->parsePage($itemId);
                if ($data === false) {
                    $tracker->save();
                    continue;
                }
                $this->saveItem($data);

                $tracker->is_saved = 1;
                $tracker->save();

                usleep(500);
            }
//            HelperBase::dump($catalogLinks);
//            echo '<hr>';

//            if ($i == 10) break;
        }

        HelperBase::dump($counter);

        $after = $this->getExistingRowsCount('item', ExternalSite::DBA);
        $this->done('DbaItems', $before, $after);
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
//        echo $html;
//        HelperBase::end();
//        <img data-bind="attr: { src: displayPicture }" src="http://dbastatic.dk/pictures/pictures/93/77/9995-5435-414f-950f-53b386886df1.jpg?preset=vipgalleryprimary" alt="Cerwin Vega">
//        $pattern = '|src="(http://dbastatic\.dk/pictures/[^"]+)"|is';
//        $pattern = '|src="(http://dbastatic\.dk/[\w\-\.\?])+"|is';
        $pattern = '|(http://dbastatic.dk/pictures/[^"]+)|is';
//        $pattern = '|<img(.*?)src="http://dbastatic.dk/pictures/[^"]+"\s+alt="\w+">|is';
        preg_match($pattern, $html, $matches);
//        HelperBase::dump($matches, true);

        if (isset($matches[0])) {
            return $matches[0];
        } else {
            return '';
//            throw new Exception('Could not get item preview. Page id ' . $this->_itemId);
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