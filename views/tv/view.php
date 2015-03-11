<?php
$this->params['isTvPage'] = true;
echo $this->render('../shared/articleView', [
    'backLink'  => '/tv',
    'data'      => $tv
]);
?>