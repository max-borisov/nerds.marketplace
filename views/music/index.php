<?php
$this->params['isMusicPage'] = true;
echo $this->render('../shared/catalog', [
    'data'  => $data,
    'pages' => $pages,
    'type'  => 'music',
    'url'   => '/music/view/'
]);
?>