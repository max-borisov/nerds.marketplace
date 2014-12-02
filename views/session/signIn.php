<?php
/* @var $model app\models\SignInForm */

use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php
if ($model->hasErrors()) {
    echo Html::tag('div', Html::errorSummary($model), ['class' => 'errorSummary']);
}

if (Yii::$app->session->hasFlash('signup_success')) {
    echo '<div class="alert alert-success" role="alert">' . Yii::$app->session->getFlash('signup_success') . '</div>';
}
?>

<div class="row">
    <h2 class="form-signin-heading">Sign in</h2>
    <?= Html::beginForm('', 'post', [
        'class' => 'form-signin',
        'role' => 'form',
    ]); ?>

        <?= Html::activeLabel($model, 'email', ['for' => 'email', 'class' => 'sr-only']); ?>
        <?= Html::activeTextInput($model, 'email', ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email', 'type' => 'email']); ?>

        <?= Html::activeLabel($model, 'password', ['for' => 'password', 'class' => 'sr-only']); ?>
        <?= Html::activePasswordInput($model, 'password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Password']); ?>

        <!--<div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>-->

        <?= Html::submitInput('Submit', ['class' => 'btn btn-lg btn-primary btn-block', 'name' => 'SignInForm[submit]']) ?>

        <div class="signup-suggestion text-center">
            <?= Html::a('Sign up', Url::to('/signup')) ?>, if you don't have an account yet.
        </div>

    <?= Html::endForm(); ?>



</div>
