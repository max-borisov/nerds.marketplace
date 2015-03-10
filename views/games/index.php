<?php
$this->params['isGamesPage'] = true;
echo $this->render('../shared/catalog', [
    'data'  => $data,
    'pages' => $pages,
    'type'  => 'games',
    'url'   => '/games/view/'
]);
?>