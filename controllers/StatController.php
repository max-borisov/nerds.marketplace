<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers;
use app\models\Item;
use app\models\News;
use app\models\Review;
use app\models\ExternalSite;
use app\controllers\AppController;
use app\components\HelperBase;

class StatController extends AppController
{
    public function actionIndex()
    {
        $itemsHiFi      = (new Item)->count('site_id = ' . ExternalSite::HIFI4ALL);
        $itemsDba       = (new Item)->count('site_id = ' . ExternalSite::DBA);
        $newsHiFi       = (new News())->count('site_id = ' . ExternalSite::HIFI4ALL);
        $newsRec        = (new News())->count('site_id = ' . ExternalSite::RECORDERE);
        $reviewsHiFi    = (new Review())->count('site_id = ' . ExternalSite::HIFI4ALL);
        $reviewsRec     = (new Review())->count('site_id = ' . ExternalSite::RECORDERE);
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
            'itemsTotal'    => $itemsTotal,
            'newsTotal'     => $newsTotal,
            'reviewsTotal'  => $reviewsTotal,
        ];

        return $this->render('index', ['data' => $data]);
    }
}
