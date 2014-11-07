<?php
use yii\helpers\Html;

/* @var $model app\models\UsedItems */
?>

<div class="row search-item-block">
    <?= Html::beginForm('', 'get', ['class' => 'form-horizontal', 'role' => 'form']); ?>
        <div class="col-md-6">

            <!-- Warranty -->
            <div class="form-group">
                <?= Html::activeLabel($model, 'warranty', ['for' => 'warranty-yes', 'class' => 'col-sm-2 control-label']); ?>

                <div class="col-sm-5">
                    <?= Html::activeRadio($model, 'warranty', ['label' => 'Yes', 'uncheck' => null, 'labelOptions' => ['class' =>  "radio-inline", 'id' => 'warranty-yes'], 'id' => 'warranty-yes']); ?>

                    <?= Html::activeRadio($model, 'warranty', ['label' => 'No', 'uncheck' => null, 'labelOptions' => ['class' =>  "radio-inline"], 'value' => 0]); ?>
                </div>
            </div>

            <!-- Packiging -->
            <div class="form-group">
                <?= Html::activeLabel($model, 'packaging', ['for' => 'packaging-yes', 'class' => 'col-sm-2 control-label']); ?>

                <div class="col-sm-5">
                    <?= Html::activeRadio($model, 'packaging', ['label' => 'Yes', 'uncheck' => null, 'labelOptions' => ['class' =>  "radio-inline"]]); ?>

                    <?= Html::activeRadio($model, 'packaging', ['label' => 'No', 'uncheck' => null, 'labelOptions' => ['class' =>  "radio-inline"], 'value' => 0]); ?>
                </div>
            </div>

            <!-- Manual -->
            <div class="form-group">
                <?= Html::activeLabel($model, 'manual', ['for' => 'manual-yes', 'class' => 'col-sm-2 control-label']); ?>

                <div class="col-sm-5">
                    <?= Html::activeRadio($model, 'manual', ['label' => 'Yes', 'uncheck' => null, 'labelOptions' => ['class' =>  "radio-inline"]]); ?>

                    <?= Html::activeRadio($model, 'manual', ['label' => 'No', 'uncheck' => null, 'labelOptions' => ['class' =>  "radio-inline"], 'value' => 0]); ?>
                </div>
            </div>

            <!-- Title -->
            <div class="form-group">
                <?= Html::activeLabel($model, 'title', ['for' => 'title', 'class' => 'col-sm-2 control-label']); ?>

                <div class="col-sm-5">
                    <?= Html::activeTextInput($model, 'title', ['id' => 'title', 'class' => 'form-control']); ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">

            <!-- Min price -->
            <div class="form-group">
                <?= Html::activeLabel($model, 'price_min', ['for' => 'price_min', 'class' => 'col-sm-3 control-label']); ?>

                <div class="col-sm-5">
                    <?= Html::activeTextInput($model, 'price_min', ['id' => 'price_min', 'class' => 'form-control']); ?>
                </div>
            </div>

            <!-- Max price -->
            <div class="form-group">
                <?= Html::activeLabel($model, 'price_max', ['for' => 'price_max', 'class' => 'col-sm-3 control-label']); ?>

                <div class="col-sm-5">
                    <?= Html::activeTextInput($model, 'price_max', ['id' => 'price_max', 'class' => 'form-control']); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                    <?= Html::submitButton('Search', ['class' => 'btn btn-primary btn-lg btn-search']) ?>
                    <?= Html::tag('p', Html::a('Reset filter', '/'), ['class' => 'link-reset-filter']) ?>
                </div>
            </div>
        </div>

    <?php Html::endForm(); ?>
</div>
