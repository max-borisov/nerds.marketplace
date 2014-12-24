<?php
use yii\helpers\Html;

echo Html::beginForm(
    '/item/upload',
    'post',
    ['enctype' => 'multipart/form-data', 'id' => 'form-upload-images']) ?>
    <span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>Select files...</span>
        <?= Html::activeHiddenInput($model, 'item_id', ['value' => $item->id]); ?>
        <?php
        if (YII_ENV === 'test') {
            echo Html::activeFileInput($model, 'file[0]', ['id' => 'fileupload', 'multiple' => '']);
            echo Html::submitInput('Upload');
        } else {
            echo Html::activeFileInput($model, 'file[]', ['id' => 'fileupload', 'multiple' => '']);
        }
        ?>
    </span>
<?= Html::endForm() ?>