<?php
namespace app\components\parser\recordere;

use Yii;
use app\models\Radio;
use app\models\ExternalSite;
use yii\base\Exception;

require_once __DIR__ . '/RecBase.php';

class RecRadio extends RecBase
{
    protected $_catalogUrl  = 'http://www.recordere.dk/radio/';
    protected $_baseUrl     = 'http://www.recordere.dk/indhold/templates/design.aspx?articleid=';

    public function saveItem($data)
    {
        $item = $this->_beforeSave((new Radio()), $data);
        if ($item->save(false)) {
            return $item->id;
        } else {
            throw new Exception('Radio data could not be saved. Radio id ' . $data['id']);
        }
    }

    public function run()
    {
        set_time_limit(0);
        $before = $this->getExistingRowsCount('radio', ExternalSite::RECORDERE);
        $catalogLinks = $this->getCatalogLinks();
        $existingArticles = $this->getExistingArticles('radio', ExternalSite::RECORDERE);
        $this->_processAndSave($catalogLinks, $existingArticles, 'Radio');
        $after = $this->getExistingRowsCount('radio', ExternalSite::RECORDERE);
        $this->done('Radio', $before, $after);
    }
}