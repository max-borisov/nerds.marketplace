<?php
namespace app\components;

use app\models\Category;
use app\models\ExternalSite;
use app\models\UsedItemType;
use Yii;
use yii\base\Component;
use yii\base\Exception;
use app\models\UsedItem;

class HiFi4AllParser extends Component
{
    /**
     * Fix and prepare html for parsing
     * @param $page Page url
     * @param bool $saveToFile Save result html code or not
     * @return \tidy
     */
    private static function tidy($page, $saveToFile = false)
    {
        $tidy = new \tidy;
        $config = array(
            'indent'         => true,
            'output-xhtml'   => true,
            'wrap'           => 200);
        $tidy->parseString(file_get_contents($page), $config, 'latin1');
        $tidy->cleanRepair();

        if ($saveToFile) {
            ob_start();
                echo $tidy;
            $html = ob_get_clean();
            file_put_contents(Yii::getAlias('@app') . '/runtime/parse_html.html', $html);
        }

        return $tidy;
    }

    /**
     * Parse page by unique id. Get all necessary info.
     * @param $id Page id
     * @return array Page data
     * @throws \yii\base\Exception
     */
    public static function parsePage($id)
    {
        $html = self::tidy('http://www.hifi4all.dk/ksb/Annonce.asp?id=' . $id);
        $data = [];
        $data['id'] = $id;

        $pattern = '|<td\s+width="604"\s+valign="top">(.*)</td>|is';
        preg_match_all($pattern, $html, $matches);
        $root = $matches[0][0];
        $root = str_replace('</font>', '', $root);
        $root = preg_replace('|<font[^>]+>|is', '', $root);
        $root = str_replace(['<br>', '<br/>', '<br />'], '', $root);
        $root = self::iconv($root);

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
    public static function getLinks($offset)
    {
        $html = self::tidy('http://www.hifi4all.dk/ksb/index.asp?offset=' . $offset);
        $data = [];
        $pattern = '|<td\s+width="224">(?:.*?)(\d+)(?:.*?)</td>|is';
        preg_match_all($pattern, $html, $matches);
        if (empty($matches[1])) {
            throw new Exception('Could not retrieve data.');
        }

        return $matches[1];
    }

    /**
     * Save parsed item data to the database
     * @param $data
     * @return int
     * @throws \yii\base\Exception
     */
    public static function saveItem($data)
    {
        $item = new UsedItem();
        $item->user_id      = 112233;
        $item->category_id  = Category::HIFI4ALL;
        $item->type_id      = UsedItemType::UNKNOWN;

        $item->s_id         = ExternalSite::HIFI4ALL;
        $item->title        = $data['title'];
        $item->s_item_id    = $data['id'];
        $item->s_user       = $data['user'];
        $item->s_location   = $data['location'];
        $item->s_phone      = $data['phone'];
        $item->s_email      = $data['email'];
        $item->s_type       = $data['type'];
        $item->s_adv        = $data['adv'];
        $item->s_date       = $data['date'];
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
            $item->type_id = UsedItemType::SELL;
        } elseif (strpos($item->s_adv, 'BES') !== false) {
            $item->type_id = UsedItemType::BUY;
        } elseif (strpos($item->s_adv, 'BYTTES') !== false) {
            $item->type_id = UsedItemType::EXCHANGE;
        }

        if (!$item->save(false)) {
            throw new Exception('Data could not be saved. Id ' . $data['s_id']);
        }
        return $item->id;
    }

    /**
     * Get items from database to prevent adding the same data
     * @param $siteId Site the data were fetched from
     * @return array
     */
    public static function getExistingRows($siteId)
    {
        $data = (new \yii\db\Query())
            ->select('s_item_id')
            ->from('_used_item')
            ->where('s_id = :sid', ['sid' => $siteId])
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
     * Process catalog page
     * @param $ids
     * @param $existingRows
     */
    private static function _parsePageAndSave($ids, $existingRows)
    {
        foreach ($ids as $itemId) {
            if (in_array($itemId, $existingRows)) continue;
            $data = self::parsePage($itemId);
            self::saveItem($data);
            usleep(300000);
        }
    }

    public static function iconv($string)
    {
        return iconv('latin1', 'utf8', $string);
    }

    /**
     * Get info from all pages and save it
     */
    public static function copyData()
    {
        set_time_limit(0);

        $existingRows = self::getExistingRows(ExternalSite::HIFI4ALL);
        $baseOffset = 53;
        $offset = 0;
        for ($i=0; $i <= 17; $i++) {
            $ids = self::getLinks($offset);
            self::_parsePageAndSave($ids, $existingRows);
            $offset += $baseOffset;
//            break;
        }
        echo "Done!\r\n";
    }
}