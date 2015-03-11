<?php

namespace app\controllers;

use Yii;
use yii\helpers;
use app\models\Item;
use app\models\News;
use app\models\Review;
use app\models\Game;
use app\models\Tv;
use app\models\Music;
use app\models\Movie;
use app\models\Media;
use app\models\Radio;
use app\models\ExternalSite;

class StatController extends \app\controllers\AppController
{
    public function actionIndex()
    {
        $itemsHiFi      = (new Item)->count('site_id = ' . ExternalSite::HIFI4ALL);
        $itemsDba       = (new Item)->count('site_id = ' . ExternalSite::DBA);
        $newsHiFi       = (new News())->count('site_id = ' . ExternalSite::HIFI4ALL);
        $newsRec        = (new News())->count('site_id = ' . ExternalSite::RECORDERE);
        $reviewsHiFi    = (new Review())->count('site_id = ' . ExternalSite::HIFI4ALL);
        $reviewsRec     = (new Review())->count('site_id = ' . ExternalSite::RECORDERE);

        $gamesRec   = (new Game())->count('site_id = ' . ExternalSite::RECORDERE);
        $tvRec      = (new Tv())->count('site_id = ' . ExternalSite::RECORDERE);
        $musicRec   = (new Music())->count('site_id = ' . ExternalSite::RECORDERE);
        $moviesRec  = (new Movie())->count('site_id = ' . ExternalSite::RECORDERE);
        $mediaRec   = (new Media())->count('site_id = ' . ExternalSite::RECORDERE);
        $radioRec   = (new Radio())->count('site_id = ' . ExternalSite::RECORDERE);

        $itemsTotal     = $itemsHiFi + $itemsDba;
        $newsTotal      = $newsHiFi + $newsRec;
        $reviewsTotal   = $reviewsHiFi + $reviewsRec;
        $data = [
            'itemsHiFi'     => $itemsHiFi,
            'itemsDba'      => $itemsDba,
            'newsHiFi'      => $newsHiFi,
            'newsRec'       => $newsRec,
            'reviewsHiFi'   => $reviewsHiFi,
            'reviewsRec'    => $reviewsRec,

            'gamesRec'     => $gamesRec,
            'tvRec'        => $tvRec,
            'musicRec'     => $musicRec,
            'moviesRec'    => $moviesRec,
            'mediaRec'     => $mediaRec,
            'radioRec'     => $radioRec,

            'itemsTotal'    => $itemsTotal,
            'newsTotal'     => $newsTotal,
            'reviewsTotal'  => $reviewsTotal,
        ];

        return $this->render('index', ['data' => $data]);
    }
}
