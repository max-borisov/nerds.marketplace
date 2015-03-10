<?php
namespace app\components\parser\recordere;

use Yii;
use app\models\Game;
use app\models\ExternalSite;
use app\components\HelperBase;
use yii\base\Exception;

require_once __DIR__ . '/RecBase.php';

class RecGames extends RecBase
{
    protected $_catalogUrl = 'http://www.recordere.dk/spil/';
    protected $_baseUrl = 'http://www.recordere.dk/indhold/templates/design.aspx?articleid=';

    public function saveItem($data)
    {
        $item = $this->_beforeSave((new Game), $data);
        if ($item->save(false)) {
            return $item->id;
        } else {
            throw new Exception('Game data could not be saved. Game id ' . $data['id']);
        }
    }

    public function run()
    {
        set_time_limit(0);
        $before = $this->getExistingRowsCount('game', ExternalSite::RECORDERE);
        $catalogLinks = $this->getCatalogLinks();
        $existingArticles = $this->getExistingArticles('game', ExternalSite::RECORDERE);
        $this->_processAndSave($catalogLinks, $existingArticles, 'Games');
        $after = $this->getExistingRowsCount('game', ExternalSite::RECORDERE);
        $this->done('Games', $before, $after);
    }
}