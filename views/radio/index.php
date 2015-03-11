<?php
$this->params['isRadioPage'] = true;
echo $this->render('../shared/catalog', [
    'data'  => $data,
    'pages' => $pages,
    'type'  => 'radio',
    'url'   => '/radio/view/'
]);
?>