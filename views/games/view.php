<?php
$this->params['isGamesPage'] = true;
echo $this->render('../shared/articleView', [
    'backLink'  => '/reviews',
    'data'      => $game
]);
?>