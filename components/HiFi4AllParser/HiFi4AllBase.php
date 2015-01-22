<?php
namespace app\components\hifi4all;

use Yii;
use yii\base\Component;

abstract class HiFi4AllBase extends Component
{
    abstract public function parsePage($id);
    abstract public function saveItem($data);
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

    /**
     * Get items from database to prevent adding the same data
     * @param integer $siteId Site the data were fetched from
     * @param integer $recordType Record type: news, review, item...
     * @return array
     */
    public function getExistingRecords($siteId, $recordType = 0)
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

    public function iconv($string)
    {
        return iconv('latin1', 'utf8', $string);
    }
}