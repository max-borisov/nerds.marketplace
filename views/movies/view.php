<?php
$this->params['isMoviesPage'] = true;
echo $this->render('../shared/articleView', [
    'backLink'  => '/movies',
    'data'      => $movies
]);
?>