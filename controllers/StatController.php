<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers;
use app\models\UsedItem;
use app\models\News;
use app\models\Reviews;
use app\models\ExternalSite;
use app\components\HelperBase;

class StatController extends Controller
{
    public $layout = 'marketplace';

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $items          = (new UsedItem)->count();
        $newsHiFi       = (new News())->count('site_id = ' . ExternalSite::HIFI4ALL);
        $newsRec        = (new News())->count('site_id = ' . ExternalSite::RECORDERE);
        $reviewsHiFi    = (new Reviews())->count('site_id = ' . ExternalSite::HIFI4ALL);
        $reviewsRec     = (new Reviews())->count('site_id = ' . ExternalSite::RECORDERE);
        $newsTotal      = $newsHiFi + $newsRec;
        $reviewsTotal   = $reviewsHiFi + $reviewsRec;
        $data = [
            'items'         => $items,
            'newsHiFi'      => $newsHiFi,
            'newsRec'       => $newsRec,
            'reviewsHiFi'   => $reviewsHiFi,
            'reviewsRec'    => $reviewsRec,
            'itemsTotal'    => $items,
            'newsTotal'     => $newsTotal,
            'reviewsTotal'  => $reviewsTotal,
        ];

        return $this->render('index', ['data' => $data]);
    }
}
