<?php
use app\assets\NerdsAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\Utility;

/* @var $this \yii\web\View */
/* @var $content string */

NerdsAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Navbar Template for Bootstrap</title>

    <?php $this->head() ?>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
</head>

<body>
<?php $this->beginBody() ?>

<div class="container">

    <!-- Static navbar -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">Nerds.dk marketplace</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="<?= isset($this->params['isUsedItemPage']) ? 'active' : '' ?>"><?= Html::a('Used items', Url::to('/')) ?></li>
                <li class="<?= isset($this->params['isCategoryPage']) ? 'active' : '' ?>"><?= Html::a('Categories', Url::to('/category')) ?></li>
            </ul>
        </div><!--/.container-fluid -->
    </div>

    <!-- Main component for a primary marketing message or call to action -->
    <!--<div class="jumbotron">
        <h1>Navbar example</h1>
        <p>Text.</p>
    </div>-->

    <div>
        <?=$content;?>
    </div>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>