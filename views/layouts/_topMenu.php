<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\HelperUser;
?>

<?php if (Yii::$app->user->isGuest) { ?>
    <ul class="nav navbar-nav navbar-right">
        <li class=""><?= Html::a('Sign In', Url::to('/signin')) ?></li>
    </ul>
<?php } else { ?>
    <ul class="nav navbar-nav">
        <li class="<?= isset($this->params['isUsedItemPage']) ? 'active' : '' ?>">
            <?= Html::a('Used items', Url::to('/')) ?>
        </li>
        <li class="<?= isset($this->params['isCategoryPage']) ? 'active' : '' ?>">
            <?= Html::a('Categories', Url::to('/category')) ?>
        </li>
    </ul>

    <!--    Action links-->
    <ul class="nav navbar-nav navbar-right">
        <li class="nav-user-name">Hi, <?= Html::encode(HelperUser::uIdentityParam('username')) ?></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Actions <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><?= Html::a('Your items', '/items') ?></li>
                <li class="divider"></li>
                <li><?= Html::a('Logout', '/logout') ?></li>
            </ul>
        </li>
    </ul>
<?php } ?>