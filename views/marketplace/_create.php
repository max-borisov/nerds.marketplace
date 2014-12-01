<?php
/* @var $model UsedItem */
use yii\helpers\Html;
?>

<?= Html::beginForm('', 'post', [
    'class' => 'form-horizontal',
    'role' => 'form',
    'accept' => 'image/*',
    'enctype' => 'multipart/form-data'
]); ?>

    <!-- Warranty -->
    <div class="form-group">
        <?= Html::activeLabel($model, 'warranty', ['for' => 'warranty-yes', 'class' => 'col-sm-2 control-label']); ?>

        <div class="col-sm-2">
                <?= Html::activeRadio($model, 'warranty', ['label' => 'Yes', 'uncheck' => null, 'labelOptions' => ['class' =>  "radio-inline", 'id' => 'warranty-yes'], 'id' => 'warranty-yes']); ?>

                <?= Html::activeRadio($model, 'warranty', ['label' => 'No', 'uncheck' => null, 'labelOptions' => ['class' =>  "radio-inline"], 'value' => 0]); ?>
        </div>
    </div>

    <!-- Invoice -->
    <div class="form-group">
        <?= Html::activeLabel($model, 'invoice', ['for' => 'invoice-yes', 'class' => 'col-sm-2 control-label']); ?>

        <div class="col-sm-2">
            <?= Html::activeRadio($model, 'invoice', ['label' => 'Yes', 'uncheck' => null, 'labelOptions' => ['class' =>  "radio-inline"]]); ?>

            <?= Html::activeRadio($model, 'invoice', ['label' => 'No', 'uncheck' => null, 'labelOptions' => ['class' =>  "radio-inline"], 'value' => 0]); ?>
        </div>
    </div>

    <!-- Packiging -->
    <div class="form-group">
        <?= Html::activeLabel($model, 'packaging', ['for' => 'packaging-yes', 'class' => 'col-sm-2 control-label']); ?>

        <div class="col-sm-2">
            <?= Html::activeRadio($model, 'packaging', ['label' => 'Yes', 'uncheck' => null, 'labelOptions' => ['class' =>  "radio-inline"]]); ?>

            <?= Html::activeRadio($model, 'packaging', ['label' => 'No', 'uncheck' => null, 'labelOptions' => ['class' =>  "radio-inline"], 'value' => 0]); ?>
        </div>
    </div>

    <!-- Manual -->
    <div class="form-group">
        <?= Html::activeLabel($model, 'manual', ['for' => 'manual-yes', 'class' => 'col-sm-2 control-label']); ?>

        <div class="col-sm-2">
            <?= Html::activeRadio($model, 'manual', ['label' => 'Yes', 'uncheck' => null, 'labelOptions' => ['class' =>  "radio-inline"]]); ?>

            <?= Html::activeRadio($model, 'manual', ['label' => 'No', 'uncheck' => null, 'labelOptions' => ['class' =>  "radio-inline"], 'value' => 0]); ?>
        </div>
    </div>

    <hr>

    <!-- Price -->
    <div class="form-group">
        <?= Html::activeLabel($model, 'price', ['for' => 'price', 'class' => 'col-sm-2 control-label']); ?>

        <div class="col-sm-2">
            <?= Html::activeTextInput($model, 'price', ['class' =>  'form-control', 'id' => 'price', 'placeholder' => 'Price']); ?>
        </div>
    </div>

    <!-- Category -->
    <div class="form-group">
        <?= Html::activeLabel($model, 'category_id', ['for' => 'category', 'class' => 'col-sm-2 control-label']); ?>

        <div class="col-sm-2">
            <?= Html::activeDropDownList($model, 'category_id', $categories, ['class' =>  'form-control', 'id' => 'category', 'prompt' => '']); ?>
            <?= Html::a('Manage categories', '/category') ?>
        </div>
    </div>

    <!-- Title -->
    <div class="form-group">
        <?= Html::activeLabel($model, 'title', ['for' => 'title', 'class' => 'col-sm-2 control-label']); ?>

        <div class="col-sm-2">
            <?= Html::activeTextInput($model, 'title', ['class' =>  'form-control', 'id' => 'title', 'placeholder' => 'Title']); ?>
        </div>
    </div>

    <!-- Type -->
    <div class="form-group">
        <?= Html::activeLabel($model, 'type_id', ['for' => 'type_id-yes', 'class' => 'col-sm-2 control-label']); ?>

        <div class="col-sm-2">
            <?= Html::activeRadio($model, 'type_id', ['label' => 'Sale', 'uncheck' => null, 'labelOptions' => ['class' =>  "radio-inline"]]); ?>

            <?= Html::activeRadio($model, 'type_id', ['label' => 'Wanna buy', 'uncheck' => null, 'labelOptions' => ['class' =>  "radio-inline"], 'value' => 0]); ?>
        </div>
    </div>

    <!-- Description -->
    <div class="form-group">
        <?= Html::activeLabel($model, 'description', ['for' => 'description', 'class' => 'col-sm-2 control-label']); ?>

        <div class="col-sm-8">
            <?= Html::activeTextarea($model, 'description', ['class' =>  'form-control', 'id' => 'description', 'placeholder' => 'Description', 'rows' => '5', 'cols' => '12']); ?>
        </div>
    </div>

    <!-- Upload -->
    <div class="form-group">
        <?= Html::activeLabel($modelPhoto, 'file', ['for' => 'upload', 'class' => 'col-sm-2 control-label']); ?>
        <div class="col-sm-8">
            <?= Html::activeFileInput($modelPhoto, 'file[]', ['id' => 'upload', 'multiple' => '']); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <?= Html::submitInput('Save', ['class' =>  'btn btn-default']); ?>
        </div>
    </div>
<?php Html::endForm(); ?>