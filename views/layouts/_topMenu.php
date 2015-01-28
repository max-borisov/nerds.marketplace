<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\HelperBase;
use app\components\HelperUser;
use app\models\PhpbbUser;
?>
<ul class="nav navbar-nav">
    <li class="<?= isset($this->params['isUsedItemPage']) ? 'active' : '' ?>">
        <?= Html::a('Used items', Url::to('/')) ?>
    </li>
    <li class="<?= isset($this->params['isNewsPage']) ? 'active' : '' ?>">
        <?= Html::a('News', Url::to('/news')) ?>
    </li>
    <li class="<?= isset($this->params['isReviewsPage']) ? 'active' : '' ?>">
        <?= Html::a('Reviews', Url::to('/reviews')) ?>
    </li>
    <?php if (!HelperUser::isGuest()) { ?>
    <li class="<?= isset($this->params['isCategoryPage']) ? 'active' : '' ?>">
        <?= Html::a('Categories', Url::to('/category')) ?>
    </li>
    <?php } ?>
</ul>

<!--    Action links-->
<ul class="nav navbar-nav navbar-right">
    <?php if (HelperUser::isGuest()) { ?>
        <li><?= Html::a('Sign In', Url::to('/signin')) ?></li>
    <?php } else { ?>
    <li class="nav-user-name">Hi, <?= Html::encode(HelperUser::uIdentityParam('username')) ?></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Actions <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li><?= Html::a('Add new item', '/item/create') ?></li>
            <?php
            // Only users how have posted some items
            if ((new PhpbbUser)->hasItems(HelperUser::uid())) {
                echo '<li>', Html::a('Your items', '/items'), '</li>';
            }
            ?>
            <li><?= Html::a('Update password', '/update-password') ?></li>
            <li><?= Html::a('Forum profile', HelperBase::getForumProfileLink(HelperUser::uid())) ?></li>
            <li class="divider"></li>
            <li><?= Html::a('Logout', '/logout') ?></li>
        </ul>
    </li>
    <?php } ?>
</ul>