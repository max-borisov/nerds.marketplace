<?php
namespace app\components\parser;

use Yii;
use yii\base\Component;
use yii\base\Exception;
use app\components\HelperBase;

abstract class Base extends Component
{
    abstract public function parsePage($id);
    abstract public function run();

    /**
     * Fix and prepare html for parsing
     * @param $page Page url
     * @param string $encoding Encoding
     * @param bool $saveToFile Save result html code or not
     * @return \tidy
     */
    public function tidy($page, $encoding = 'latin1', $saveToFile = false)
    {
        $tidy = new \tidy;
        $config = array(
            'indent'         => true,
            'output-xhtml'   => true,
            'wrap'           => 200);
        $tidy->parseString(file_get_contents($page), $config, $encoding);
        $tidy->cleanRepair();

        if ($saveToFile) {
            ob_start();
            echo $tidy;
            $html = ob_get_clean();
            file_put_contents(Yii::getAlias('@app') . '/runtime/parse_html.html', $html);
        }

        return $tidy;
    }

    public function iconv($string)
    {
        return iconv('latin1', 'utf8', $string);
    }

    public function getExistingNews($siteId)
    {
        $data = (new \yii\db\Query())
            ->select('news_id')
            ->from('news')
            ->where('site_id = :sid', ['sid' => $siteId])
            ->all();

        if ($data) {
            $tmp = [];
            foreach ($data as $item) {
                $tmp[] = $item['news_id'];
            }
            $data = $tmp;
        }
        return $data;
    }

    public function getExistingReviews($siteId)
    {
        $data = (new \yii\db\Query())
            ->select('review_id')
            ->from('review')
            ->where('site_id = :site_id', ['site_id' => $siteId])
            ->all();

        if ($data) {
            $tmp = [];
            foreach ($data as $item) {
                $tmp[] = $item['review_id'];
            }
            $data = $tmp;
        }
        return $data;
    }

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

    public function done($parserType = '', $before, $after)
    {
        $time = date('d/m/Y H:i:s');
        $new = $after - $before;
        echo $parserType . " DONE! at $time. Before: $before, after: $after, NEW: $new.\r\n";
    }

    public function getExistingRowsCount($table, $site_id)
    {
        return $data = (new \yii\db\Query())
            ->select('id')
            ->from($table)
            ->where('site_id = :site_id', ['site_id' => $site_id])
            ->count();
    }

    public function parsePageTest($id)
    {
        $data = $this->parsePage($id);
        HelperBase::dump($data);
    }

    public function getMonthsList()
    {
        return
        [
            'januar'    => 1,
            'january'   => 1,
            'februar'   => 2,
            'february'  => 2,

            'marts'     => 3,
            'march'     => 3,

            'april'     => 4,
            'maj'       => 5,
            'juni'      => 6,
            'juli'      => 7,
            'august'    => 8,
            'september' => 9,

            'oktober'   => 10,
            'october'   => 10,
            'okt'       => 10,

            'november'  => 11,
            'nov'       => 11,

            'december'  => 12,
        ];
    }

    public function formatDate($dateStr, $type, $id)
    {
        $months = $this->getMonthsList();

        if (strpos($dateStr, '-') !== false || strpos($dateStr, '+') !== false || strpos($dateStr, ',') !== false) {
            return 0;
        }
        $dateStr = str_replace('.', '', $dateStr);
        $dateStr = preg_replace('|\s+|', ' ', $dateStr);
        $split = explode(' ', $dateStr);
        if (count($split) != 3) {
            return 0;
        }

        $d = (int)trim($split[0]);
        $m = strtolower(trim($split[1]));
        if (!isset($months[$m])) {
            throw new Exception('Invalid month. Month - ' . $m . ". $type id - " . $id);
        }
        $m = (int)$months[$m];
        $y = (int)trim($split[2]);
        if (empty($d) || empty($m) || empty($y)) {
            throw new Exception("Could not parse review post date. $type id " . $id);
        }
        $timestamp = mktime(0, 0, 0, $m, $d, $y);
        return date('Y-m-d', $timestamp);
    }

    protected function _recGetDate($html)
    {
        $pattern = '|<font\s+color="#555555">([^>]+\d{4})[^<]+</font>|is';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            return trim($matches[1]);
        } else {
            return 0;
        }
//        throw new Exception('Could not get date attributes. News id ' . $this->_newsId);
    }
}