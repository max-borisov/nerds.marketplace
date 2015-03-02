<?php
namespace app\components\parser\hifi;

use Yii;
use yii\base\Exception;
use app\components\parser\Base;
use app\models\Category;
use app\models\ExternalSite;
use app\models\AdType;
use app\models\Item;

require_once __DIR__ . '/../Base.php';

class HiFiItems extends Base
{
    private $_baseUrl = 'http://www.hifi4all.dk/ksb/';

    /**
     * Parse page by unique id. Get all necessary info.
     * @param $id Page id
     * @return array Page data
     * @throws \yii\base\Exception
     */
    public function parsePage($id)
    {
        $html = $this->tidy($this->_baseUrl . 'Annonce.asp?id=' . $id);
        $data = [];
        $data['id'] = $id;

        $pattern = '|<td\s+width="604"\s+valign="top">(.*)</td>|is';
        preg_match_all($pattern, $html, $matches);
        $root = $matches[0][0];
        $root = str_replace('</font>', '', $root);
        $root = preg_replace('|<font[^>]+>|is', '', $root);
        $root = str_replace(['<br>', '<br/>', '<br />'], '', $root);
        $root = $this->iconv($root);

        // Item title
        $pattern = '|<td\s+width="90%"\s+background=".*?">\s+<b>(.*?)</b>\s+</td>\s+|isx';
        preg_match_all($pattern, $root, $matches);
        if (isset($matches[1], $matches[1][0])) {
            $data['title'] = trim($matches[1][0]);
            $data['title'] = substr($data['title'], 0, strrpos($data['title'], '-')-1);
        } else {
            throw new Exception('Could not get item title. Page id ' . $id);
        }

        // User name
        $pattern = '|<td\s+width="37%">([^<]+)<a href=(?:.*?)></a>\s+</td>|is';
        preg_match_all($pattern, $root, $matches);
        if (isset($matches[1], $matches[1][0])) {
            $data['user'] = trim($matches[1][0]);
        } else {
            throw new Exception('Could not get user name. Page id ' . $id);
        }

        // Location and phone
        $pattern = '|<td\s+width="37%">(.*?)</td>|is';
        preg_match_all($pattern, $root, $matches);
        if (isset($matches[1], $matches[1][1])) {
            $data['location'] = trim($matches[1][1]);
        } else {
            throw new Exception('Could not get user location. Page id ' . $id);
        }
        if (isset($matches[1], $matches[1][2])) {
            $phone = trim($matches[1][2]);
            if (preg_match('/[a-z]+/', $phone)) {
                $phone = '';
            }
            $data['phone'] = $phone;
        } else {
            throw new Exception('Could not get user phone. Page id ' . $id);
        }

        // Email
        if (isset($matches[1], $matches[1][3])) {
            $emailRaw = $matches[1][3];
            if (strpos($emailRaw, 'Privat') !== false) {
                $email = '';
            } else {
                $emailRaw = strip_tags($emailRaw, '<img>');
                $emailRaw = str_replace('//', '', $emailRaw);
                $pattern = '|[^<]+|is';
                preg_match_all($pattern, $emailRaw, $matches);
                $emailPartName = $matches[0][0];
                $pattern = '|>([\w./]+)|is';
                preg_match_all($pattern, $emailRaw, $matches);
                $emailPartDomain = $matches[0][0];
                $emailPartDomain = str_replace('>', '', $emailPartDomain);
                $email = trim($emailPartName . '@' . $emailPartDomain);
            }
            $data['email'] = $email;
        } else {
            throw new Exception('Could not get user email. Page id ' . $id);
        }

        // Item type, Ad type, pub date
        $pattern = '|<td\s+width="28%">(.*?)</td>|is';
        preg_match_all($pattern, $root, $matches);
        if (isset($matches[1], $matches[1][0])) {
            $data['type'] = trim($matches[1][0]);
        } else {
            throw new Exception('Could not get item type. Page id ' . $id);
        }
        if (isset($matches[1], $matches[1][1])) {
            $data['adv'] = trim($matches[1][1]);
        } else {
            throw new Exception('Could not get advertisement type. Page id ' . $id);
        }
        if (isset($matches[1], $matches[1][2])) {
            $data['date'] = trim($matches[1][2]);
        } else {
            throw new Exception('Could not get pub date. Page id ' . $id);
        }

        // Price
        $pattern = '|<b>[\w./\s]*pris:\s+(\d+)(?:&nbsp;)?DKK</b>|is';
        preg_match_all($pattern, $root, $matches);
        if (empty($matches[0])) {
            $price = 0;
        } else {
            $price = $matches[1][0];
        }
        $data['price'] = $price;

        // Description
        $pattern = '|<td\s+width="100%"\s+valign="top">([^<]+)</td>|is';
        preg_match_all($pattern, $root, $matches);
        if (empty($matches[0])) {
            $description = '';
        } else {
            $description = trim($matches[1][0]);
            $description = preg_replace('/\s+/', ' ', $description);

        }
        $data['description'] = $description;

        // Preview
        $pattern = '|src="(pics/.*?)"\s+alt=|is';
        preg_match_all($pattern, $root, $matches);
        if (empty($matches[0])) {
            $preview = '';
        } else {
            $preview = $matches[1][0];
        }
        $data['preview'] = $preview;

        // Additional info
        $pattern = '|<td\s+height="16">(.*?)</td>|is';
        preg_match_all($pattern, $root, $matches);
        $addInfo = [
            'age'       => trim($matches[1][0]),
            'warranty'  => trim($matches[1][1]),
            'package'   => trim($matches[1][2]),
            'delivery'  => trim($matches[1][3]),
            'ack'       => trim($matches[1][4]),
            'manual'    => trim($matches[1][5]),
            'expires'   => trim($matches[1][6]),
        ];
        $data['info'] = $addInfo;

        return $data;
    }

