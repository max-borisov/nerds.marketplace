<?php
$this->params['isRadioPage'] = true;
echo $this->render('../shared/articleView', [
    'backLink'  => '/radio',
    'data'      => $radio
]);
?>