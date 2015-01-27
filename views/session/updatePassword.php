<?php
/* @var $model app\models\UpdatePasswordForm */

use yii\helpers\Html;
use app\components\HelperPage;
?>

<?php
echo $this->render('../shared/header', ['header' => HelperPage::UPDATE_PASSWORD_PAGE_HEADER]);

if ($model->hasErrors()) {
    echo Html::tag('div', Html::errorSummary($model), ['class' => 'error-summary']);
}
?>

<?= Html::beginForm('', 'post', [
    'class' => 'form-horizontal form-update-password',
    'role' => 'form',
]); ?>
    <div class="form-group">
        <?= Html::activeLabel($model, 'old_password', ['for' => 'old-password', 'class' => 'col-sm-4 control-label']); ?>
        <div class="col-sm-4">
            <?= Html::activePasswordInput($model, 'old_password', ['class' =>  'form-control', 'id' => 'old-password', 'placeholder' => 'Old password']); ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::activeLabel($model, 'password', ['for' => 'password', 'class' => 'col-sm-4 control-label']); ?>
        <div class="col-sm-4">
            <?= Html::activePasswordInput($model, 'password', ['class' =>  'form-control', 'id' => 'password', 'placeholder' => 'New password']); ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::activeLabel($model, 'password_repeat', ['for' => 'password_repeat', 'class' => 'col-sm-4 control-label']); ?>
        <div class="col-sm-4">
            <?= Html::activePasswordInput($model, 'password_repeat', ['class' =>  'form-control', 'id' => 'password_repeat', 'placeholder' => 'Confirm password']); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-4 col-sm-4">
            <?= Html::submitInput('Submit', ['class' => "btn btn-primary"]) ?>
        </div>
    </div>
<?= Html::endForm(); ?>