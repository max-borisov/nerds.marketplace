<?php
$this->params['isTVPage'] = true;
echo $this->render('../shared/articleView', [
    'backLink'  => '/tv',
    'data'      => $tv
]);
?>