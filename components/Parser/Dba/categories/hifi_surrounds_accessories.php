<?php

use app\models\Category;
use app\models\AdType;

return [
    Category::SURROUND_SPEAKERS_SUBWOOFERS => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/hi-fi-surround-og-tilbehoer/surroundhoejttalere-og-subwoofere/',
        'types' => [
            AdType::SELL      => 43,
            AdType::BUY       => 1,
            AdType::EXCHANGE  => 1,
        ]
    ],
    Category::SURROUND_SYSTEMS => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/hi-fi-surround-og-tilbehoer/surroundsystemer/',
        'types' => [
            AdType::SELL      => 40,
            AdType::BUY       => 1,
            AdType::EXCHANGE  => 1,
        ]
    ],
    Category::SURROUND_AMPLIFIERS => [
        'url'   => 'http://www.dba.dk/billede-og-lyd/hi-fi-surround-og-tilbehoer/surroundforstaerkere/',
        'types' => [
            AdType::SELL      => 26,
            AdType::BUY       => 1,
            AdType::EXCHANGE  => 0,
        ]
    ],
];

?>