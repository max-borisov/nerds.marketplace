<?php
/* @var $data app\models\UsedItem */
/* @var $this \yii\web\View */

use yii\helpers\Html;
?>

<!--Prepare block for lightbox -->
<?php
$imgBlock = '';
foreach ($previews as $photo) {
    $link = Html::a(
        Html::img($photo->thumb, ['alt' => '', 'class' => 'img-responsive']),
        $photo->original,
        ['data-toggle' => "lightbox", 'data-gallery' => "multiimages", 'data-title' => '', 'class' => 'col-md-4']
    );
    $imgBlock .= $link;
}
echo Html::tag(
    'div',
    $imgBlock,
    ['class' => 'row item-previews-block img-rounded text-center']
);
?>