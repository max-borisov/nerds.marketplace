<?php
namespace app\components\parser\recordere;

use Yii;
use app\models\ExternalSite;
use app\models\News;
use yii\base\Exception;
use app\components\HelperBase;

require_once __DIR__ . '/RecBase.php';

class RecNews extends RecBase
{
    protected $_baseUrl = 'http://www.recordere.dk/indhold/templates/design.aspx?articleid=';
    protected $_catalogUrl = 'http://www.recordere.dk/nyheder/';
    private $_prevCatalogUrl = 'http://www.recordere.dk/nyheder/nyhedsliste.aspx';

    public function saveItem($data)
    {
        $item = $this->_beforeSaveNewsReviews((new News()), $data);
        $item->news_id      = $data['id'];
        if ($item->save(false)) {
            return $item->id;
        } else {
            throw new Exception('News data could not be saved. News id ' . $data['id']);
        }
    }

    public function getPrevCatalogLinks()
    {
        $html = $this->tidy($this->_prevCatalogUrl);
        $pattern = '|/?a=(\d+)|is';
        preg_match_all($pattern, $html, $matches);
        if (isset($matches[1])) {
            return array_unique($matches[1]);
        } else {
            throw new Exception('Could not retrieve news ids from previous catalog page.');
        }
    }

    public function getCatalogLinks()
    {
        $catalogLinks = parent::getCatalogLinks();
        $prevCatalogLinks = $this->getPrevCatalogLinks();
        $allLinks = array_merge($catalogLinks, $prevCatalogLinks);
        return array_unique($allLinks);
    }

    public function run()
    {
        set_time_limit(0);
        $before = $this->getExistingRowsCount('news', ExternalSite::RECORDERE);
        $catalogLinks = $this->getCatalogLinks();
        $existingNews = $this->getExistingNews(ExternalSite::RECORDERE);
        $this->_processAndSave($catalogLinks, $existingNews, 'News');
        $after = $this->getExistingRowsCount('news', ExternalSite::RECORDERE);
        $this->done('RecNews', $before, $after);
    }
}