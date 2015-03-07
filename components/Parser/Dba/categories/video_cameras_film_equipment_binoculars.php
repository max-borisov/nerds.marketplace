<?php

use app\models\TopCategory;
use app\models\Category;

return $data = [
    'top' => TopCategory::VIDEO_CAM_FILM_EQUIPMENT_BINOCULARS,
    'sub' => [
        Category::CAM_RECORDERS_EQUIPMENT => [
            'url'   => 'http://www.dba.dk/billede-og-lyd/videokameraer-smalfilmsudstyr-og-kikkerter/videokameraer-og-udstyr/',
            'types' => [
                AdType::SELL      => 55,
                AdType::BUY       => 2,
                AdType::EXCHANGE  => 1,
            ]
        ],
        Category::BINOCULARS => [
            'url'   => 'http://www.dba.dk/billede-og-lyd/videokameraer-smalfilmsudstyr-og-kikkerter/kikkerter-mv/',
            'types' => [
                AdType::SELL      => 15,
                AdType::BUY       => 1,
                AdType::EXCHANGE  => 0,
            ]
        ],
        Category::CINE_EQUIPMENT => [
            'url'   => 'http://www.dba.dk/billede-og-lyd/videokameraer-smalfilmsudstyr-og-kikkerter/smalfilmsudstyr/',
            'types' => [
                AdType::SELL      => 9,
                AdType::BUY       => 1,
                AdType::EXCHANGE  => 1,
            ]
        ],
    ]
];

?>