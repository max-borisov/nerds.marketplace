<?php
$this->params['isMoviesPage'] = true;
echo $this->render('../shared/catalog', [
    'data'  => $data,
    'pages' => $pages,
    'type'  => 'movies',
    'url'   => '/movies/view/'
]);
?>