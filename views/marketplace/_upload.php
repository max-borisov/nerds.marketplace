<?php
use yii\helpers\Html;
?>
<form method="post" enctype="multipart/form-data" action="/item/upload" id="form-upload-images">
<?= Html::beginForm(
    '/upload',
    'post',
    ['enctype' => 'multipart/form-data', 'id' => 'form-upload-images']) ?>
    <span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>Select files...</span>
        <?= Html::activeHiddenInput($model, 'item_id', ['value' => $item->id]); ?>
        <?= Html::activeFileInput($model, 'file[]', ['id' => 'fileupload', 'multiple' => '']); ?>
    </span>
</form>