<?php
namespace app\components\parser\dba;

use app\models\TopCategory;
use Yii;
use app\components\parser\Base;
use app\models\ExternalSite;
use app\models\Item;
use app\models\AdType;
use app\components\HelperBase;
use yii\base\Exception;
use yii\db\IntegrityException;

require_once __DIR__ . '/../Base.php';

class DbaItems extends Base
{
    private $_baseUrl       = 'http://www.dba.dk/bla-bla-bla/id-{id}/';
    private $_itemId        = 0;
    private $_year          = 2015;

    public function urlsSet()
    {
        $data = [];
        $data[TopCategory::MOVIE] = require_once 'categories/movie.php';
        $data[TopCategory::MUSIC_CD_LP_TAPE] = require_once 'categories/music_cd_lp.php';
        $data[TopCategory::HIFI_ACCESSORIES] = require_once 'categories/hifi_accessories.php';
        $data[TopCategory::TV_ACCESSORIES] = require_once 'categories/tv_accessories.php';
        $data[TopCategory::PHOTO_EQUIPMENT] = require_once 'categories/photo_equipment.php';
        $data[TopCategory::DVD_VCR_PROJECTOR_ACCESSORIES] = require_once 'categories/dvd_vcr_projector_accessories.php';
        $data[TopCategory::VIDEO_CAM_FILM_EQUIPMENT_BINOCULARS] = require_once 'categories/video_cameras_film_equipment_binoculars.php';
        $data[TopCategory::DIGITAL_CAMERAS] = require_once 'categories/digital_cameras.php';
        $data[TopCategory::HIFI_SURROUNDS_ACCESSORIES] = require_once 'categories/hifi_surrounds_accessories.php';
        $data[TopCategory::SATELLITE_DISHES_ANTENNAS_ACCESSORIES] = require_once 'categories/satellite_dishes_antennas_accessories.php';
        $data[TopCategory::ANALOG_CAMERAS] = require_once 'categories/analog_cameras.php';
        return $data;
    }

