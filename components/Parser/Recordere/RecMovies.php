<?php
namespace app\components\parser\recordere;

use Yii;
use app\models\Movie;
use app\models\ExternalSite;
use yii\base\Exception;

require_once __DIR__ . '/RecBase.php';

class RecMovies extends RecBase
{
    protected $_catalogUrl  = 'http://www.recordere.dk/film/';
    protected $_baseUrl     = 'http://www.recordere.dk/indhold/templates/design.aspx?articleid=';

    public function saveItem($data)
    {
        $item = $this->_beforeSave((new Movie()), $data);
        if ($item->save(false)) {
            return $item->id;
        } else {
            throw new Exception('Movie data could not be saved. Movie id ' . $data['id']);
        }
    }

    public function run()
    {
        set_time_limit(0);
        $before = $this->getExistingRowsCount('movie', ExternalSite::RECORDERE);
        $catalogLinks = $this->getCatalogLinks();
        $existingArticles = $this->getExistingArticles('movie', ExternalSite::RECORDERE);
        $this->_processAndSave($catalogLinks, $existingArticles, 'Movie');
        $after = $this->getExistingRowsCount('movie', ExternalSite::RECORDERE);
        $this->done('Movies', $before, $after);
    }
}