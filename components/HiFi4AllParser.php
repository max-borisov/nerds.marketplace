<?php
namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\Exception;

class HiFi4AllParser extends Component
{
    private static function tidy($page, $saveToFile = false)
    {
        $tidy = new \tidy;
        $config = array(
            'indent'         => true,
            'output-xhtml'   => true,
            'wrap'           => 200);
        $tidy->parseString(file_get_contents($page), $config, 'utf8');
        $tidy->cleanRepair();

        if ($saveToFile) {
            ob_start();
                echo $tidy;
            $html = ob_get_clean();
            file_put_contents(Yii::getAlias('@app') . '/runtime/parse_html.html', $html);
        }

        return $tidy;
    }

    public static function parsePage($id)
    {
        $html = self::tidy('http://www.hifi4all.dk/ksb/Annonce.asp?id=' . $id);
        $data = [];
        $data['id'] = $id;

        $pattern = '|<td\s+width="604"\s+valign="top">(.*)</td>|is';
        preg_match_all($pattern, $html, $matches);
        $root = $matches[0][0];

//        $root = mb_convert_encoding($root, 'UTF-8');
//        HelperBase::dump($root, true);
        /*echo $root = preg_replace(
            ['/æ/', '/ø/', '/å/', '/Æ/', '/Ø/', '/Å/'],
            ['&aelig;', '&oslash;', '&aring;', '&AElig;', '&Oslash;', '&Aring;'],
            $root
        );*/

        $root = str_replace('</font>', '', $root);
        $root = preg_replace('|<font[^>]+>|is', '', $root);
        $root = str_replace(['<br>', '<br/>', '<br />'], '', $root);

        // Item title
        $pattern = '|<td\s+width="90%"\s+background=".*?">\s+<b>(.*?)</b>\s+</td>\s+|isx';
        preg_match_all($pattern, $root, $matches);
        if (isset($matches[1], $matches[1][0])) {
//            $title = iconv('ISO-8859-1', 'UTF-8//IGNORE', $matches[1][0]);
//            $title = utf8_encode($matches[1][0]);
//            $title = mb_convert_encoding($matches[1][0], 'UTF-8');
//            $data['title'] = trim($title);
            $data['title'] = trim($matches[1][0]);
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
            $price = '';
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

    public static function getLinks($offset)
    {
        set_time_limit(0);

        $html = self::tidy('http://www.hifi4all.dk/ksb/index.asp');
        $data = [];

        $pattern = '|<td\s+width="224">(?:.*?)(\d+)(?:.*?)</td>|is';
        preg_match_all($pattern, $html, $matches);

        if (empty($matches[1])) {
            throw new Exception('Could not retrieve data.');
        }

        HelperBase::dump(count($matches[1]));

        foreach ($matches[1] as $itemId) {
//            echo $itemId, '<br>';
            $data = self::parsePage($itemId);
            HelperBase::dump($data);
            sleep(1);
        }

//        HelperBase::dump($matches);
//        $root = $matches[0][0];
//        $ids = $matches[1];
    }
}