<?php
/* @var $data app\models\UsedItem */
/* @var $this \yii\web\View */

//use \yii\web\View;
use yii\helpers\Html;

use app\components\HelperBase;
//HelperBase::dump($data->photos[2]->original);
//HelperBase::dump($data->photos);


//\yii\web\JqueryAsset::className()
//$this->registerCssFile('/css/ekko-lightbox.min.css');
//$this->registerJsFile('/js/ekko-lightbox.min.js', ['position' => View::POS_END]);
?>

<p><?= Html::a('Back', '/', ['class' => 'btn btn-default']) ?></p>
<h1 class="text-center"><?= Html::encode($data->title) ?></h1>

<div class="row item-view-info">
    <div class="col-md-4">
        <img src="<?= $data->preview ?>" alt="<?= $data->title, ' preview' ?>" class="img-thumbnail">
    </div>
    <div class="col-md-8"><?= $this->render('_itemInfoTable', ['data' => $data]) ?></div>
</div>

<?php if ($data->photos) {
    $imgBlock = '';
    foreach ($data->photos as $itemPhoto) {
        $link = Html::a(Html::img($itemPhoto->thumb, ['alt' => '', 'class' => 'img-responsive']), $itemPhoto->original, ['data-toggle' => "lightbox", 'data-gallery' => "multiimages", 'data-title' => 'thumbnail']);
        $imgBlock .= Html::tag('li', $link);
    }
    echo Html::tag('div', Html::tag('ul', $imgBlock, ['class' => 'list-inline']), ['class' => 'row item-photos-block img-rounded text-center']);
?>

<?php } ?>