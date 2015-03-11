<?php
$this->params['isTvPage'] = true;
echo $this->render('../shared/catalog', [
    'data'  => $data,
    'pages' => $pages,
    'type'  => 'tv',
    'url'   => '/tv/view/'
]);
?>