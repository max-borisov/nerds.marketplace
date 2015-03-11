<?php
namespace app\components\parser\recordere;

use Yii;
use app\models\Music;
use app\models\ExternalSite;
use yii\base\Exception;

require_once __DIR__ . '/RecBase.php';

class RecMusic extends RecBase
{
    protected $_catalogUrl  = 'http://recordere.dk/musik/';
    protected $_baseUrl     = 'http://www.recordere.dk/indhold/templates/design.aspx?articleid=';

    public function saveItem($data)
    {
        $item = $this->_beforeSave((new Music), $data);
        if ($item->save(false)) {
            return $item->id;
        } else {
            throw new Exception('Music data could not be saved. Music id ' . $data['id']);
        }
    }

    public function run()
    {
        set_time_limit(0);
        $before = $this->getExistingRowsCount('music', ExternalSite::RECORDERE);
        $catalogLinks = $this->getCatalogLinks();
        $existingArticles = $this->getExistingArticles('music', ExternalSite::RECORDERE);
        $this->_processAndSave($catalogLinks, $existingArticles, 'Music');
        $after = $this->getExistingRowsCount('music', ExternalSite::RECORDERE);
        $this->done('Music', $before, $after);
    }
}