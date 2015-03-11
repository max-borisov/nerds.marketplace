<?php
$this->params['isMediaPage'] = true;
echo $this->render('../shared/catalog', [
    'data'  => $data,
    'pages' => $pages,
    'type'  => 'media',
    'url'   => '/media/view/'
]);
?>