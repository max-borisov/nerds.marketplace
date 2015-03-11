<?php
$this->params['isTVPage'] = true;
echo $this->render('../shared/catalog', [
    'data'  => $data,
    'pages' => $pages,
    'type'  => 'tv',
    'url'   => '/tv/view/'
]);
?>