    public function parsePage($id)
    {
        $this->_itemId = $id;
        $page = str_replace('{id}', $id, $this->_baseUrl);
        $html = $this->tidy($page, 'utf8');

        // If page is not valid
        if ($this->_isPageBroken($html)) {
            HelperBase::logger('DBA parser. Requested page is broken.', null, ['page id' => $id]);
            return false;
        }

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
        // For movies
        $mediaTitle         = $this->_getMediaTitle($html);
        $mediaGenre         = $this->_getMediaGenre($html);
        $mediaType          = $this->_getMediaType($html);
        $mediaProducer      = $this->_getMediaProducer($html);
        // For music
        $musicArtist    = $this->_getMusicArtist($html);

        // For TV
        $mediaFeatures  = $this->_getMediaFeatures($html);
        $mediaInches    = $this->_getMediaInches($html);
        $mediaSize      = $this->_getMediaSize($html);

        $eqCapacity = $this->_getEqCapacity($html);
        $hdCapacity = $this->_getHardDiscCapacity($html);

        $cameraResolution   = $this->_getCameraResolution($html);
        $opticalZoom        = $this->_getOpticalZoom($html);

        $speaker        = $this->_getSpeaker($html);
        $speakerType    = $this->_getSpeakerType($html);

        $channels = $this->_getChannels($html);

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
            'id'                => $id,
            'title'             => $title,
            'price'             => $this->_formatPrice($price),
            'date'              => $date,
            'preview'           => $preview,
            'post'              => $post,
            'brand'             => $brand,
            'model'             => $model,
            'producer'          => $producer,
            'watt'              => $watt,
            'type'              => $type,
            'product'           => $product,
            'username'          => $username,
            'location'          => $location,
            'media_title'       => $mediaTitle,
            'media_genre'       => $mediaGenre,
            'media_type'        => $mediaType,
            'media_producer'    => $mediaProducer,
            'music_artist'      => $musicArtist,
            'media_features'    => $mediaFeatures,
            'media_inches'      => $mediaInches,
            'media_size'        => $mediaSize,
            'eq_capacity'       => $eqCapacity,
            'hd_capacity'       => $hdCapacity,
            'camera_resolution' => $cameraResolution,
            'optical_zoom'      => $opticalZoom,
            'speaker'           => $speaker,
            'speaker_type'      => $speakerType,
            'channels'          => $channels,
        ];
        return $data;
    }

    private function _formatPrice($price)
    {
        return trim(str_replace(['kr', '.', ' '], '', $price));
    }

    private function _isPageBroken($html)
    {
        $pattern = '|<a\s+class="link-to-listing"\s+href="http://www\.dba\.dk/[^/]+/id-(\d+)/"\s*>[^<]+</a>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return true;
        }
        return false;
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

    private function _getFooter($html)
    {
        $pattern = '|<div\s+class="vip-matrix-data">(.*?)</div>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim($matches[1]);
        } else {
            HelperBase::logger('DBA parser error', null, ['msg' => 'Could not get footer. Page id ' . $this->_itemId]);
            return '';
//            throw new Exception('Could not get footer. Page id ' . $this->_itemId);
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
        $item->user_id      = 0;
        $item->category_id  = $data['category_id'];
        $item->ad_type_id   = $data['ad_type_id'];

        $item->site_id      = ExternalSite::DBA;
        $item->title        = $data['title'];
        $item->s_item_id    = $data['id'];
        $item->s_user       = $data['username'];
        $item->s_location   = $data['location'];

        $item->warranty     = Item::NA_FLAG;
        $item->invoice      = Item::NA_FLAG;
        $item->packaging    = Item::NA_FLAG;
        $item->manual       = Item::NA_FLAG;
        $item->s_date       = $data['date'];
        $item->price        = $data['price'];
        $item->s_preview    = $data['preview'];
        $item->s_brand      = $data['brand'];
        $item->s_model      = $data['model'];
        $item->s_producer   = $data['producer'];
        $item->s_watt       = $data['watt'];
        $item->s_product    = $data['product'];

        $item->media_title      = $data['media_title'];
        $item->media_genre      = $data['media_genre'];
        $item->media_type       = $data['media_type'];
        $item->media_producer   = $data['media_producer'];

        try {
            if (!$item->save(false)) {
                throw new Exception('Data could not be saved for DBA. Item id ' . $data['id']);
            }
        } catch (IntegrityException $e) {
            $item->isNewRecord = false;
            if (!$item->save(false)) {
                throw new Exception('Data could not be saved for DBA. Item id ' . $data['id']);
            }
        }

        return $item->id;
    }

    /**
     * Parse catalog to get items links
     * @param string $url
     * @return mixed
     * @throws \yii\base\Exception
     */
    public function getLinksFromCatalog($url = '')
    {
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

    private function _getPrice($html)
    {
        $pattern = '|<span\s+class="price-tag">([^<]+)</span>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim($matches[1]);
        } else {
            HelperBase::logger('DBA parser error', null, ['msg' => 'Could not get item price', 'item id' => $this->_itemId]);
            return 0;
//            throw new Exception('Could not get price attribute. Page id ' . $this->_itemId);
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

    private function _process($baseUrl, $category, $advType, $pages)
    {
        switch ($advType) {
            case AdType::SELL: {
                $getParam = '';
                break;
            }
            case AdType::BUY: {
                $getParam = '?antype=koebes';
                break;
            }
            case AdType::EXCHANGE: {
                $getParam = '?antype=byttes';
                break;
            }
        }
        $urlToParse = '';
        for ($i=1; $i <= $pages; $i++) {
            if ($i > 1) {
                $side = 'side-' . $i . '/';
            } else {
                $side = '';
            }
            $urlToParse = $baseUrl . $side . $getParam;
            $catalogLinks = $this->getLinksFromCatalog($urlToParse);
            $existingItems = $this->getExistingItems(ExternalSite::DBA);
            foreach ($catalogLinks as $itemId) {
                if (in_array($itemId, $existingItems)) {
                    continue;
                }
                $data = $this->parsePage($itemId);
                // Requested page is broken
                if ($data === false) continue;
                $data['category_id'] = $category;
                $data['ad_type_id'] = $advType;
                $this->saveItem($data);
//                usleep(100);
            }
        }
    }

    public function run()
    {
        set_time_limit(0);

        $before = $this->getExistingRowsCount('item', ExternalSite::DBA);
        $urlSet = $this->urlsSet();
//        HelperBase::dump($urlSet, true);

        foreach ($urlSet as $topCategory => $dataToBeParsed) {
            foreach ($dataToBeParsed as $category => $data) {
                $baseUrl = $data['url'];
                $advTypes = $data['types'];
                $this->_process($baseUrl, $category, AdType::SELL, $advTypes[AdType::SELL]);
                usleep(100);
                if ($pages = $advTypes[AdType::BUY]) {
                    $this->_process($baseUrl, $category, AdType::BUY, $pages);
                    usleep(100);
                }
                if ($pages = $advTypes[AdType::EXCHANGE]) {
                    $this->_process($baseUrl, $category, AdType::EXCHANGE, $advTypes[AdType::EXCHANGE]);
                    usleep(100);
                }
            }
        }
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

    /**
     * Get subtitle for item. Especially for movies.
     * @param $html
     * @return string
     */
    private function _getMediaTitle($html)
    {
        $pattern = '|<td>\s*Titel\s*</td>\s*<td>([^<]+)</td>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim(preg_replace('|\s+|', ' ', $matches[1]));
        } else {
            return '';
        }
    }

    private function _getMusicArtist($html)
    {
        $pattern = '|<td>\s*Kunstner\s*</td>\s*<td>([^<]+)</td>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim(preg_replace('|\s+|', ' ', $matches[1]));
        } else {
            return '';
        }
    }

    /**
     * Get item genre. Especially for movies.
     * @param $html
     * @return string
     */
    private function _getMediaGenre($html)
    {
        $pattern = '|<td>\s*Genre\s*</td>\s*<td>([^<]+)</td>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim(preg_replace('|\s+|', ' ', $matches[1]));
        } else {
            return '';
        }
    }

    /**
     * Get media item type(dvd/blu-ray). Especially for movies, music, etc.
     * @param $html
     * @return string
     */
    private function _getMediaType($html)
    {
        $pattern = '|<td>\s*Medie\s*</td>\s*<td>([^<]+)</td>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim(preg_replace('|\s+|', ' ', $matches[1]));
        } else {
            return '';
        }
    }

    private function _getMediaProducer($html)
    {
        $pattern = '|<td>\s*Instruktør\s*</td>\s*<td>([^<]+)</td>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim(preg_replace('|\s+|', ' ', $matches[1]));
        } else {
            return '';
        }
    }

    private function _getMediaFeatures($html)
    {
        $pattern = '|<td>\s*Funktioner\s*</td>\s*<td>([^<]+)</td>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim(preg_replace('|\s+|', ' ', $matches[1]));
        } else {
            return '';
        }
    }

    private function _getMediaInches($html)
    {
        $pattern = '|<td>\s*Str.\s*\(tommer\)\s*</td>\s*<td>([^<]+)</td>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim(preg_replace('|\s+|', ' ', $matches[1]));
        } else {
            return '';
        }
    }

    private function _getMediaSize($html)
    {
        $pattern = '|<td>\s*Størrelse\s*</td>\s*<td>([^<]+)</td>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim(preg_replace('|\s+|', ' ', $matches[1]));
        } else {
            return '';
        }
    }

    private function _getEqCapacity($html)
    {
        $pattern = '|<td>\s*Kapacitet\s*\(GB\)\s*</td>\s*<td>([^<]+)</td>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim(preg_replace('|\s+|', ' ', $matches[1]));
        } else {
            return '';
        }
    }

    private function _getHardDiscCapacity($html)
    {
        $pattern = '|<td>\s*Harddisk\s*\(GB\)\s*</td>\s*<td>([^<]+)</td>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim(preg_replace('|\s+|', ' ', $matches[1]));
        } else {
            return '';
        }
    }

    private function _getCameraResolution($html)
    {
        $pattern = '|<td>\s*Opløsning\s*\(megapixels\)\s*</td>\s*<td>([^<]+)</td>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim(preg_replace('|\s+|', ' ', $matches[1]));
        } else {
            return '';
        }
    }

    private function _getOpticalZoom($html)
    {
        $pattern = '|<td>\s*Optisk\s+zoom\s*</td>\s*<td>([^<]+)</td>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim(preg_replace('|\s+|', ' ', $matches[1]));
        } else {
            return '';
        }
    }

    private function _getSpeaker($html)
    {
        $pattern = '|<td>\s*Højttaler\s*</td>\s*<td>([^<]+)</td>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim(preg_replace('|\s+|', ' ', $matches[1]));
        } else {
            return '';
        }
    }

    private function _getSpeakerType($html)
    {
        $pattern = '|<td>\s*Højttalertype\s*</td>\s*<td>([^<]+)</td>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim(preg_replace('|\s+|', ' ', $matches[1]));
        } else {
            return '';
        }
    }

    private function _getChannels($html)
    {
        $pattern = '|<td>\s*Kanaler\s*</td>\s*<td>([^<]+)</td>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim(preg_replace('|\s+|', ' ', $matches[1]));
        } else {
            return '';
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
        $pattern = '|(http://dbastatic.dk/pictures/[^"]+)|is';
//        $pattern = '|<img(.*?)src="http://dbastatic.dk/pictures/[^"]+"\s+alt="\w+">|is';
        preg_match($pattern, $html, $matches);
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
