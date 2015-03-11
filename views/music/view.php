<?php
$this->params['isMusicPage'] = true;
echo $this->render('../shared/articleView', [
    'backLink'  => '/music',
    'data'      => $music
]);
?>