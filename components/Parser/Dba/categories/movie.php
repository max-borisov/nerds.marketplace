<?php

use app\models\Category;
use app\models\AdType;

return [
    Category::DVD_BLU_RAY_MOVIE => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/film/dvd-film-og-blu-ray/',
        'types' => [
            AdType::SELL      => 192,
            AdType::BUY       => 7,
            AdType::EXCHANGE  => 1,
        ]
    ],
    Category::VIDEO_FILM => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/film/videofilm/',
        'types' => [
            AdType::SELL      => 78,
            AdType::BUY       => 2,
            AdType::EXCHANGE  => 1,
        ]
    ]
];

?>