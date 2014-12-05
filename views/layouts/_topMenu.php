<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<ul class="nav navbar-nav">
    <?php if (Yii::$app->user->isGuest) { ?>
        <li class=""><?= Html::a('Sign In', Url::to('/signin')) ?></li>
    <?php } else { ?>
        <li class="<?= isset($this->params['isUsedItemPage']) ? 'active' : '' ?>">
            <?= Html::a('Used items', Url::to('/')) ?>
        </li>
        <li class="<?= isset($this->params['isCategoryPage']) ? 'active' : '' ?>">
            <?= Html::a('Categories', Url::to('/category')) ?>
        </li>
    <?php } ?>
</ul>

<?php if (!Yii::$app->user->isGuest) { ?>
<ul class="nav navbar-nav navbar-right">
    <li class="nav-user-name">Hi, Max</li>
    <li><?= Html::a('Logout', '/logout') ?></li>
</ul>
<?php } ?>