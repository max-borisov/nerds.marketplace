<?php
namespace app\components;

use Yii;
use yii\base\Component;

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

    public static function parse($id)
    {
        $html = self::tidy('http://www.hifi4all.dk/ksb/Annonce.asp?id=' . $id);
        $data = [];

        $pattern = '|<td\s+width="604"\s+valign="top">(.*)</td>|is';
        preg_match_all($pattern, $html, $matches);
        $root = $matches[0][0];

        // Item title
        $pattern = '|<td\s+width="90%"\s+background=".*?">\s+<b>(.*?)</b>\s+</td>\s+|isx';
        preg_match_all($pattern, $root, $matches);
        $title = $matches[1][0];
        $data['title'] = $title;

        // User name
        $pattern = '|<td\s+width="37%">([\w\s./]+)<a href=(?:.*?)></a>\s+</td>|is';
        preg_match_all($pattern, $root, $matches);
        $userName = $matches[1][0];
        $data['user'] = trim($userName);

        // Location and phone
        $pattern = '|<td\s+width="37%">(.*?)</td>|is';
        preg_match_all($pattern, $root, $matches);

        $location = $matches[1][1];
        $data['location'] = trim($location);
        $phone = $matches[1][2];
        $data['phone'] = trim($phone);

        // Email
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

        // Item type, Ad type, pub date
        $pattern = '|<td\s+width="28%">(.*?)</td>|is';
        preg_match_all($pattern, $root, $matches);
        $itemType = trim($matches[1][0]);
        $data['type'] = $itemType;
        $adType = trim($matches[1][1]);
        $data['ad'] = $adType;
        $pubDate = trim($matches[1][2]);
        $data['date'] = $pubDate;

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
}