<?php
namespace app\components\recordere;

use Yii;
use yii\base\Component;

abstract class RecordereBase extends Component
{
    abstract public function parsePage($id);
    abstract public function getExistingRecords($siteId);
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
}