    /**
     * Parse catalog to get links to items pages
     * @param $offset Offset to catalog pager
     * @return mixed
     * @throws \yii\base\Exception
     */
    public function getCatalogLinks($offset)
    {
        $html = $this->tidy($this->_baseUrl . 'index.asp?offset=' . $offset);
        $data = [];
        $pattern = '|<td\s+width="224">(?:.*?)(\d+)(?:.*?)</td>|is';
        preg_match_all($pattern, $html, $matches);
        if (empty($matches[1])) {
            throw new Exception('Could not retrieve data.');
        }

        return array_unique($matches[1]);
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
        $item->category_id  = Category::HIFI4ALL;
        $item->ad_type_id   = AdType::UNKNOWN;

        $item->site_id      = ExternalSite::HIFI4ALL;
        $item->title        = $data['title'];
        $item->s_item_id    = $data['id'];
        $item->s_user       = $data['user'];
        $item->s_location   = $data['location'];
        $item->s_phone      = $data['phone'];
        $item->s_email      = $data['email'];
        $item->s_type       = $data['type'];
        $item->s_adv        = $data['adv'];
        $item->s_date       = date('Y-m-d', strtotime($data['date'])); // Convert date to Y-m-d format
        $item->price        = $data['price'];
        $item->description  = $data['description'];
        $item->s_preview    = $data['preview'];
        $item->s_age        = $data['info']['age'];
        $item->s_warranty   = $data['info']['warranty'];
        $item->s_package    = $data['info']['package'];
        $item->s_delivery   = $data['info']['delivery'];
        $item->s_akn        = $data['info']['ack'];
        $item->s_manual     = $data['info']['manual'];
        $item->s_expires    = $data['info']['expires'];

        if (strpos($item->s_warranty, 'Ja') !== false) {
            $item->warranty = 1;
        }

        if (strpos($item->s_package, 'ikke') !== false
            || strpos($item->s_package, 'betydning') !== false
            || strpos($item->s_package, 'nskeligt') !== false) {
        $item->packaging = 0;
        } else {
            $item->packaging = 1;
        }

        if (strpos($item->s_manual, 'ikke') !== false
            || strpos($item->s_manual, 'betydning') !== false
            || strpos($item->s_manual, 'nskeligt') !== false) {
            $item->manual = 0;
        } else {
            $item->manual = 1;
        }

        if (strpos($item->s_adv, 'LGES') !== false) {
            $item->ad_type_id = AdType::SELL;
        } elseif (strpos($item->s_adv, 'BES') !== false) {
            $item->ad_type_id = AdType::BUY;
        } elseif (strpos($item->s_adv, 'BYTTES') !== false) {
            $item->ad_type_id = AdType::EXCHANGE;
        }

        if (!$item->save(false)) {
            throw new Exception('Data could not be saved. Id ' . $data['site_id']);
        }
        return $item->id;
    }

    /**
     * Process catalog page
     * @param $ids
     * @param $existingRows
     */
    private function _parsePageAndSave($ids, $existingRows)
    {
        foreach ($ids as $itemId) {
            if (in_array($itemId, $existingRows)) continue;
            $data = $this->parsePage($itemId);
            $this->saveItem($data);
            usleep(1000);
        }
    }

    /**
     * Get items from database to prevent adding the same data
     * @param integer $siteId Site the data were fetched from
     * @return array
     */
    public function getExistingItems($siteId)
    {
        $data = (new \yii\db\Query())
            ->select('s_item_id')
            ->from('item')
            ->where('site_id = :site_id', ['site_id' => $siteId])
            ->all();

        if ($data) {
            $tmp = [];
            foreach ($data as $item) {
                $tmp[] = $item['s_item_id'];
            }
            $data = $tmp;
        }
        return $data;
    }

    /**
     * Get info from all pages and save it
     */
    public function run()
    {
        set_time_limit(0);

        $before = $this->getExistingRowsCount('item', ExternalSite::HIFI4ALL);
        $baseOffset = 53;
        $offset = 0;
        for ($i=0; $i <= 20; $i++) {
            $existingItems = $this->getExistingItems(ExternalSite::HIFI4ALL);
            $ids = $this->getCatalogLinks($offset);
            $this->_parsePageAndSave($ids, $existingItems);
            $offset += $baseOffset;
//            break;
        }
        $after = $this->getExistingRowsCount('item', ExternalSite::HIFI4ALL);
        $this->done('HiFiItems', $before, $after);
    }
}