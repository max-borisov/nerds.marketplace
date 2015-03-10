<?php
namespace app\components\parser\recordere;

use Yii;
use app\models\Review;
use app\models\ReviewType;
use app\components\parser\Base;
use app\models\ExternalSite;
use app\components\HelperBase;
use yii\base\Exception;

require_once __DIR__ . '/RecBase.php';

class RecReviews extends RecBase
{
    protected $_baseUrl = 'http://www.recordere.dk/indhold/templates/design.aspx?articleid=';
    protected $_catalogUrl = 'http://www.recordere.dk/anmeldelser/';

    public function saveItem($data)
    {
        $item = $this->_beforeSaveNewsReviews((new Review), $data);
        $item->review_id        = $data['id'];
        $item->review_type_id   = ReviewType::UNKNOWN;
        if ($item->save(false)) {
            return $item->id;
        } else {
            throw new Exception('Review data could not be saved. Review id ' . $data['id']);
        }
    }

    public function run()
    {
        set_time_limit(0);
        $before = $this->getExistingRowsCount('review', ExternalSite::RECORDERE);
        $catalogLinks = $this->getCatalogLinks();
        $existingReviews = $this->getExistingReviews(ExternalSite::RECORDERE);
        $this->_processAndSave($catalogLinks, $existingReviews, 'Reviews');
        $after = $this->getExistingRowsCount('review', ExternalSite::RECORDERE);
        $this->done('RecReviews', $before, $after);
    }
}