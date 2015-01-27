<?php

use yii\widgets\LinkPager;
use app\components\HelperBase;

// display pagination
echo LinkPager::widget([
    'pagination' => $pages,
    'maxButtonCount' => HelperBase::getParam('linkPagerMaxButtonCount')
]);