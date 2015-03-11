<?php
namespace app\components\parser\recordere;

use Yii;
use app\models\Tv;
use app\models\ExternalSite;
use app\components\HelperBase;
use yii\base\Exception;

require_once __DIR__ . '/RecBase.php';

class RecTv extends RecBase
{
    protected $_catalogUrl = 'http://recordere.dk/tv/';
    protected $_baseUrl = 'http://www.recordere.dk/indhold/templates/design.aspx?articleid=';

    public function saveItem($data)
    {
        $item = $this->_beforeSave((new Tv), $data);
        if ($item->save(false)) {
            return $item->id;
        } else {
            throw new Exception('Tv data could not be saved. Tv id ' . $data['id']);
        }
    }

    public function run()
    {
        set_time_limit(0);
        $before = $this->getExistingRowsCount('tv', ExternalSite::RECORDERE);
        $catalogLinks = $this->getCatalogLinks();
        $existingArticles = $this->getExistingArticles('tv', ExternalSite::RECORDERE);
        $this->_processAndSave($catalogLinks, $existingArticles, 'Tv');
        $after = $this->getExistingRowsCount('tv', ExternalSite::RECORDERE);
        $this->done('Tv', $before, $after);
    }
}