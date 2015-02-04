<?php
namespace app\components\parser;

use Yii;
use yii\base\Component;
use app\components\HelperBase;

abstract class Base extends Component
{
    abstract public function parsePage($id);
    abstract public function run();

    /**
     * Fix and prepare html for parsing
     * @param $page Page url
     * @param bool $saveToFile Save result html code or not
     * @return \tidy
     */
    public function tidy($page, $saveToFile = false)
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

    public function iconv($string)
    {
        return iconv('latin1', 'utf8', $string);
    }

    public function getExistingNews($siteId)
    {
        $data = (new \yii\db\Query())
            ->select('news_id')
            ->from('_news')
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
            ->from('_reviews')
            ->where('site_id = :sid', ['sid' => $siteId])
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
}