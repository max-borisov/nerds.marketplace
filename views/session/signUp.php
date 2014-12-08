<?php
/* @var $model app\models\SignUpForm */

use yii\helpers\Html;
use yii\helpers\Url;
?>

<h2 class="form-signup-heading">Sign up</h2>

<?php
if ($model->hasErrors()) {
    echo Html::tag('div', Html::errorSummary($model), ['class' => 'error-summary']);
}

if (Yii::$app->session->hasFlash('signup_error')) {
    echo '<div class="alert alert-danger" role="alert">' . Yii::$app->session->getFlash('signup_error') . '</div>';
}
?>

<?= Html::beginForm('', 'post', [
    'class' => 'form-horizontal form-signup',
    'role' => 'form',
]); ?>
    <div class="form-group">
        <?= Html::activeLabel($model, 'username', ['for' => 'username', 'class' => 'col-sm-4 control-label']); ?>
        <div class="col-sm-8">
            <?= Html::activeTextInput($model, 'username', ['class' =>  'form-control', 'id' => 'name', 'placeholder' => 'Name']); ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::activeLabel($model, 'email', ['for' => 'email', 'class' => 'col-sm-4 control-label']); ?>
        <div class="col-sm-8">
            <?= Html::activeTextInput($model, 'email', ['class' =>  'form-control', 'id' => 'email', 'type' => 'email', 'placeholder' => 'Email']); ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::activeLabel($model, 'password', ['for' => 'password', 'class' => 'col-sm-4 control-label']); ?>
        <div class="col-sm-8">
            <?= Html::activePasswordInput($model, 'password', ['class' =>  'form-control', 'id' => 'password', 'placeholder' => 'Password']); ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::activeLabel($model, 'password_repeat', ['for' => 'password_repeat', 'class' => 'col-sm-4 control-label']); ?>
        <div class="col-sm-8">
            <?= Html::activePasswordInput($model, 'password_repeat', ['class' =>  'form-control', 'id' => 'password_repeat', 'placeholder' => 'Password repeat']); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-4 col-sm-4">
            <?= Html::submitInput('Submit', ['class' => "btn btn-primary"]) ?>
        </div>
    </div>

    <div class="signup-suggestion text-center">
        <?= Html::a('Sign in', Url::to('/signin')) ?>, if you already have an account.
    </div>

<?= Html::endForm(); ?>