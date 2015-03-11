<?php
$this->params['isMediaPage'] = true;
echo $this->render('../shared/articleView', [
    'backLink'  => '/media',
    'data'      => $media
]);
?>