<?php
$this->params['isNewsPage'] = true;
echo $this->render('../shared/catalog', [
    'data'  => $data,
    'pages' => $pages,
    'type'  => 'news',
    'url'   => '/games/view/'
]);
?>