<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<ul class="nav navbar-nav navbar-right">
    <li class="<?= isset($this->params['isUsedItemPage']) ? 'active' : '' ?>">
        <?= Html::a('Used items', Url::to('/')) ?>
    </li>
    <li class="<?= isset($this->params['isCategoryPage']) ? 'active' : '' ?>">
        <?= Html::a('Categories', Url::to('/category')) ?>
    </li>
    <?php if (Yii::$app->user->isGuest) { ?>
        <li class=""><?= Html::a('SignUp', Url::to('/signup')) ?></li>
        <li class=""><?= Html::a('SignIn', Url::to('/signin')) ?></li>
    <?php } else { ?>
        <li class="">
            <?= Html::a('Logout', Url::to('/logout')) ?>
        </li>
    <?php } ?>
</ul>