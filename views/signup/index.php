<?php
/* @var $model app\models\SignUpForm */
use yii\helpers\Html;
?>

<?php
if ($model->hasErrors()) {
    echo Html::tag('div', Html::errorSummary($model), ['class' => 'errorSummary']);
}
?>

<?= Html::beginForm('', 'post', [
    'class' => 'form-horizontal',
    'role' => 'form',
]); ?>
    <div class="form-group">
        <?= Html::activeLabel($model, 'username', ['for' => 'username', 'class' => 'col-sm-2 control-label']); ?>
        <div class="col-sm-4">
            <?= Html::activeTextInput($model, 'username', ['class' =>  'form-control', 'id' => 'name', 'placeholder' => 'Name']); ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::activeLabel($model, 'email', ['for' => 'email', 'class' => 'col-sm-2 control-label']); ?>
        <div class="col-sm-4">
            <?= Html::activeTextInput($model, 'email', ['class' =>  'form-control', 'id' => 'email', 'type' => 'email', 'placeholder' => 'Email']); ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::activeLabel($model, 'password', ['for' => 'password', 'class' => 'col-sm-2 control-label']); ?>
        <div class="col-sm-4">
            <?= Html::activePasswordInput($model, 'password', ['class' =>  'form-control', 'id' => 'password', 'placeholder' => 'Password']); ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::activeLabel($model, 'password_repeat', ['for' => 'password_repeat', 'class' => 'col-sm-2 control-label']); ?>
        <div class="col-sm-4">
            <?= Html::activePasswordInput($model, 'password_repeat', ['class' =>  'form-control', 'id' => 'password_repeat', 'placeholder' => 'Password repeat']); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-4">
            <button type="submit" class="btn btn-default">Sign up</button>
        </div>
    </div>

<?= Html::endForm(); ?>