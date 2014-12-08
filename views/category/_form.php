<?php
use yii\helpers\Html;

/* @var $model app\models\Category */
?>

<?php
if ($model->hasErrors()) {
    echo Html::tag('div', Html::errorSummary($model), ['class' => 'error-summary']);
}
?>

<?= Html::beginForm('', 'post', ['class' => 'form-horizontal', 'role' => 'form']); ?>
    <div class="form-group">
        <?= Html::activeLabel($model, 'title', ['for' => 'title', 'class' => 'col-sm-2 control-label']); ?>

        <div class="col-sm-4">
            <?= Html::activeTextInput($model, 'title', ['id' => 'title', 'class' =>  'form-control']); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <?= Html::submitInput($model->isNewRecord ? 'Save' : 'Update', ['class' =>  'btn btn-default']); ?>
        </div>
    </div>
<?php Html::endForm(); ?>